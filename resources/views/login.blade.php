<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    .card {
      width: 900px; /* Perbesar ukuran card */
      max-width: 100%;
      display: flex;
      flex-direction: row;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 30px;
    }
    .card-image {
      flex: 1;
      background-image: url('https://img.freepik.com/premium-vector/mobile-banking-online-payment-concept-people-using-laptop-mobile-smartphone_566886-10835.jpg?w=740');
      background-size: cover;
      background-position: center;
    }
    .card-form {
      flex: 1;
      padding: 40px; /* Tambahkan padding agar lebih nyaman */
      display: flex;
      flex-direction: column;
      justify-content: center;
      background-color: #ffffff;
    }
    .card-form img {
      margin-bottom: 30px; /* Tambahkan jarak antara logo dan form */
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .form-group label {
      font-size: 16px; /* Perbesar ukuran font label */
      font-weight: bold;
    }
    .form-control {
      height: 50px; /* Sedikit perbesar input */
      border-radius: 5px;
      font-size: 15px;
    }
    .btn {
      background-color: #3F51B5;
      color: white;
      height: 50px; /* Perbesar tombol */
      width: 100%;
      border-radius: 10px;
      font-size: 18px; /* Perbesar teks tombol */
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
      background-color: #303F9F;
    }
  </style>
</head>
<body>
  @if ($errors->has('login_error'))
  <div class="alert alert-danger text-center" style="margin-bottom: 20px;">
    {{ $errors->first('login_error') }}
  </div>
  @endif

  <div class="card">
    <!-- Bagian Gambar -->
    <div class="card-image"></div>

    <!-- Bagian Form Login -->
    <div class="card-form">
      <img src="https://minang.geoparkrun.com/wp-content/uploads/2022/11/bca-logo.png" alt="Logo" width="120px">
      <form id="loginForm" method="POST">
        @csrf
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" required="" id="username" placeholder="Masukkan username" name="username">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" required="" id="password" placeholder="Masukkan password" name="password">
        </div>
        <button type="submit" class="btn submit_login">
          Login
        </button>
      </form>
    </div>
  </div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
  $(function () {
    $('#loginForm').submit(function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      $(".submit_login").attr('disabled',true);
      $.ajax({
       method: "POST",
       headers: {
        Accept: "application/json"
      },
      contentType: false,
      processData: false,
      url: " {{route('authenticate.login')}} ",
      data: formData,
      success: function(response) {
        $(".submit_login").attr('disabled',false);
        if(response.status == 'true') {
          Swal.fire({
            icon: 'success',
            type: 'success',
            title: 'Success',
            text: response.message
          }).then((result) => {
            if (result.isConfirmed) {
              document.location.href = response.url;
            }
          });
        } else if (response.status == 'false') {
          Swal.fire({
            icon: "warning",
            type: "warning",
            title: 'Login Gagal',
            text: response.message
          });
        }else{
          Swal.fire({
            icon: "error",
            type: "error",
            title: 'Error',
            text: 'Terjadi Kesalahan [Permintaan data tidak dikirim]'
          });
        }
      },
      error: function(response) {
        $(".submit_login").attr('disabled',false);
        Swal.fire({
          icon: "error",
          type: "error",
          title: 'Error',
          text: 'Terjadi Kesalahan [Permintaan data tidak dikirim]'
        });
      }
    });     
    }); 
  }); 
</script>
</html>
