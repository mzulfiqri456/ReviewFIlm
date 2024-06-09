@extends('admin.master')

@section('content')
    <h1>Detail Pengguna</h1>
    <div class="card">
        <div class="card-body">
            @if ($pengguna->foto_profil)
                <p><strong>Foto Profil saat ini:</strong> {{ $pengguna->foto_profil }}</p>
                <img src="{{ asset('foto/foto_profil/' . $pengguna->foto_profil) }}" alt="Foto Profil" style="max-width: 200px;">
            @else
                <p class="text-muted">Tidak ada foto profil.</p>
            @endif
            <p><strong>Nama:</strong> {{ $pengguna->name }}</p>
            <p><strong>Email:</strong> {{ $pengguna->email }}</p>
            <p><strong>Username:</strong> {{ $pengguna->username }}</p>
            <p><strong>Role:</strong> {{ $pengguna->role }}</p>
        </div>
    </div>

    <a href="{{ route('pengguna.index') }}" class="btn btn-primary mt-3">Kembali ke Data Pengguna</a>
@endsection