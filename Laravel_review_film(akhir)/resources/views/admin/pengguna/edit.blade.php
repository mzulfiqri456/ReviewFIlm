@extends('admin.master')

@section('content')
    <h1>Edit Data Pengguna</h1>

    <form action="{{ route('pengguna.update', $pengguna->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" value="{{ $pengguna->name }}" required>
        </div>
        <div class="form-group">
            <label for="foto_profil">Foto Profil Baru:</label>
            <input type="file" name="foto_profil" class="form-control-file">
            @if ($pengguna->foto_profil)
                <p class="text-muted">Foto saat ini: {{ $pengguna->foto_profil }}</p>
                <img src="{{ asset('foto/foto_profil/' . $pengguna->foto_profil) }}" alt="Foto Profil" style="max-width: 200px;">
            @else
                <p class="text-muted">Tidak ada foto profil.</p>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $pengguna->email }}" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" value="{{ $pengguna->username }}" required>
        </div>
        <div class="form-group">
            <label for="password">Password Baru:</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" class="form-control" required>
                <option value="admin" {{ $pengguna->role == 'admin' ? 'selected' : '' }}>
                    Admin
                </option>
                <option value="pengguna" {{ $pengguna->role == 'pengguna' ? 'selected' : '' }}>
                    Pengguna
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

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
          @if ($errors->has('password'))
            <h2>Password</h2>
            Lengkapi password!
          @endif
      </div>
    </div>

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
@endsection