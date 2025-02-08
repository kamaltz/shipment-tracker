<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$trackingNumber = '004398245608'; // Valid tracking number
$carrier = 'sicepat'; // Valid courier

try {
    $url = 'https://rajaongkir.komerce.id/api/v1/track/waybill?awb=' . $trackingNumber . '&courier=' . $carrier;

    $response = $client->request('POST', $url, [
        'headers' => [
            'accept' => 'application/json',
            'key' => 'UN1NuMc4753545818da803fb7mbhq1O3',
        ],
    ]);

    $trackingData = json_decode($response->getBody(), true);
    print_r($trackingData);

} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}