@extends('layouts.backend')

@section('content')
<div class="container">
    <div class="row mb-4">
        <!-- Incoming & Outgoing Chart -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Incoming & Outgoing</span>
                    <button class="btn btn-secondary btn-sm">Monthly</button>
                </div>
                <div class="card-body">
                    <canvas id="incomingOutgoingChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Low Quantity Stock -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Low Quantity Stock</div>
                <div class="card-body">
                    @foreach($lowQuantityStock as $stock)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <strong>{{ $stock->barang->nama_barang ?? 'Unknown' }}</strong>
                            <p>Remaining Quantity: {{ $stock->jumlah ?? 0 }} {{ $stock->satuan ?? 'units' }}</p>
                        </div>
                        <span class="badge bg-danger">Low</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <!-- Top Selling Stock -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Top Selling Stock</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Sold Quantity</th>
                                <th>Remaining Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topSellingStock as $stock)
                            <tr>
                                <td>{{ $stock->barang->nama_barang ?? 'Unknown' }}</td>
                                <td>{{ $stock->sold_quantity ?? 0 }}</td>
                                <td>{{ $stock->barang->stok->jumlah ?? 0 }}</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Expiring Products -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Expiring Products (Next 3 Months)</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Remaining Stock</th>
                                <th>Expiry Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expiringProducts as $product)
                                <tr>
                                    <td>{{ $product['nama_barang'] }}</td>
                                    <td>{{ $product['jumlah'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($product['tanggal_kedaluwarsa'])->format('d M Y') }}</td>
                                    <td class="{{ $product['statusClass'] }}">{{ $product['status'] }}</td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const incomingData = @json(array_values($incomingData));
        const outgoingData = @json(array_values($outgoingData));

        // Debugging: Log data to console
        console.log('Incoming Data:', incomingData);
        console.log('Outgoing Data:', outgoingData);

        const ctx = document.getElementById('incomingOutgoingChart').getContext('2d');
        const incomingOutgoingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Incoming',
                        data: incomingData,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    },
                    {
                        label: 'Outgoing',
                        data: outgoingData,
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
