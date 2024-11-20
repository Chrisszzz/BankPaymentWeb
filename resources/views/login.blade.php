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
    .login-container
    {
        display: flex;
        height: 100vh;
        margin: 0;
    }

    .login-image
    {
        flex: 1;
        background-image: url({{ asset('https://st3.depositphotos.com/9042388/18207/v/450/depositphotos_182073696-stock-illustration-cityscape-with-modern-office-buildings.jpg') }});
        background-size: cover;

    }

    .login-form
    {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    </style>
</head>
<body>

    @if ($errors->has('login_error'))
    <div class="alert alert-danger">
        {{ $errors->first('login_error') }}
    </div>
    @endif

<div class="login-container">
  <div class="login-image"></div>
  <div class="login-form">
    <div class="container" style="max-width: 500px;">
      <img src="{{ asset ('https://minang.geoparkrun.com/wp-content/uploads/2022/11/bca-logo.png')}}" width="200px" height="200px";>
      <form action="/" method="POST">
        @csrf
        <div class="form-group">
            <label for="text">Username:</label>
            <input type="text" class="form-control" id="username" placeholder="Masukan username" name="username" style="height: 56px;">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Masukan password" name="password" style="height: 56px;">
        </div>
        <div class="text-center">
            <button type="submit" class="btn" style="background-color:#3F51B5; color: white; height: 40px; width: 472px; border-radius: 5px; font-size: 15px;">
                <b>LOGIN</b>
            </button>
        </div>
    </form>
    </div>
  </div>
</div>
</body>
</html>
