@extends('layouts.main')
@section('title', 'Data VA')

<style>
    table {
        font-size: 14px;
    }

    table th {
        background-color: #3F51B5;
        color: white;
    }

    table td {
        vertical-align: middle;
    }

    .btn-primary {
        background-color: #3F51B5;
        border: none;
    }
</style>

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Data VA</strong></h2>

    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-body">
            <!-- Table Data -->
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Universitas</th>
                        <th>Nama Universitas</th>
                        <th>Jenis Layanan</th>
                        <th>Total Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($instansi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kode_instansi }}</td>
                        <td>{{ $item->nm_instansi }}</td>
                        <td>Pembayaran</td>
                        <td>{{ $item->total_mahasiswa }}</td>
                        <td>
                            <center>
                                @if ($item->nm_instansi == 'Universitas Kristen Duta Wacana')
                                    <a href="{{ url('va/detailva') }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                                @else
                                    <button class="btn btn-primary btn-sm lihat-detail" data-nama="{{ $item->nm_instansi }}">
                                        Lihat Detail
                                    </button>
                                @endif
                            </center>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data ditemukan.</td>
                    </tr>
                    @endforelse
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

<script>
    $(document).ready(function() {
        // DataTable Initialization
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

        // Button Lihat Detail jika bukan Universitas Kristen Duta Wacana
        $('.lihat-detail').on('click', function() {
            const namaUniversitas = $(this).data('nama');
            Swal.fire({
                title: 'Informasi',
                text: `Data kosong untuk ${namaUniversitas}`,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
    });
</script>
@endsection
