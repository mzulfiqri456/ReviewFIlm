<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Kritik Film</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/all.min.css" />
    <style>
      .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
      }
      .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        left:200px;
        padding: 20px;
        border: 1px solid #888;
        width: 50%;
      }
      .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }
      .close:hover,
      .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="title"><span>Kritik Film - Registrasi</span></div>
      <form action="/registrasi" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required />
        </div>
        <div class="row">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
        </div>
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Username" value="{{ old('username') }}" required />
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="row">
          <i class="fas fa-image"></i>
          <input type="file" name="foto_profil" accept="image/*" class="custom-file-input" />
        </div>
        <div class="row button">
          <input type="submit" value="Registrasi" />
        </div>
        <div class="signup-link">Sudah punya akun? <a href="/login">Login Disini</a>.</div>
      </form>
    </div>
    <!-- Modal Pesan Kesalahan -->
    <div id="errorModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
          @if ($errors->has('email'))
            <h2>Email</h2>
            Email sudah digunakan!
          @endif
          @if ($errors->has('username'))
            <h2>Username</h2>
            Username sudah digunakan!
          @endif
      </div>
    </div>
    <!-- Modal Pesan Kesalahan -->
    <script>
      var modal = document.getElementById("errorModal");
      var span = document.getElementsByClassName("close")[0];

      span.onclick = function() {
        modal.style.display = "none";
      }

      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
      
      @if ($errors->any())
        window.onload = function() {
          modal.style.display = "block";
        }
      @endif
    </script>
  </body>
</html>