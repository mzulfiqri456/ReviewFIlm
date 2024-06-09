@extends('admin.master')

@section('content')
    <h1>Data Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('film.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Tanggal Rilis</th>
                <th>Kategori</th>
                <th>Director</th>
                <th>Rating</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movies as $mv)
                <tr>
                    <td>{{ $mv->id }}</td>
                    <td>{{ $mv->title }}</td>
                    <td>{{ Str::limit($mv->description, 15) }}</td>
                    <td>{{ $mv->release_date }}</td>
                    <td>{{ $mv->genre }}</td>
                    <td>{{ $mv->director }}</td>
                    <td>{{ $mv->rating }}</td>
                    <td>
                        <a href="{{ route('film.edit', $mv->id) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('film.destroy', $mv->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection