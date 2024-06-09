@extends('admin.master')

@section('content')
    <h1>Tambah Data Pengguna</h1>

    <form action="{{ route('pengguna.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto_profil">Foto Profil:</label>
            <input type="file" name="foto_profil" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group" id="genre-group-1">
            <label for="role">Role:</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="pengguna">Pengguna</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection