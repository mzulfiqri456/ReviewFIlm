@extends('admin.master')

@section('content')
    <h1>Tambah Data Film</h1>

    <form action="{{ route('film.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Judul:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="release_date">Tanggal Rilis:</label>
            <input type="date" name="release_date" class="form-control" required>
        </div>
        <div id="genre-container">
            <div class="form-group genre-group">
                <label for="genre_1">Genre 1:</label>
                <select name="genre[]" class="form-control" required>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-add-genre">Tambah Genre</button>

        <div class="form-group">
            <label for="director">Director:</label>
            <input type="text" name="director" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <div id="rating"></div>
            <input type="hidden" name="rating" id="rating_input" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('film.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        // Logika untuk menangani tombol "Kurangi Genre"
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-remove-genre')) {
                event.preventDefault();
                event.target.parentNode.remove();
            }
        });

        function addGenre() {
            var container = document.getElementById('genre-container');
            var newGenreGroup = document.createElement('div');
            newGenreGroup.classList.add('form-group', 'genre-group');
            newGenreGroup.innerHTML = `
                <label for="genre_${container.children.length + 1}">Genre ${container.children.length + 1}:</label>
                <select name="genre[]" class="form-control" required>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-danger btn-remove-genre">Kurangi Genre</button>
            `;
            container.appendChild(newGenreGroup);
        }

        // Fungsi untuk menghapus elemen genre
        function removeGenre(event) {
            var genreGroup = event.target.closest('.genre-group');
            if (genreGroup) {
                genreGroup.remove();
            }
        }

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-add-genre')) {
                addGenre();
            }
            if (event.target.classList.contains('btn-remove-genre')) {
                removeGenre(event);
            }
        });
    </script>
@endsection
