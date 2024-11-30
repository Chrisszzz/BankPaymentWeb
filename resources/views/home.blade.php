@extends('layouts.main')
@section('title', 'Dashboard')

@section('styles')
    <style>
        .card {
            height: 300px;
            /* Menyesuaikan tinggi card agar lebih besar */
            min-height: 300px;
            /* Menentukan tinggi minimum card */
            font-size: 24px;
            /* Ukuran font lebih besar */
            padding: 50px 30px;
            /* Padding lebih besar untuk memperbesar card */
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.3s ease-in-out;
            /* Menambahkan transisi pada semua perubahan */
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
            /* Menyusun card lebih ke atas */
        }

        .card-title {
            font-size: 28px;
            /* Ukuran font judul lebih besar */
            margin-bottom: 15px;
            /* Jarak antara judul dan teks */
        }

        .card-text {
            font-size: 30px;
            /* Ukuran font teks lebih besar */
            margin: 0;
            /* Menghilangkan margin default */
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 768px) {
            .card {
                font-size: 20px;
                /* Ukuran font yang lebih kecil di perangkat kecil */
                padding: 30px 15px;
                /* Mengurangi padding di perangkat kecil */
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
            <!-- Card 1: Total Tagihan -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm card-hover" style="height: 250px;">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-wallet2 text-primary" style="font-size: 40px;"></i>
                        <!-- Ikon uang dengan warna primary -->
                        <h5 class="card-title text-primary mt-3">Total Tagihan</h5> <!-- Teks judul dengan warna primary -->
                        <p class="card-text text-primary font-weight-bold" style="font-size: 30px;">Rp.
                            {{ number_format($totalTagihan) }}</p> <!-- Teks dengan warna primary -->
                    </div>
                </div>
            </div>

            <!-- Card 2: Total Instansi -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm card-hover" style="height: 250px;">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-building text-primary" style="font-size: 40px;"></i>
                        <!-- Ikon Gedung dengan warna primary -->
                        <h5 class="card-title text-primary mt-3">Total Instansi</h5>
                        <!-- Teks judul dengan warna primary -->
                        <p class="card-text text-primary font-weight-bold" style="font-size: 30px;">{{ $totalInstansi }}
                            Instansi</p> <!-- Teks dengan warna primary -->
                    </div>
                </div>
            </div>

            <!-- Card 3: Status Tagihan Menunggu Pembayaran -->
            <div class="col-md-4 mb-4">
                <div class="card text-center shadow-sm card-hover" style="height: 250px;">
                    <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <i class="bi bi-hourglass-split text-primary" style="font-size: 40px;"></i>
                        <!-- Ikon Jam dengan warna primary -->
                        <h5 class="card-title text-primary mt-3">Tagihan Menunggu Pembayaran</h5>
                        <!-- Teks judul dengan warna primary -->
                        <p class="card-text text-primary font-weight-bold" style="font-size: 30px;">
                            {{ $menungguPembayaranCount }} Tagihan</p> <!-- Teks dengan warna primary -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
