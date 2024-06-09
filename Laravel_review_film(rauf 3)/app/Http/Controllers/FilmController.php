<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Film;

class FilmController extends Controller
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
        $film = Film::findOrFail($id);
        return view('pengguna.post', compact('film'));
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
