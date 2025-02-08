@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-sm mx-auto">
        <h3 class="font-semibold text-lg mb-4">Hasil Tracking</h3>

        <!-- Tempat untuk menampilkan data tracking -->
        <div id="trackingResult" class="text-sm"></div>

        @if (isset($trackingData['error']))
            <div class="bg-red-100 p-4 rounded-lg text-red-600">
                Error: {{ $trackingData['message'] }}
            </div>
        @else
            <pre class="text-sm">{{ json_encode($trackingData, JSON_PRETTY_PRINT) }}</pre>
        @endif
    </div>
</div>

<script>
    // Mengambil nomor resi dari URL atau data yang ada di halaman
    const trackingNumber = '{{ $trackingData['waybill'] ?? '' }}';

    // Mengecek apakah ada data yang sudah disimpan di localStorage
    const cachedData = localStorage.getItem('tracking_' + trackingNumber);
    
    if (cachedData) {
        // Menampilkan data yang sudah disimpan di cache browser
        document.getElementById('trackingResult').innerText = cachedData;
    } else {
        // Jika tidak ada cache, tampilkan data yang baru saja diterima
        if ('{{ isset($trackingData) }}') {
            localStorage.setItem('tracking_' + trackingNumber, JSON.stringify({{ json_encode($trackingData) }}));
        }
    }
</script>
@endsection
