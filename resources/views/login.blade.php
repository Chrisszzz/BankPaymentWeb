<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
        flex-direction: column; /* Atur kolom untuk alert dan card */
    }
    .alert-container {
        width: 100%;
        max-width: 900px;
        margin-bottom: 20px;
        z-index: 1000;
        animation: fadeIn 0.5s ease-in-out; /* Animasi masuk */
    }
    .alert {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }
    .alert-icon {
        margin-right: 10px;
        font-size: 24px;
    }
    .card {
        width: 900px;
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
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #ffffff;
    }
    .card-form img {
        margin-bottom: 30px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .form-group {
        position: relative;
    }
    .form-control {
        height: 50px;
        border-radius: 5px;
        font-size: 15px;
        padding-right: 40px; /* Ruang untuk ikon mata */
    }
    .btn {
        background-color: #3F51B5;
        color: white;
        height: 50px;
        width: 100%;
        border-radius: 10px;
        font-size: 18px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    .btn:hover {
        background-color: #303F9F;
    }
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        font-size: 22px;
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
  </style>
</head>
<body>
  <!-- Bagian Alert -->
  @if ($errors->has('login_error'))
  <div class="alert-container">
    <div class="alert alert-danger">
      <span class="alert-icon glyphicon glyphicon-exclamation-sign"></span>
      {{ $errors->first('login_error') }}
    </div>
  </div>
  @endif

  <!-- Bagian Card -->
  <div class="card">
    <!-- Bagian Gambar -->
    <div class="card-image"></div>

    <!-- Bagian Form Login -->
    <div class="card-form">
      <img src="https://minang.geoparkrun.com/wp-content/uploads/2022/11/bca-logo.png" alt="Logo" width="120px">
      <form action="/" method="POST">
        @csrf
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" id="username" placeholder="Masukkan username" name="username" value="{{ old('username') }}">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password">
          <br>
          <span class="toggle-password glyphicon glyphicon-eye-open" onclick="togglePasswordVisibility()"></span>
        </div>
        <button type="submit" class="btn">
          Login
        </button>
      </form>
    </div>
  </div>

  <script>
    function togglePasswordVisibility() {
      const passwordField = document.getElementById('password');
      const toggleIcon = document.querySelector('.toggle-password');
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('glyphicon-eye-open');
        toggleIcon.classList.add('glyphicon-eye-close');
      } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('glyphicon-eye-close');
        toggleIcon.classList.add('glyphicon-eye-open');
      }
    }
  </script>
</body>
</html>
