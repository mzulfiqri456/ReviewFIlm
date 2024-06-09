@extends('admin.master')

@section('content')
    <h1>Edit Data Kategori</h1>

    <form action="{{ route('kategori.update', $categories->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="name" value="{{ $categories->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
