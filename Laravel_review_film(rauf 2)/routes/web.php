<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Login
Route::get('/', function () {return redirect('/login');});
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/keluar', [LoginController::class, 'keluar']);
Route::post('/logout', [LoginController::class, 'logout']);

// Registrasi
Route::get('/registrasi', [RegistrasiController::class, 'index'])->name('registrasi');
Route::post('/registrasi', [RegistrasiController::class, 'store']);

// Pengguna
Route::get('/review_film', [ReviewController::class, 'index'])->middleware('auth');
Route::get('/review_film/{id}', [ReviewController::class, 'show'])->name('review_film.show');
Route::post('/review_film/{id}/review', [ReviewController::class, 'store'])->name('review_film.store');

Route::get('/post', [ReviewController::class, 'indexPost']);
Route::get('/about', [ReviewController::class, 'indexAbout']);
Route::get('/contact', [ReviewController::class, 'indexContact']);

// Admin
Route::get('/dashboard', [AdminController::class, 'indexDashboard'])->middleware('auth');


// Data Film
Route::get('/film', [AdminController::class, 'indexFilm'])->name('film.index');
Route::get('/film/create', [AdminController::class, 'createFilm'])->name('film.create');
Route::post('/film', [AdminController::class, 'storeFilm'])->name('film.store');;
Route::get('/film/{kategori_id}', [AdminController::class, 'showFilm'])->name('film.show');
Route::get('/film/{kategori_id}/edit', [AdminController::class, 'editFilm'])->name('film.edit');
Route::put('/film/{kategori_id}', [AdminController::class, 'updateFilm'])->name('film.update');
Route::delete('/film/{kategori_id}', [AdminController::class, 'destroyFilm'])->name('film.destroy');


// Data Pengguna
Route::resource('/pengguna', PenggunaController::class);
