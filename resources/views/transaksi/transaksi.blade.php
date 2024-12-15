@extends('layouts.main')
@section('title', 'Data Transaksi')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Daftar Transaksi</strong></h2>
        <br>
        <div class="card">
            <div class="card-header" style="background-color: #3F51B5; color: white;">
                <h5 class="mb-0">Daftar Transaksi</h5>
            </div>
            <div class="card-body">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Nama Mahasiswa</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Status Transaksi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->tagihan->instansi->nm_instansi ?? 'N/A' }}</td>
                                <td>{{ $data->tagihan->mahasiswa->nm_mhs ?? 'N/A' }}</td>
                                <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                <td>Rp. {{ number_format($data->jmlh_bayar, 0, ',', '.') }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    @if ($data->status_verifikasi == 'Belum Terverifikasi')
                                        <button type="button" class="btn btn-primary process" data-id="{{ $data->id_transaksi }}">
                                            Verifikasi
                                        </button>
                                    @else
                                        <span class="text-success">Sudah Terverifikasi</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verifikasiModalLabel">Konfirmasi Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin memverifikasi transaksi ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="verifikasiForm" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-primary">Verifikasi</button>
                    </form>
                </div>
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
        $(document).ready(function () {
            // Initialize DataTables
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

            // Handle Verifikasi button click with SweetAlert popup
            $(document).on('click', '.process', function(event) {
                const id = $(this).data('id');
                event.preventDefault();

                Swal.fire({
                    title: 'Verifikasi Data',
                    text: `Anda akan verifikasi data dengan ID: ${id}`,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Verifikasi',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/transaksi/verifikasi/${id}`,
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
        });
    </script>
@endsection
