@extends('layout.master')

@section('content')
    <h1>Detail Game</h1>
    <div class="card">
        <div class="card-body">
            <p class="nama"><strong>Nama:</strong> {{ $games->name }}</p>
            <p class="gameplay"><strong>Gameplay:</strong> {{ $games->gameplay }}</p>
            <p class="developer"><strong>Pengembang:</strong> {{ $games->developer }}</p>
            <p class="year"><strong>Tahun:</strong> {{ $games->year }}</p>
        </div>
    </div>

    <a href="{{ route('game.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Game</a>
@endsection
