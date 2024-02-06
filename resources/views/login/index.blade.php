<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/login.css">
  <title>Arsip-Polda | {{ $title }}</title>
</head>
<body>
  <div class="container">
    <div class="login">
      <form action="{{ route('postlogin') }}" method="post">
       @csrf
        <h1 style="font-family: Times New Roman, Times, serif;">Login</h1>
        <hr>
        <p style="font-family: Times New Roman, Times, serif;">Arsip Surat</p>
        <label for="username" style="font-family: Times New Roman, Times, serif;">Username</label>
        <input type="text"  value="{{ Session::get('username') }}" name="username" placeholder="Username" style="font-family: Times New Roman, Times, serif;">
        <label for="password" style="font-family: Times New Roman, Times, serif;">Password</label>
        <input type="password" name="password" placeholder="Password" style="font-family: Times New Roman, Times, serif;">
        <button name="submit" type="submit" style="font-family: Times New Roman, Times, serif;">Login now!</button>
        @if($errors->any())
        <div style="color:red;text-align:center;" role="alert">
          {{ $errors->first() }}
        </div>
        @endif
      </form>
    </div>
    <div class="right">
      <img src="image/polri.png" alt="polri">
    </div>
  </div>
</body>
</html>