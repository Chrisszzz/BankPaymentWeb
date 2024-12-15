@extends('layouts.main')
@section('title', 'Data Instansi')

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

    .btn-primary,
    .btn-secondary {
        background-color: #3F51B5;
        border: none;
    }

    .btn-primary:hover,
    .btn-secondary:hover {
        background-color: #303F9F;
    }

    .search-bar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        /* Untuk memastikan responsif */
    }

    .search-bar-container form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-control {
        max-width: 250px;
        /* Sesuaikan agar search bar tidak terlalu panjang */
    }

    .search-bar-container .btn {
        display: inline-flex;
        align-items: center;
    }

    .search-bar-container .btn i {
        margin-right: 5px;
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4"><strong>Data Instansi</strong></h2>

        <!-- Baris Search dan Tambah -->
        <div class="search-bar-container">
            <!-- Tombol Tambah Instansi -->
            <a href="/instansi/create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Data
            </a>
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                });
            </script>
        @endif

        <!-- Card Container -->
        <div class="card">
            <div class="card-body">
                <!-- Tabel Data -->
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Universitas</th>
                            <th>Nama Universitas</th>
                            <th>Total Mahasiswa</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($instansi as $key => $data)
                            <tr>
                                <td>{{ $instansi->firstItem() + $key }}</td>
                                <td>{{ $data->kode_instansi }}</td>
                                <td>{{ $data->nm_instansi }}</td>
                                <td>{{ $data->total_mahasiswa }}</td>
                                <td>{{ $data->tgl_mulai_kerjasama }}</td>
                                <td>{{ $data->tgl_akhir_kerjasama }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="/instansi/edit/{{ $data->id }}"
                                            class="btn btn-success d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger delete" data-id="{{ $data->id }}"
                                            style="width: 40px; height: 40px;">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambahkan referensi DataTables dan SweetAlert -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "ordering": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });

            $(document).on('click', '.delete', function(event) {
                const id = $(this).data('id');
                event.preventDefault();

                Swal.fire({
                    title: 'Lanjut Hapus Data?',
                    text: 'Data ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/instansi/delete/${id}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data berhasil dihapus.'
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
