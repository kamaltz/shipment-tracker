<?php

namespace App\Http\Controllers;

use App\Services\ShipmentTrackingService;
use Illuminate\Http\Request;
use App\Models\ShipmentHistory; // Ensure this is imported

class ShipmentTrackingController extends Controller
{
    protected $trackingService;

    public function __construct(ShipmentTrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function track(Request $request)
    {
        // Validasi input
        $request->validate([
            'tracking_number' => 'required|string',
            'carrier' => 'nullable|string',
        ]);

        // Ambil data tracking
        $trackingData = $this->trackingService->track($request->tracking_number, $request->carrier);

        // Simpan data ke cache browser jika user tidak login
        if (!auth()->check()) {
            // Menyimpan data ke cache browser selama 60 menit
            cache()->put("tracking_{$request->tracking_number}", json_encode($trackingData), now()->addMinutes(60));
        }

        // Mengembalikan hasil tracking ke view
        return view('tracking-result', compact('trackingData'));
    }

    public function saveTrackingData(Request $request)
    {
        $request->validate([
            'noresi' => 'required|string',
            'courier' => 'required|string',
        ]);

        // Save the tracking data to the database
        ShipmentHistory::create([
            'user_id' => auth()->id(), // Assuming the user is logged in
            'tracking_number' => $request->noresi,
            'carrier' => $request->courier,
        ]);

        return response()->json(['message' => 'Tracking data saved successfully.']);
    }
}
