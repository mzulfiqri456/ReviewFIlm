@extends('admin.master')

@section('content')
    <h1>Edit Data Film</h1>

    <form action="{{ route('film.update', $movies->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Judul:</label>
            <input type="text" name="title" class="form-control" value="{{ $movies->title }}" required>
        </div>
        <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" name="foto" class="form-control-file">
            @if ($movies->foto)
                <p class="text-muted">Foto saat ini: {{ $movies->foto }}</p>
                <img src="{{ asset('foto/' . $movies->foto) }}" alt="Foto Film" style="max-width: 200px;">
            @else
                <p class="text-muted">Tidak ada foto untuk film ini.</p>
            @endif
        </div>
        <div class="form-group">
            <label for="description">Deskripsi:</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $movies->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="release_date">Tanggal Rilis:</label>
            <input type="date" name="release_date" class="form-control" value="{{ $movies->release_date }}" required>
        </div>

        <div id="genre-container">
            @foreach($filmGenres as $index => $genreId)
                <div class="form-group genre-group" id="genre-group">
                    <label for="genre_{{ $index + 1 }}">Kategori {{ $index + 1 }}:</label>
                    <select name="genre[]" class="form-control" required>
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" {{ $genre->id == $genreId ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-danger btn-remove-genre">Hapus</button>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-primary btn-add-genre">Tambah Genre</button>
        <div class="form-group">
            <label for="director">Director:</label>
            <input type="text" name="director" class="form-control" value="{{ $movies->director }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('film.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    @push('scripts')
    <script>
        $(document).ready(function() {
            var genreIndex = {{ count($filmGenres) }}; // Menghitung jumlah genre yang sudah ada

            $('.btn-add-genre').click(function() {
                genreIndex++;
                addGenreField(genreIndex);
            });

            $(document).on('click', '.btn-remove-genre', function() {
                var genreGroup = $(this).closest('.genre-group');
                // Memeriksa apakah jumlah dropdown genre adalah 1
                if ($('.genre-group').length > 1) {
                    genreGroup.remove();
                    updateGenreIndex(); // Memanggil fungsi untuk mengupdate genreIndex setelah penghapusan
                } else {
                    alert("Minimal harus ada 1 genre.");
                }
            });

            function addGenreField(index) {
                var newGenreGroup = `
                    <div class="form-group genre-group" id="genre-group-${index}">
                        <label for="genre_${index}">Kategori ${index}:</label>
                        <select name="genre[]" class="form-control" required>
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-danger btn-remove-genre">Kurangi</button>
                    </div>
                `;
                $('#genre-container').append(newGenreGroup);
                updateGenreIndex(); // Memanggil fungsi untuk mengupdate genreIndex setelah penambahan
            }

            function updateGenreIndex() {
                // Mengupdate genreIndex berdasarkan jumlah dropdown genre yang tersisa
                $('.genre-group').each(function(index) {
                    $(this).find('label').text(`Kategori ${index + 1}:`);
                    $(this).attr('id', `genre-group-${index + 1}`);
                });
                genreIndex = $('.genre-group').length;
            }
        });
    </script>
    @endpush
@endsection
