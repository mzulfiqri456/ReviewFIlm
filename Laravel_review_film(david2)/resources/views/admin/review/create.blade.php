@extends('admin.master')

@section('content')
    <h1>Review Film</h1>

    <form action="{{ route('review.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="film">Pilih Film:</label>
            <select name="movie_id" class="form-control" required>
                <option value="">Pilih Film</option>
                @foreach($movies as $film)
                    <option value="{{ $film->id }}">{{ $film->title }}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="user_id" id="user_id" value="1" required>
        <div class="form-group">
            <label for="comment">Review:</label>
            <textarea name="comment" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <div id="rating"></div>
            <input type="hidden" name="rating" id="rating_input" required>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
        <a href="{{ route('review.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <!-- Load RateYo Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <!-- Initialize RateYo -->
    <script>
        $(function () {
            $("#rating").rateYo({
                rating: 0, // Nilai awal rating
                fullStar: true, // Menggunakan bintang penuh
                onSet: function (rating, rateYoInstance) {
                    $("#rating_input").val(rating); // Set nilai rating pada input tersembunyi
                }
            });
        });
    </script>
@endsection