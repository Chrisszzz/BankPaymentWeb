<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <!-- Google font -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
  href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,900;1,400;1,500;1,600&display=swap"
  rel="stylesheet">
  <style>
    body {
      font-family: "Inter", sans-serif;
      background-color: #f8f9fa;
    }
    .select2-hidden-accessible + .select2-container .select2-selection {
      height: 36px;
      padding-top: 2px;
    }
    .select2-hidden-accessible + .select2-container .select2-selection__arrow, .select2-hidden-accessible + .select2-container .select2-selection_clear{
      height: 40px;
    }
    select[readonly].select2-hidden-accessible + .select2-container {
      pointer-events: none;
      touch-action: none;
    }
    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
      background: #e8ebed;
      box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection_clear {
      display: none;
    }
    .is-invalid:valid + .select2 .select2-selection{
      border-color: #dc3545!important;
    }
    *:focus{
      outline:0px;
    }
    #loading {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 255, 255, 0.5);
      z-index: 9999;
      text-align: center;
    }
    @media (min-width: 801px) {
      #loading{
        padding-top: 20%;
      }
    }
    @media (max-width: 800px) {
      #loading{
        padding-top: 80%;
      }
    }

    .sidebar {
      background-color: #3F51B5;
      color: white;
    }

    .sidebar .logo {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .sidebar .menu a {
      text-decoration: none;
      display: block;
      padding: 10px 15px;
      border-radius: 4px;
      font-size: 14px;
    }

    .sidebar .menu a:hover {
      background-color: #638fd1;
      padding: 10px;
      border-radius: 5px;
    }

    .sidebar .menu a.bg-primary {
      background-color: #0d6efd !important;
      /* Warna latar belakang biru */
      color: white;
      /* Pastikan teks tetap putih */
      font-weight: bold;
      /* Membuat teks lebih tebal di menu aktif */
    }


    .header {
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .header .user-info {
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }

    .header .user-info img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .header .user-info span {
      font-size: 14px;
      font-weight: bold;
    }

    .content {
      min-height: 100vh;
      /* Menyesuaikan tinggi layar penuh */
      overflow-y: auto;
      /* Menambahkan scroll jika konten terlalu panjang */
    }

    /* Menambahkan efek hover pada card */
    .card-hover {
      transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
      transform: scale(1);
    }

    .card-hover:hover {
      transform: scale(1.1);
      /* Memperbesar card saat hover */
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      /* Efek bayangan */
    }

    /* Styling untuk card */
    .card-header {
      background-color: #3F51B5;
    }
  </style>
</head>

<body>
  <div class="d-flex flex-column flex-md-row vh-100">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column flex-shrink-0 p-3"
    style="width: 250px; min-height: 100vh; overflow-y: auto;">
    <div class="logo text-center mb-4">
      <img src="https://www.freepnglogos.com/uploads/logo-bca-png/bca-online-digital-printing-company-jakarta-mediakreasi-12.png"
      width="150" height="120" alt="Logo" class="img-fluid">
    </div>
    <div class="menu">
      <a href="/home" class="d-block py-2 text-white {{ request()->is('home') ? 'bg-primary' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
      </a>
      <a href="/instansi" class="d-block py-2 text-white {{ request()->is('instansi') ? 'bg-primary' : '' }}">
        <i class="bi bi-building"></i> Data Instansi
      </a>
      <a href="/va" class="d-block py-2 text-white {{ request()->is('va') ? 'bg-primary' : '' }}">
        <i class="bi bi-card-list"></i> Data VA
      </a>
      <a href="/transaksi"
      class="d-block py-2 text-white {{ request()->is('transaksi') ? 'bg-primary' : '' }}">
      <i class="bi bi-building"></i> Data Transaksi
    </a>
    <a href="/logtransaksi" class="d-block py-2 text-white {{ request()->is('reports') ? 'bg-primary' : '' }}">
      <i class="bi bi-file-bar-graph"></i> Log Transaksi
    </a>
    <a href=" {{route('index.komponen_pembayaran')}} "
    class="d-block py-2 text-white {{ request()->is('manajemen_pembayaran') ? 'bg-primary' : '' }}">
    <i class="bi bi-building"></i> Manajemen Pembayaran
  </a>
</div>

<div class="footer mt-auto pt-5">
  <p class="text-white">ADMINISTRATOR</p>
  <p class="text-white">Admin01</p>
</div>
</div>

<!-- Content Area -->
<div class="content flex-grow-1">
  <!-- Header -->
  <div class="header bg-light d-flex align-items-center justify-content-end px-4 py-2">
   <!--  <div class="user-info d-flex align-items-center">
      <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-circle">
      <span class="ml-2 font-weight-bold">{{Auth::user()->name}}</span>
    </div> -->
    <div class="dropdown">
      <a class="dropdown-toggle" style="text-decoration: none;color: black;" href="javascript:void(0)" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="https://via.placeholder.com/40" alt="User Avatar" class="rounded-circle">
        <span class="ml-2 font-weight-bold">{{Auth::user()->name}}</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item btn_my_profil" href="javascript:void(0)">Profil Saya</a>
        <a class="dropdown-item" href=" {{route('logout')}} ">Logout</a>
      </div>
    </div>
  </div>
  <!-- profil -->
  <div class="modal fade text-left" data-bs-backdrop="static" id="modal_my_profil" tabindex="-1" role="dialog"
  aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info" style="color: white;">
        <h5 class="modal-title text-white" id="myModalLabel1"></h5>
      </div>
      <div class="modal-body">
       <form method="post" id="myProfilForm" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label class="col-form-label">Nama <span class="text-danger">*</span></label>
              <input type="text" required="" class="form-control" value="{{Auth::user()->name}}" id="name" name="name">
            </div>
          </div>
          <div class="col-12">
            <div class="form-group">
              <label class="col-form-label">Username <span class="text-danger">*</span></label>
              <input type="text" required="" class="form-control" value="{{Auth::user()->email}}" id="email" name="email">
            </div>
          </div>
          <div class="col-12">
            <div class="mb-3 form-password-toggle">
             <div class="d-flex justify-content-between">
              <label class="col-form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge">
              <input type="text" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-loading" id="modal-loading" style="display: none;">
      <span class="fa fa-spinner fa-pulse fa-3x"></span>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn" data-dismiss="modal">
        <span>Tutup</span>
      </button>
      <button class="btn btn-primary ml-1 submit">
        <i class="bx bx-save"></i> <span>Simpan Profil</span>
      </button>
    </div>
  </form>
</div>
</div>
</div>
<!-- end profil -->
<!-- Main Content -->
<div class="main-content p-5">
  @yield('content')
</div>
</div>
</div>

<!-- Bootstrap JS -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
@yield('scripts')
<script type="text/javascript">
  $(".btn_my_profil").click(function() {
    $(".modal-title").html('<i class="bx bx-user"></i> Ubah Profil');
    $("#modal_my_profil").modal('show');
  });
  $(function () {
    $('#myProfilForm').submit(function (e) {
      e.preventDefault();
      if ($(this).data('submitted') === true) {
        return;
      }
      $("#loading").show();
      $(this).data('submitted', true);
      let formData = new FormData(this);
      $.ajax({
        method: "POST",
        headers: {
          Accept: "application/json"
        },
        contentType: false,
        processData: false,
        url : "{{route('update_profil')}}",
        data: formData,
        success: function (response) {
          $('#myProfilForm').data('submitted', false);
          $("#loading").hide();
          if (response.status == 'true') {
           Swal.fire({
            title: 'Profil Success',
            text: response.message,
            icon: 'success',
            type: 'success'
          }).then((result) => {
            if (result.isConfirmed) {
             document.location.href = "";
           }
         });
        } else {
          showToast('bg-danger','Profil Error',response.message);
        }
      },
      error: function (response) {
        $("#loading").hide();
        $('#myProfilForm').data('submitted', false);
        showToast('bg-danger','Profil Error',response.message);
      }
    });
    });
  });
</script>
</html>
