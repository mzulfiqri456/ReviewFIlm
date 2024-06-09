<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ $film->title }} | Krtik Film</title>
	<link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/templatemo-xtra-blog.css') }}" rel="stylesheet">
</head>
<body>
<header class="tm-header" id="tm-header">
    <div class="tm-header-wrapper">
        <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="tm-site-header">
            <h1 class="text-center">Kritik Film</h1><br>
            <h4 class="text-center">
                @if (Auth::check())
                    <p style="color:white;border: 2px solid #ffffff; border-radius:5px;">{{ Auth::user()->name }}</p>
                @else
                    <a href="/login" class="btn-white btn">
                        Login
                    </a>
                @endif
            </h4>
        </div>
        <nav class="tm-nav" id="tm-nav">
            <ul>
                <li class="tm-nav-item active"><a href="/review_film" class="tm-nav-link">
                        <i class="fas fa-home"></i>
                        Beranda
                    </a></li>
                <li class="tm-nav-item"><a href="/about" class="tm-nav-link">
                        <i class="fas fa-users"></i>
                        Tentang
                    </a></li>
                <li class="tm-nav-item"><a href="/contact" class="tm-nav-link">
                        <i class="far fa-comments"></i>
                        Kontak Kami
                    </a></li>
            </ul>
        </nav>
        <p class="tm-mb-80 pr-5 text-white text-center">
                @if (Auth::check())
                    @if (Auth::user()->role === 'admin')
                        <a href="/dashboard" class="btn-white btn" style="margin-bottom: 10px;">
                            Sistem Informasi
                        </a>
                        <a href="/keluar" class="btn-white btn">
                            Logout
                        </a>
                    @else
                        <a href="/keluar" class="btn-white btn">
                            Logout
                        </a>
                    @endif
                @else
                    <a href="/login" class="btn-white btn">
                        Login
                    </a>
                @endif
        </p>
    </div>
</header>
    <div class="container-fluid">
        <main class="tm-main">
            <div class="row tm-row">
                <div class="col-12">
                    <hr class="tm-hr-primary tm-mb-55">
                    <img src="{{ asset('foto/' . $film->foto) }}" alt="{{ $film->title }}" class="img-fluid tm-mb-40">
                </div>
            </div>
            <div class="row tm-row">
                <div class="col-lg-8 tm-post-col">
                    <div class="tm-post-full">                    
                    <div class="mb-4">
                        <h2 class="pt-2 tm-color-primary tm-post-title">{{ $film->title }}</h2>
                        <p class="tm-mb-40">{{ \Carbon\Carbon::parse($film->release_date)->format('d F Y') }} diunggah oleh {{ $film->director }}</p>
                        <div class="tm-mb-40">
                            <span class="tm-color-primary">Rating:</span>
                            <div class="tm-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $averageRating)
                                        <i class="fas fa-star"></i>
                                    @else
                                        <i class="far fa-star"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <p>{{ $film->description }}</p>
                        <span class="d-block text-right tm-color-primary">Kategori:
                            @foreach ($film->genres as $genre)
                                {{ $genre->name }}@if (!$loop->last),@endif
                            @endforeach
                        </span>
                    </div>
                        <!-- Comments -->
                        <div>
                            <h2 class="tm-color-primary tm-post-title">Review</h2>
                            <hr class="tm-hr-primary tm-mb-45">
                            <div class="tm-comments-container" style="max-height: 400px; overflow-y: auto;">
                            @foreach($film->reviews as $review)
                                <div class="tm-comment tm-mb-45 card shadow-sm">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('foto/foto_profil/' . $review->user->foto_profil) }}" alt="Foto Profil" class="rounded-circle img-thumbnail" style="width:60px;height:60px;">
                                            <div class="ml-3">
                                                <h5 class="mb-0">{{ $review->user->name }}</h5>
                                                <small class="tm-color-primary">{{ \Carbon\Carbon::parse($review->created_at)->format('d F Y') }}</small>
                                            </div>
                                        </div>
                                        <!-- Tampilkan rating dalam bentuk bintang -->
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $review->rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <p>{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach

                            </div>
                            <br>
                            <form action="{{ route('review_film.store', $film->id) }}" method="POST" class="mb-5 tm-comment-form">
                                @csrf
                                <h2 class="tm-color-primary tm-post-title mb-4">Berikan Review</h2>
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="mb-4">
                                    <label for="rating">Rating:</label>
                                    <select name="rating" id="rating" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <input class="form-control" name="user_id" type="hidden" value="{{ Auth::user()->id }}">
                                </div>
                                <div class="mb-4">
                                    <input class="form-control" name="movie_id" type="hidden" value="{{ $film->id }}">
                                </div>
                                <div class="mb-4">
                                    <textarea class="form-control" name="comment" rows="6"></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="tm-btn tm-btn-primary tm-btn-small">Tambahkan</button>                        
                                </div>                               
                            </form>                          
                        </div>
                    </div>
                </div>
                <aside class="col-lg-4 tm-aside-col">
                    <div class="tm-post-sidebar">
                        <hr class="mb-3 tm-hr-primary">
                        <!-- Related Posts -->
                        <h2 class="tm-mb-40 tm-post-title tm-color-primary">Film Terkait</h2>
                            @foreach($relatedFilms as $relatedFilm)
                                <a href="{{ route('review_film.show', $relatedFilm->id) }}" class="d-block tm-mb-40">
                                    <figure>
                                        <img src="{{ asset('foto/' . $relatedFilm->foto) }}" alt="Foto FIlm" class="mb-3 img-fluid">
                                        <figcaption class="tm-color-primary">{{ $relatedFilm->title }}</figcaption>
                                    </figure>
                                </a>
                            @endforeach
                    </div>                    
                </aside>
            </div>
            <footer class="row tm-row">
                <hr class="col-12">
                <div class="col-md-6 col-12 tm-color-gray">
                    Tugas dari <a rel="nofollow" target="_parent" href="https://sanbercode.com/" class="tm-external-link">SanberCode</a>
                </div>
                <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                    Copyright 2024 Kelompok 8.
                </div>
            </footer>
        </main>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/templatemo-script.js') }}"></script>
</body>
</html>