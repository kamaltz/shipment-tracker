<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Shipment Tracking</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold">Shipment Tracking</h1>
        <form id="trackingForm" class="mt-4">
            <input type="text" name="tracking_number" id="tracking_number" placeholder="Enter Tracking Number" class="border rounded p-2 w-full">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-2">Track</button>
        </form>
        <div id="trackingResult" class="mt-4"></div>
    </div>
    <script>
        document.getElementById('trackingForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const trackingNumber = document.getElementById('tracking_number').value;
            const response = await fetch('/track', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ tracking_number: trackingNumber })
            });
            const data = await response.json();
            document.getElementById('trackingResult').innerText = JSON.stringify(data, null, 2);
        });
    </script>
</body>
</html>
