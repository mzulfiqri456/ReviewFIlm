@extends('layout.master')

@section('content')
    <h1>Edit Data Game</h1>

    <form action="{{ route('game.update', $game->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="name" value="{{ $game->name }}" required>
        </div>
        <div class="mb-3">
            <label for="gameplay" class="form-label">Gameplay</label>
            <input type="text" class="form-control" id="gameplay" name="gameplay" value="{{ $game->gameplay }}" required>
        </div>
        <div class="mb-3">
            <label for="developer" class="form-label">Pengembang</label>
            <input type="text" class="form-control" id="developer" name="developer" value="{{ $game->developer }}" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <input type="number" class="form-control" id="year" name="year" value="{{ $game->year }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
