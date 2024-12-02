@extends('layouts.main')
@section('title', 'Data Manajemen Pembayaran')

@section('content')
<div class="loading" id="loading" style="display: none;">
    <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <h4>Loading</h4>
</div>
<div class="container mt-5">
    <h2 class="text-center mb-4"><strong>Data Manajemen Pembayaran</strong></h2>
    <br>
    <div class="row">
        <div class="col-lg-4 mb-3">
            <button type="button" class="btn btn-block block new" style="background: #3F51B5;color: white;">
                <i class="bi bi-plus"></i> Tambah Manajemen Manajemen
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header" style="background-color: #3F51B5; color: white;">
            <h5>Data Manajemen Pembayaran</h5>
        </div>
        <div class="card-body">
           <!--  <div class="row">
                <div class="col-lg-4 mb-3">
                    
                </div>
            </div> -->
            <table class="table table-striped" id="komponen_table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori Pembayaran</th>
                        <th>Deskripsi</th>
                        <th>Jumlah (Rp)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->kategori_komponen }}</td>
                        <td>{{ $item->deskripsi_komponen }}</td>
                        <td>Rp. {{ number_format($item->jumlah_komponen,0,",",".") }}</td>
                        <td>
                            <center><a href="javascript:void(0)" more_id="{{$item->id_komponen_pembayaran}}" class="btn edit btn-success btn-sm"><i class="bi bi-pencil-square"></i></a></center>
                            <center><a href="javascript:void(0)" more_id="{{$item->id_komponen_pembayaran}}" class="btn delete btn-danger btn-sm"><i class="bi bi-trash"></i></a></center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade text-left" data-bs-backdrop="static" id="modal_form_komponen" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1"></h5>
        </div>
        <div class="modal-body">
            <form method="post" id="komponenForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-form-label">Kategori Pembayaran <span class="text-danger">*</span></label>
                            <input type="text" hidden="" id="id_komponen_pembayaran" name="id_komponen_pembayaran">
                            <select class="form-control" required="" style="width: 100%;" name="kategori_komponen" id="kategori_komponen">
                                <option value="SKS">SKS</option>
                                <option value="ICE">ICE</option>
                                <option value="Uang Kesehatan">Uang Kesehatan</option>
                                <option value="Uang Gedung">Uang Gedung</option>
                                <option value="Denda telat/hari">Denda telat/hati</option>
                                <option value="Berprestasi Akademik">Berprestasi Akademik</option>
                                <option value="Berprestasi Non Akademik">Berprestasi Non Akademik</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-form-label">Jumlah (Rp) <span class="text-danger">*</span></label>
                            <input type="text" required="" class="form-control" name="jumlah_komponen" id="jumlah_komponen">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-form-label">Deskripsi/Kriteria <span class="text-danger">*</span></label>
                            <textarea class="form-control" required="" rows="4" id="deskripsi_komponen" name="deskripsi_komponen"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">
                    <span>Tutup</span>
                </button>
                <button class="btn btn-primary ml-1 submit">
                    <i class="bx bx-save"></i> <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $("#kategori_komponen").select2({
        placeholder: ".: PILIH KATEGORI :.",
        dropdownParent: $("#modal_form_komponen")
    });
    $('#komponen_table').DataTable({
        processing: true,
        pageLength: 10,
        responsive: true
    });
    $(document).on('keyup', '#jumlah_komponen', function() {
        let nominal = $(this).val();
        $("#jumlah_komponen").val(formatRupiah(nominal));
    });
    function formatRupiah(angka) {
        let number_string = String(angka).replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
        return rupiah ? "Rp " + rupiah : "";
    }
    var ajaxUrl = "";
    $(".new").click(function() {
        $("#komponenForm")[0].reset();
        $(".modal-title").html('<i class="bi bi-plus"></i> Tambah Manajemen Pembayaran');
        $(".submit").html('<i class="bi bi-save"></i> Simpan');
        $("#kategori_komponen").val(null).trigger('change');
        $("#modal_form_komponen").modal('show');
        ajaxUrl = " {{route('save_komponen_pembayaran')}} ";
    });
    $(function () {
        $('#komponenForm').submit(function(e) {
            e.preventDefault();
            if ($(this).data('submitted') === true) {
                return;
            }
            $(this).data('submitted', true);
            let formData = new FormData(this);
            $("#loading").show();
            $.ajax({
                method: "POST",
                headers: {
                    Accept: "application/json"
                },
                contentType: false,
                processData: false,
                url: ajaxUrl,
                data: formData,
                success: function (response) {
                    $('#komponenForm').data('submitted', false);
                    $("#loading").hide();
                    if (response.status == 'true') {
                        $("#komponenForm")[0].reset();
                        $('#modal_form_komponen').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            type: 'success',
                            title: 'Success',
                            text: response.message
                        }).then((result) => {
                          if (result.isConfirmed) {
                            document.location.href = "";
                        }
                    });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Gagal',
                            dangerMode: true,
                            text: response.message
                        });
                    }
                },
                error: function (response) {
                    $('#komponenForm').data('submitted', false);
                    $("#loading").hide();
                    swal({
                        icon: 'error',
                        type: 'error',
                        title: 'Gagal',
                        dangerMode: true,
                        text: response.message
                    });
                }
            });
        });
    });
    function get_edit(komponenID) {
        $.ajax({
            type: "GET",
            url: "{{url('manajemen_pembayaran/get_edit')}}"+"/"+komponenID,
            success: function(response) {
                if (response) {
                    $("#loading").hide();
                    $.each(response, function(key, value) {
                        $("#id_komponen_pembayaran").val(value.id_komponen_pembayaran);
                        $("#kategori_komponen").val(value.kategori_komponen).trigger('change');
                        $("#jumlah_komponen").val(formatRupiah(value.jumlah_komponen));
                        $("#deskripsi_komponen").val(value.deskripsi_komponen);
                    });
                }
            },
            error: function(response) {
                get_edit(komponenID);
            }
        });
    }
    $(document).on('click','.edit',function() {
        $("#loading").show();
        var komponenID = $(this).attr('more_id');
        $("#komponenForm")[0].reset();
        $(".modal-title").html('<i class="bi bi-pencil-square"></i> Ubah Manajemen Pembayaran');
        $(".submit").html('<i class="bi bi-pencil-square"></i> Ubah');
        $(".invalid-feedback").children("strong").text("");
        $("#komponenForm input").removeClass("is-invalid");
        $("#komponenForm select").removeClass("is-invalid");
        $("#komponenForm textarea").removeClass("is-invalid");
        $("#kategori_komponen").val(null).trigger('change');
        $("#modal_form_komponen").modal('show');
        ajaxUrl = " {{route('update_komponen_pembayaran')}} ";
        if (komponenID) {
            get_edit(komponenID);
        }
    });
    $(document).on('click', '.delete', function (event) {
        komponenID = $(this).attr('more_id');
        event.preventDefault();
        Swal.fire({
            title: 'Lanjut Hapus Data?',
            text: 'Data Manajemen Pembayaran akan dihapus secara Permanent!',
            icon: 'warning',
            type: 'warning',
            showCancelButton: !0,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: 'Lanjutkan'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "{{url('manajemen_pembayaran/delete')}}"+"/"+komponenID,
                    success: function(response) {
                        if (response.status == 'true') {
                            Swal.fire({
                                icon: 'success',
                                type: 'success',
                                title: 'Success',
                                text: response.message
                            }).then((result) => {
                              if (result.isConfirmed) {
                                document.location.href = "";
                            }
                        });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                type: 'error',
                                title: 'Terjadi kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Gagal',
                            dangerMode: true,
                            text: 'Terjadi kesalahan!'
                        });
                    }
                });
            }
        });
    });
</script>
@endsection
