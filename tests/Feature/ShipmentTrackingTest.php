<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use GuzzleHttp\Client;

class ShipmentTrackingTest extends TestCase
{
    use RefreshDatabase;

    public function test_tracking_functionality()
    {
        $client = new Client();
        $response = $client->request('POST', 'https://rajaongkir.komerce.id/api/v1/track/waybill', [
            'headers' => [
                'accept' => 'application/json',
                'key' => 'IHzu9qrc0c895801ff5aa841LdABCTK6',
            ],
            'json' => [
                'Awb' => '004398245608', // Correct field name for the tracking number
                'courier' => 'sicepat', // Set to the carrier
            ],
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $responseData = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertArrayHasKey('waybill', $responseData['data']);
        $this->assertArrayHasKey('status', $responseData['data']);
        // Add other assertions based on the expected API response structure
    }
}
