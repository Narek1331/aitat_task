<?php

namespace App\Services;

use GuzzleHttp\Client;

class RFMSegmentsService
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string|null
     */
    protected $accessToken;

    /**
     * RFMSegmentsService constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Fetches access token from the API.
     *
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function fetchAccessToken($username, $password)
    {
        $response = $this->client->post('https://vivarolls.magic-of-numbers.ru:8686/user/token', [
            'form_params' => [
                'username' => $username,
                'password' => $password,
            ]
        ]);

        $body = json_decode($response->getBody(), true);

        if ($response->getStatusCode() == 200 && isset($body['access_token'])) {
            $this->accessToken = $body['access_token'];
            return true;
        }

        return false;
    }

    /**
     * Retrieves the report ID.
     *
     * @return string|null
     */
    public function getReportId()
    {
        $response = $this->client->get('https://vivarolls.magic-of-numbers.ru:8686/reports', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ]
        ]);

        $body = json_decode($response->getBody(), true);

        if ($response->getStatusCode() == 200) {
            foreach ($body['grouped']['General'] as $report) {
                if ($report['name'] === 'get_segment_rfm') {
                    return $report['id'];
                }
            }
        }

        return null;
    }

    /**
     * Runs the report.
     *
     * @param string $reportId
     * @return array|null
     */
    public function runReport($reportId)
    {
        $response = $this->client->post("https://vivarolls.magic-of-numbers.ru:8686/report/{$reportId}/run", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ],
            'json' => []
        ]);

        return json_decode($response->getBody(), true);
    }
}
