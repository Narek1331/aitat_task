<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class RFMSegmentsController extends Controller
{
    public function index()
    {
        // Create Guzzle client instance
        $client = new Client();

        // Fetch access token
        $accessTokenResponse = $client->post('https://vivarolls.magic-of-numbers.ru:8686/user/token', [
            'form_params' => [
                'username' => 'test@com.ru',
                'password' => '!Sdc987gS5d@3',
            ]
        ]);

        $accessTokenResponseBody = json_decode($accessTokenResponse->getBody(), true);

        if (!$accessTokenResponse->getStatusCode() == 200 || !isset($accessTokenResponseBody['access_token'])) {
            // Handle error: unable to fetch access token
            return response()->json(['error' => 'Unable to fetch access token'], $accessTokenResponse->getStatusCode());
        }

        $accessToken = $accessTokenResponseBody['access_token'];

        // Get report ID
        $reportsResponse = $client->get('https://vivarolls.magic-of-numbers.ru:8686/reports', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ]
        ]);

        if (!$reportsResponse->getStatusCode() == 200) {
            // Handle error: unable to fetch reports
            return response()->json(['error' => 'Unable to fetch reports'], $reportsResponse->getStatusCode());
        }

        $reportsResponseBody = json_decode($reportsResponse->getBody(), true);

        $reportId = null;
        foreach ($reportsResponseBody['grouped']['General'] as $report) {
            if ($report['name'] === 'get_segment_rfm') {
                $reportId = $report['id'];
                break;
            }
        }

        if (!$reportId) {
            // Handle error: report not found
            return response()->json(['error' => 'Report not found'], 404);
        }

        // Run report
        $reportResponse = $client->get("https://vivarolls.magic-of-numbers.ru:8686/report/{$reportId}", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ]
        ]);


        if (!$reportResponse->getStatusCode() == 200) {
            // Handle error: unable to run report
            return response()->json(['error' => 'Unable to run report'], $reportResponse->getStatusCode());
        }

        $reportResponseBody = json_decode($reportResponse->getBody(), true);

        return response()->json($reportResponseBody);
        // Process report data
        $segments = $reportResponseBody['aggregations']['segments']['buckets'];

        $rfmSegments = [];
        foreach ($segments as $segment) {
            $docCount = $segment['doc_count'];
            $ordersValue = $segment['orders']['value'];
            $totalValue = $segment['total']['value'];
            $averageCheck = $totalValue / $ordersValue;
            $percent = ($segment['total']['value'] / $docCount) * 100;

            $rfmSegments[] = [
                'name' => $segment['key'],
                'doc_count' => $docCount,
                'orders' => [
                    'value' => $ordersValue
                ],
                'total' => [
                    'value' => $totalValue
                ],
                'avg' => $averageCheck,
                'percent' => $percent
            ];
        }
        dd($rfmSegments);
        return view('rfm_segments.index', compact('rfmSegments'));
    }
}
