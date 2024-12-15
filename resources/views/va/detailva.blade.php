@extends('layouts.main')
@section('title', 'Data VA')

<style>
    table {
        font-size: 14px;
    }

    table th {
        background-color: white;
        color: black;
    }

    table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #3F51B5;
        border: none;
    }

    .card-body {
        padding: 15px;
    }

    .card-header {
        color: white;
        background-color: #3F51B5;

    }
</style>

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Daftar Request VA</strong></h2>
        <p class="text-center"><strong>Universitas Kristen Duta Wacana</strong></p>
        <br>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Data VA</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive" style="overflow-x: auto; max-width: 100%;">
                    <table class="table table-striped text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Instansi</th>
                            <th>NIM Mahasiswa</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nominal Tagihan</th>
                            <th>Tanggal Request</th>
                            <th>Jenis Layanan</th>
                            <th>Nomor VA</th>
                            <th>Status Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_instansi }}</td>
                                <td>{{ $item->id_mahasiswa }}</td>
                                <td>{{ $item->mahasiswa->nm_mhs ?? 'Nama tidak ditemukan' }}</td>
                                <td>Rp {{ number_format($item->jmlh_tgh, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>{{ $item->no_va }}</td>
                                <td>
                                    @if (is_null($item->status_transaksi))
                                        <span class="text-secondary"></span>
                                    @elseif($item->status_transaksi == 'Menunggu Pembayaran')
                                        <span class="text-info">Menunggu Pembayaran</span>
                                    @elseif($item->status_transaksi == 'Sudah Bayar')
                                        <span class="text-success">Sudah Bayar</span>
                                    @else
                                        <span class="text-danger">Gagal</span>
                                    @endif
                                </td>
                                <td>
                                    @if (is_null($item->no_va))
                                        <button class="btn btn-primary btn-sm process" data-id="{{ $item->id_tagihan }}">Proses</button>
                                    @else
                                        <span class="text-success">Berhasil Digenerate</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include DataTables JS and CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Popup JS -->
    <script>
        $(document).on('click', '.process', function(event) {
            const id = $(this).data('id');
            event.preventDefault();

            Swal.fire({
                title: 'Proses VA',
                text: `Anda akan memproses data dengan ID: ${id}`,
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Proses',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/va/generate/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Data berhasil diproses.'
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Terjadi kesalahan, coba lagi nanti.'
                            });
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "emptyTable": "Tidak ada data tersedia"
                }
            });
        });
    </script>
@endsection
