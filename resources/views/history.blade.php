@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold">Tracking History</h1>
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th>Tracking Number</th>
                <th>Carrier</th>
                <th>Data</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($histories as $history)
                <tr>
                    <td>{{ $history->tracking_number }}</td>
                    <td>{{ $history->carrier }}</td>
                    <td>{{ $history->tracking_data }}</td>
                    <td>{{ $history->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
