@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
<div class="container-fluid mt-4">
    <!-- Row 1: Summary Cards -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Tagihan</h5>
                    <p class="card-text text-success font-weight-bold">Rp. 30.521.850</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Instansi</h5>
                    <p class="card-text text-success font-weight-bold">10 Instansi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Charts -->
    <div class="row mt-4">
        <!-- Tagihan Pembayaran Bar Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Tagihan Pembayaran</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Status Tagihan Doughnut Chart -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Status Tagihan Pembayaran</h5>
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Dummy for Bar Chart
    const barData = {
        labels: ['UKDW', 'UGM', 'UNY', 'Sanata Dharma', 'UBI', 'ITNY'],
        datasets: [
            {
                label: 'Lunas',
                data: [2000, 1800, 1500, 1700, 1400, 1000],
                backgroundColor: '#4CAF50',
            },
            {
                label: 'Belum Lunas',
                data: [500, 300, 200, 400, 300, 200],
                backgroundColor: '#FF5722',
            }
        ]
    };

    // Bar Chart Configuration
    const barConfig = {
        type: 'bar',
        data: barData,
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
            },
        }
    };

    // Data Dummy for Doughnut Chart
    const doughnutData = {
        labels: ['Lunas', 'Belum Bayar'],
        datasets: [
            {
                data: [70, 30], // Persentase data
                backgroundColor: ['#4CAF50', '#FF5722'],
                hoverOffset: 4
            }
        ]
    };

    // Doughnut Chart Configuration
    const doughnutConfig = {
        type: 'doughnut',
        data: doughnutData,
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
            },
        }
    };

    // Render Charts
    const barChart = new Chart(document.getElementById('barChart'), barConfig);
    const doughnutChart = new Chart(document.getElementById('doughnutChart'), doughnutConfig);
</script>
@endsection
