@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="text-center mb-4"><strong>Log Transaksi</strong></h2>

    <!-- Form Filter -->
    <form method="GET" action="{{ route('logtransaksi') }}">
        <div class="row mb-3">
            <div class="col-md-2">
                <label for="tanggal_dari">Tanggal Awal</label>
                <input type="date" name="tanggal_dari" id="tanggal_dari" class="form-control" value="{{ request('tanggal_dari') }}">
            </div>
            <div class="col-md-2">
                <label for="tanggal_sampai">Tanggal Akhir</label>
                <input type="date" name="tanggal_sampai" id="tanggal_sampai" class="form-control" value="{{ request('tanggal_sampai') }}">
            </div>
            <div class="ms-2 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('logtransaksi') }}" class="btn btn-secondary ms-2">Reset</a>
            </div>
        </div>
    </form>

    <!-- Tabel Data dengan DataTable -->
    <div class="card">
        <div class="card-header" style="background-color: #3F51B5; color: white;">
            <h5 class="mb-0">Log Transaksi</h5>
        </div>
        <div class="card-body">
            <table id="logTransaksiTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No. VA</th>
                        <th>Nama Mahasiswa</th>
                        <th>Nama Instansi</th>
                        <th>Jenis Tagihan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Total Bayar</th>
                        <th>Status Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $data)
                        <tr>
                            <td>{{ $data['no_va'] }}</td>
                            <td>{{ $data['nama_mahasiswa'] }}</td>
                            <td>{{ $data['nama_instansi'] }}</td>
                            <td>{{ $data['jenis_tagihan'] }}</td>
                            <td>{{ $data['tanggal_transaksi'] }}</td>
                            <td>{{ $data['total_bayar'] }}</td>
                            <td>{{ $data['status_transaksi'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <button id="exportPdfBtn" class="btn btn-primary">Export PDF</button>
        </div>
    </div>
</div>

 <!-- Include DataTables JS and CSS -->
 <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTable dan Popup JS -->
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#logTransaksiTable').DataTable({
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

        // Popup Konfirmasi Export PDF
        $('#exportPdfBtn').on('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Export Data',
                text: 'Data Transaksi akan di export ke PDF',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Export',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('logtransaksi.exportpdf', request()->all()) }}";
                }
            });
        });
    });
</script>
@endsection
