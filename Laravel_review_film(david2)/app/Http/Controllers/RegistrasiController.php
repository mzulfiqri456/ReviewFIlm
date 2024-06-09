<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('registrasi');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('foto_profil')) {
            $imageName = $request->foto_profil->getClientOriginalName();  
            $request->foto_profil->move(public_path('foto/foto_profil/'), $imageName);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'pengguna',
            'foto_profil' => $imageName,
        ]);

        return redirect('/login')->with('success', 'Akun Anda berhasil dibuat, silahkan login.');
    }
}