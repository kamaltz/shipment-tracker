<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Services\ShipmentTrackingService;

class CekResiController extends Controller
{
    protected $trackingService;

    public function __construct(ShipmentTrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function showForm()
    {
        return view('cekresi');
    }

    public function track(Request $request)
    {
        $request->validate([
            'noresi' => 'required|string',
            'courier' => 'required|string',
        ]);

        $trackingNumber = $request->noresi;
        $courier = $request->courier;

        Log::info('Tracking Request Parameters:', [
            'waybill' => $trackingNumber,
            'courier' => $courier,
        ]);

        try {
            $trackingData = $this->trackingService->track($trackingNumber, $courier);

            Log::info('Tracking Data:', $trackingData);

            if (isset($trackingData['meta']['status']) && $trackingData['meta']['status'] === 'success') {
                return view('cekresi', compact('trackingData'));
            } else {
                return back()->with('error', 'Failed to retrieve tracking data.');
            }

        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching tracking data: ' . $e->getMessage());
        }
    }
}