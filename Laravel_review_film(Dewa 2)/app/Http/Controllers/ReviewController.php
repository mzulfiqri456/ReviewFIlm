<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Film;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');
        $films = Film::where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->paginate(6);
        return view('pengguna.index', compact('films'));
    }

    public function show($id)
    {
        $film = Film::with('reviews.user')->findOrFail($id);
        $genreArray = explode(',', $film->genre); // Ubah string genre menjadi array

        $totalRating = $film->reviews()->sum('rating');
        $totalReviews = $film->reviews()->count();

        // Hitung rata-rata rating film tersebut
        $averageRating = ($totalReviews > 0) ? $totalRating / $totalReviews : 0;
    
        $relatedFilms = Film::where(function ($query) use ($genreArray, $id) {
                                foreach ($genreArray as $genre) {
                                    $query->orWhere('genre', 'like', "%$genre%"); // Cari film dengan setidaknya satu genre yang sama
                                }
                            })
                            ->where('id', '!=', $id)
                            ->take(3)
                            ->get();
    
        return view('pengguna.post', compact('film', 'relatedFilms', 'averageRating'));
    }
    

    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'movie_id' => 'required|exists:movies,id',
            'comment' => 'required|string',
            'rating' => 'nullable|numeric|min:1|max:5',
        ]);

        $existingReview = Review::where('user_id', $validatedData['user_id'])
        ->where('movie_id', $validatedData['movie_id'])
        ->exists();

        if ($existingReview) {
        return redirect()->route('review_film.show', ['id' => $id])->with('error', 'Anda sudah memberikan review untuk film ini sebelumnya.');
        }

        Review::create($validatedData);

        return redirect()->route('review_film.show', ['id' => $id])->with('success', 'Review berhasil ditambahkan!');    
    }

    public function indexPost()
    {
        return view('pengguna.post');
    }
    
    public function indexAbout()
    {
        return view('pengguna.about');
    }

    public function indexContact()
    {
        return view('pengguna.contact');
    }
}
