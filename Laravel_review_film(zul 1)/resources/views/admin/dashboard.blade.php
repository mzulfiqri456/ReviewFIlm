@extends('admin.master')

@section('content')
    <h1>Dashboard</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Kategori</h5>
                    <p class="card-text">{{ $totalCategories }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Film</h5>
                    <p class="card-text">{{ $totalFilms }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Review</h5>
                    <p class="card-text">{{ $totalReviews }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection