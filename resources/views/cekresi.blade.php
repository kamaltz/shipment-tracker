@extends('layouts.app')

@section('content')
<div class="container p-6 mx-auto">
    <div class="p-6 mx-auto max-w-sm bg-white rounded-lg shadow-lg">
        <form method="POST" action="{{ route('cekresi.track') }}" class="space-y-4">
            @csrf
            <!-- Input Resi -->
            <div class="flex flex-col">
                <label for="noresi" class="text-lg font-semibold">Masukkan No Resi:</label>
                <input type="text" id="noresi" name="noresi" placeholder="Masukkan no resi..." class="p-3 mt-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>

            <!-- Courier Selection -->
            <div class="flex flex-col">
                <label for="courier" class="text-lg font-semibold">Pilih Ekspedisi:</label>
                <select id="courier" name="courier" class="p-3 mt-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="jne">JNE</option>
                    <option value="sicepat">SiCepat</option>
                    <option value="tiki">TIKI</option>
                    <!-- Add more couriers as needed -->
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <input type="submit" value="Cek Resi" class="px-6 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Feedback Messages -->
            @if (session('error'))
                <div class="mt-4 text-red-500">
                    {{ session('error') }}
                </div>
            @endif
            @if (isset($trackingData) && is_array($trackingData) && isset($trackingData['data']) && is_array($trackingData['data']['manifest']))
                <div class="p-4 mt-6 bg-gray-100 rounded-lg">
                    <h3 class="text-xl font-bold">Tracking Information</h3>
                    <ul class="pl-5 list-disc">
                        @foreach($trackingData['data']['manifest'] as $event)
                            <li>{{ $event['manifest_date'] ?? 'N/A' }}: {{ $event['manifest_description'] ?? 'No description available' }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div class="mt-6 text-red-500">
                    Status: Gagal atau tidak ada koneksi ke API.
                </div>
            @endif
        </form>

        <!-- Footer (Cekresi Link) -->
        <div class="mt-4 text-sm text-center text-gray-600">
        
        </div>
    </div>
</div>
@endsection
