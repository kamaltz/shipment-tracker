@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-lg p-6 max-w-sm mx-auto">
        <h1 class="text-2xl font-bold mb-4 border-b-4">Shipment Tracker - TEAM 4</h1>
        <h2 class="text-2xl font-bold mb-4">Cek Resi</h2>
        <form method="POST" action="{{ route('cekresi.track') }}" class="space-y-4" id="trackingForm">
            @csrf
            <!-- Input Resi -->
            <div class="flex flex-col">
                <label for="noresi" class="text-lg font-semibold">Masukkan No Resi:</label>
                <input type="text" id="noresi" name="noresi" placeholder="Masukkan no resi..." class="border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required />
            </div>

            <!-- Courier Selection -->
            <div class="flex flex-col">
                <label for="courier" class="text-lg font-semibold">Pilih Ekspedisi:</label>
                <select id="courier" name="courier" class="border border-gray-300 rounded-lg p-3 mt-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="jne">JNE</option>
                    <option value="sicepat">SiCepat</option>
                    <option value="tiki">TIKI</option>
                    <!-- Add more couriers as needed -->
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center">
                <input type="submit" value="Cek Resi" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <!-- Feedback Messages -->
            @if (session('error'))
            <div class="mt-4 text-red-500">
                {{ session('error') }}
            </div>
            @endif
        </form>
    </div>
</div>

<script>
    // Autosave functionality
    document.addEventListener('DOMContentLoaded', function() {
        const trackingForm = document.getElementById('trackingForm');
        const noresiInput = document.getElementById('noresi');
        const courierSelect = document.getElementById('courier');

        // Load saved data from local storage
        if (localStorage.getItem('noresi')) {
            noresiInput.value = localStorage.getItem('noresi');
        }
        if (localStorage.getItem('courier')) {
            courierSelect.value = localStorage.getItem('courier');
        }

        // Save data to local storage on input change
        noresiInput.addEventListener('input', function() {
            localStorage.setItem('noresi', noresiInput.value);
        });

        courierSelect.addEventListener('change', function() {
            localStorage.setItem('courier', courierSelect.value);
        });
    });
</script>
@endsection