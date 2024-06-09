<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::all();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function show($id)
    {
        $pengguna = User::findOrFail($id);
        return view('admin.pengguna.show', compact('pengguna'));
    }

    public function create()
    {
        $pengguna = User::all();
        return view('admin.pengguna.create', compact('pengguna'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'foto_profil' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required|in:admin,pengguna',
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
            'role' => $request->role,
            'foto_profil' => $imageName,
        ]);

        return Redirect::route('pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        return view('admin.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($pengguna->id),
            ],
            'username' => [
                'required',
                Rule::unique('users')->ignore($pengguna->id),
            ],
            'password' => 'nullable',
            'role' => 'required|in:admin,pengguna',
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->username = $request->username;
        $pengguna->role = $request->role;

        if ($request->filled('password')) {
            $pengguna->password = bcrypt($request->password);
        }

        if ($request->hasFile('foto_profil')) {
            $imageName = $request->foto_profil->getClientOriginalName();  
            $request->foto_profil->move(public_path('foto/foto_profil/'), $imageName);
            $pengguna->foto_profil = $imageName;
        }

        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengguna = User::findOrFail($id);
        $pengguna->delete();

        return Redirect::route('pengguna.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}