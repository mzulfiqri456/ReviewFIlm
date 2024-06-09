<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Film</title>
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> <!-- https://fonts.google.com/ -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/templatemo-xtra-blog.css')}}" rel="stylesheet">
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
        <!-- Search form -->
        <div class="row tm-row">
            <div class="col-12">
                <form method="GET" class="form-inline tm-mb-80 tm-search-form">                
                    <input class="form-control tm-search-input" name="query" type="text" placeholder="Search..." aria-label="Search" value="{{ request('query') }}">
                    <button class="tm-search-button" type="submit">
                        <i class="fas fa-search tm-search-icon" aria-hidden="true"></i>
                    </button>                                
                </form>
            </div>
        </div>

        <!-- Box Artikel Film -->
        <div class="row tm-row">
            @foreach($films as $film)
            @php
                $releaseDate = \Carbon\Carbon::parse($film->release_date);
                $createdAt = \Carbon\Carbon::parse($film->created_at);

                $sentences = strtok($film->description, '.');
                $description = '';

                // Mengambil tiga kalimat pertama
                for ($i = 0; $i < 2; $i++) {
                    if ($sentences !== false) {
                        $description .= $sentences . '.';
                        $sentences = strtok('.');
                    }
                }
            @endphp
                <article class="col-12 col-md-6 tm-post">
                    <hr class="tm-hr-primary">
                    <a href="{{ route('review_film.show', $film->id) }}" class="effect-lily tm-post-link tm-pt-60">
                        <div class="tm-post-link-inner">
                            <img src="{{ asset('foto/' . $film->foto) }}" alt="{{ $film->title }}" class="img-fluid">
                        </div>
                        @if($releaseDate->isToday() || $createdAt->isToday())
                            <span class="position-absolute tm-new-badge">New</span>
                        @endif
                        <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{ $film->title }}</h2>
                    </a>
                    <p class="tm-pt-30">
                        {{ $description }}
                    </p>
                    <div class="d-flex justify-content-between tm-pt-45">
                        <span class="tm-color-primary">
                            @foreach ($film->genres as $genre)
                                {{ $genre->name }}@if (!$loop->last),@endif
                            @endforeach</span>
                        <span class="tm-color-primary">{{ \Carbon\Carbon::parse($film->release_date)->format('d F Y') }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>{{ $film->reviews()->count() }} reviews</span>
                        <span>by {{ $film->director }}</span>
                    </div>
                </article>
            @endforeach
        </div>
        <!-- Box Artikel Film -->

        <div class="row tm-row tm-mt-100 tm-mb-75">
            <div class="tm-prev-next-wrapper">
                <a href="{{ $films->previousPageUrl() }}" class="mb-2 tm-btn tm-btn-primary tm-prev-next{{ $films->onFirstPage() ? ' disabled' : '' }} tm-mr-20">Prev</a>
                <a href="{{ $films->nextPageUrl() }}" class="mb-2 tm-btn tm-btn-primary tm-prev-next{{ !$films->hasMorePages() ? ' disabled' : '' }}">Next</a>
            </div>
            <div class="tm-paging-wrapper">
                <span class="d-inline-block mr-3">Page</span>
                <nav class="tm-paging-nav d-inline-block">
                    <ul>
                        @for ($i = 1; $i <= $films->lastPage(); $i++)
                            <li class="tm-paging-item{{ $films->currentPage() == $i ? ' active' : '' }}">
                                <a href="{{ $films->url($i) }}" class="mb-2 tm-btn tm-paging-link">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </nav>
            </div>
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
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/templatemo-script.js')}}"></script>
</body>
</html>