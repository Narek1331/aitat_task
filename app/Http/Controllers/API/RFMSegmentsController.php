<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\RFMSegmentsService;
use Illuminate\Http\JsonResponse;

class RFMSegmentsController extends Controller
{
    /**
     * Fetches RFM segments data.
     *
     * @param RFMSegmentsService $rfmSegmentsService
     * @return JsonResponse
     */
    public function index(RFMSegmentsService $rfmSegmentsService): JsonResponse
    {
        if (!$rfmSegmentsService->fetchAccessToken('test@com.ru', '!Sdc987gS5d@3')) {
            return response()->json(['error' => 'Unable to fetch access token'], 500);
        }

        $reportId = $rfmSegmentsService->getReportId();

        if (!$reportId) {
            return response()->json(['error' => 'Report not found'], 404);
        }

        $reportData = $rfmSegmentsService->runReport($reportId);

        // Process report data
        $rfmSegments = [];
        foreach ($reportData['aggregations']['segments']['buckets'] as $segment) {
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

        return response()->json($rfmSegments,200);
    }
}
