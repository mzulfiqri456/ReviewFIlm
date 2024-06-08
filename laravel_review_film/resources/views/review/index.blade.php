@extends('admin.master')

@section('content')
    <h1>Data Review Film</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- <a href="{{ route('review.create') }}" class="btn btn-primary mb-3">Tambah Review</a> -->

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
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->user ? $review->user->name : 'Anonymous' }}</td>
                    <td>{{ $review->film->title }}</td>
                    <td>{{ $review->comment }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection