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
