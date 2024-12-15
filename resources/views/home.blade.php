@extends('layouts.main')
@section('title', 'Dashboard')

@section('styles')
    <style>
        .card {
            height: 300px;
            min-height: 300px;
            font-size: 24px;
            padding: 50px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease-in-out;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .row {
            display: flex;
            justify-content: center;
            align-items: start;
        }

        .card-title {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .card-text {
            font-size: 30px;
            margin: 0;
        }

        @media (max-width: 768px) {
            .card {
                font-size: 20px;
                padding: 30px 15px;
            }

            .card-body {
                font-size: 20px;
            }

            .card-text {
                font-size: 22px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-start" style="min-height: 100vh;">
        <div class="row justify-content-center w-100">
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm card-hover" style="height: 250px;">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-wallet2 text-primary" style="font-size: 40px;"></i>
                        <h5 class="card-title text-primary mt-3">Total Tagihan</h5>
                        <p class="card-text text-primary font-weight-bold" style="font-size: 30px;">Rp.
                            {{ number_format($totalTagihan) }}</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Instansi -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm card-hover" style="height: 250px;">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-building text-primary" style="font-size: 40px;"></i>
                        <h5 class="card-title text-primary mt-3">Total Instansi</h5>
                        <p class="card-text text-primary font-weight-bold" style="font-size: 30px;">{{ $totalInstansi }}
                            Instansi</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Status Tagihan Menunggu Pembayaran -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm card-hover" style="height: 250px;">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-hourglass-split text-primary" style="font-size: 40px;"></i>
                        <h5 class="card-title text-primary mt-3">Tagihan Menunggu Pembayaran</h5>
                        <p class="card-text text-primary font-weight-bold" style="font-size: 30px;">
                            {{ $menungguPembayaranCount }} Tagihan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
