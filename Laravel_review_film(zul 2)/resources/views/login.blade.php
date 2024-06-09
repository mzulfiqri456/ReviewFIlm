<!DOCTYPE html>
<!-- Website - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Kritik Film</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.min.css"
    />
  </head>
  <body>
    <div class="wrapper">
      <div class="title"><span>Kritik Film</span></div>
      <form action="/login" method="post">
        @csrf
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Username" required />
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="row button">
          <input type="submit" value="Login" />
        </div>
        <div class="signup-link">Belum mendaftar? <a href="/registrasi">Daftar Disini</a>.</div>
      </form>
    </div>
  </body>
</html>