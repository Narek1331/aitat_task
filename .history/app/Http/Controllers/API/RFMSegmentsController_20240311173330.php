<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RFMSegmentsController extends Controller
{
    public function index()
    {
        // Fetch access token
        $accessTokenResponse = Http::post('https://vivarolls.magic-of-numbers.ru:8686/user/token', [
            'username' => 'test@com.ru',
            'password' => '!Sdc987gS5d@3',
        ]);

        dd($accessTokenResponse);

        $accessToken = $accessTokenResponse['access_token'];

        // Get report ID
        $reportsResponse = Http::withToken($accessToken)->get('https://vivarolls.magic-of-numbers.ru:8686/reports');

        $reportId = null;
        foreach ($reportsResponse['grouped']['General'] as $report) {
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
        $reportResponse = Http::withToken($accessToken)->post("https://vivarolls.magic-of-numbers.ru:8686/report/{$reportId}/run");

        // Process report data
        $segments = $reportResponse['aggregations']['segments']['buckets'];

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
        // return view('rfm_segments.index', compact('rfmSegments'));
    }
}
