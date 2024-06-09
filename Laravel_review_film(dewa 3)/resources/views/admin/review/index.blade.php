@extends('admin.master')

@section('content')
    <h1>Data Review Film</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('review.create') }}" class="btn btn-primary mb-3">Tambah Review</a>

    <table class="table">
        <thead>
            <tr>
                <th>Reviewer</th>
                <th>Film</th>
                <th>Review</th>
                <th>Rating</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $rv)
                <tr>
                    <td>{{ $rv->user ? $rv->user->name : 'Anonymous' }}</td>
                    <td>{{ $rv->film->title }}</td>
                    <td>{{ $rv->comment }}</td>
                    <td>{{ $rv->rating }}</td>
                    <td>{{ $rv->created_at->format('d-m-Y H:i:s') }}
                        <form action="{{ route('review.destroy', $rv->id) }}" method="POST" style="display: inline;">
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