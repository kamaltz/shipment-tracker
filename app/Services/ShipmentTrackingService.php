<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log; // Importing Log

class ShipmentTrackingService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function track($trackingNumber, $carrier = null)
    {
        try {
            // Construct the API URL with query parameters
            $url = 'https://rajaongkir.komerce.id/api/v1/track/waybill?awb=' . $trackingNumber . '&courier=' . ($carrier ?? 'jne');

            // API call to RajaOngkir
            $response = $this->client->request('POST', $url, [
                'headers' => [
                    'accept' => 'application/json',
                    'key' => 'IHzu9qrc0c895801ff5aa841LdABCTK6',
                ],
            ]);

            $trackingData = json_decode($response->getBody(), true);

            // Log the tracking data for debugging
            Log::info('Tracking Data:', $trackingData);

            return $trackingData;
        } catch (\Exception $e) {
            return [
                'error' => 'Failed to retrieve tracking data',
                'message' => $e->getMessage(),
            ];
        }
    }
}
