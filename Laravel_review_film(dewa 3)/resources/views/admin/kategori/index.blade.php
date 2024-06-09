@extends('admin.master')

@section('content')
    <h1>Data Kategori</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">Tambah Data</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cg)
                <tr>
                    <td>{{ $cg->id }}</td>
                    <td>{{ $cg->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $cg->id) }}" class="btn btn-success">Edit</a>
                        <form action="{{ route('kategori.destroy', $cg->id) }}" method="POST" style="display: inline;">
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
