<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Film;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        // $index = Review::all();
        return view('admin.master');
    }

    public function indexDashboard()
    {
        $totalCategories = Kategori::count();
        $totalFilms = Film::count();
        $totalReviews = Review::count();

        return view('admin.dashboard', compact('totalCategories', 'totalFilms', 'totalReviews'));
    }

    // Kategori
    public function indexKategori()
    {
        $categories = Kategori::all();
        return view('admin.kategori.index', compact('categories'));
    }

    public function createKategori()
    {
        return view('admin.kategori.create');
    }

    public function storeKategori(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Kategori::create($validatedData);

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil ditambahkan!');
    }

    public function showKategori($kategori_id)
    {
        $categories = Kategori::findOrFail($kategori_id);
        return view('kategori.show', compact('categories'));
    }

    public function editKategori($kategori_id)
    {
        $categories = Kategori::findOrFail($kategori_id);
        return view('admin.kategori.edit', compact('categories'));
    }    

    public function updateKategori(Request $request, $kategori_id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        Kategori::whereId($kategori_id)->update($validatedData);
    
        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil diperbarui!');
    }

    public function destroyKategori($kategori_id)
    {
        $categories = Kategori::findOrFail($kategori_id);
        $categories->delete();

        return redirect()->route('kategori.index')->with('success', 'Data kategori berhasil dihapus!');
    }

    // Film
    public function indexFilm()
    {
        $movies = Film::all();
        
        return view('admin.film.index', compact('movies'));
    }

    public function createFilm()
    {
        $genres = Kategori::all();
        return view('admin.film.create', compact('genres'));
    }

    public function storeFilm(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'release_date' => 'required',
            'genre.*' => 'required|string',
            'director' => 'required',
            'rating' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = $request->foto->getClientOriginalName();  
            $request->foto->move(public_path('/foto'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        $genreString = implode(',', $validatedData['genre']);
        $validatedData['genre'] = $genreString;

        $film = Film::create($validatedData);

        $genres = $request->input('genre');
        if (!empty($genres)) {
            foreach ($genres as $genreId) {
                $film->genres()->attach($genreId);
            }
        }
        $user = auth()->user();
        $rating = $request->input('rating');
        $film->reviews()->create([
            'user_id' => $user->id, 
            'movie_id' => $film->id,
            'rating' => $rating,
            'comment' => 'Rating oleh Admin.',
        ]);

        return redirect()->route('film.index')->with('success', 'Data film berhasil ditambahkan!');
    }

    public function showFilm($film_id)
    {
        $movies = Film::findOrFail($film_id);
        return view('kategori.show', compact('movies'));
    }

    public function editFilm($film_id)
    {
        $movies = Film::with('genres')->find($film_id);
        $genres = Kategori::all();
        $filmGenres = $movies->genres->pluck('id')->toArray();
        return view('admin.film.edit', compact('movies', 'genres', 'filmGenres'));
    } 

    public function updateFilm(Request $request, $film_id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'release_date' => 'required',
            'genre.*' => 'required|string',
            'director' => 'required',
        ]);

        if ($request->hasFile('foto')) {
            $imageName = $request->foto->getClientOriginalName();  
            $request->foto->move(public_path('/foto'), $imageName);
            $validatedData['foto'] = $imageName;
        }

        $genres = $request->input('genre');
        if (!empty($genres)) {
            $genreArray = implode(',',$validatedData['genre']);
            $validatedData['genre'] = $genreArray;
        } else {
            $validatedData['genre'] = '';
        }

        $film = Film::find($film_id);

        $film->genres()->detach();
        
        if (!empty($genres)) {
            foreach ($genres as $genreId) {
                $film->genres()->attach($genreId);
            }
        }

        $film->update($validatedData);

        return redirect()->route('film.index')->with('success', 'Data film berhasil diperbarui.');
    }

    public function destroyFilm($film_id)
    {
        $movies = Film::findOrFail($film_id);
        $movies->delete();

        return redirect()->route('film.index')->with('success', 'Data film berhasil dihapus!');
    }

    // Review Film
    public function indexReview()
    {
        $reviews = Review::with('user', 'film')->get();
        return view('admin.review.index', compact('reviews'));
    }

    public function createReview()
    {
        $movies = Film::all();
        return view('admin.review.create', compact('movies'));
    }

    public function storeReview(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'movie_id' => 'required|exists:movies,id',
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        Review::create($validatedData);

        return redirect()->route('review.index')->with('success', 'Data review film berhasil ditambahkan!');
    }

    public function showReview($review_id)
    {
        $review = Review::findOrFail($review_id);
        return view('review.show', compact('review'));
    }

    public function editReview($review_id)
    {
        $review = Review::findOrFail($review_id);
        // $genres = Kategori::all();
        return view('admin.review.edit', compact('review'));
    }

    public function updateReview(Request $request, $review_id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'release_date' => 'required|date',
            'genre' => 'required|exists:genres,id',
            'director' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $review = Review::find($review_id);
        if (!$review) {
            return redirect()->route('review.index')->with('error', 'Review film tidak ditemukan!');
        }

        $review->title = $request->input('title');
        $review->description = $request->input('description');
        $review->release_date = $request->input('release_date');
        $review->genre = $request->input('genre');
        $review->director = $request->input('director');

        $review->save();

        return redirect()->route('review.index')->with('success', 'Data review film berhasil diperbarui!');
    }

    public function destroyReview($review_id)
    {
        $review = Film::findOrFail($review_id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Data review film berhasil dihapus!');
    }
}
