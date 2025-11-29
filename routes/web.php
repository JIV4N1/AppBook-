<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BookAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;

// Página principal
Route::get('/', [BookController::class, 'index'])->name('home');

// Catálogo de todos los libros
Route::get('/catalog', [BookController::class, 'catalog'])->name('catalog');

// Vista individual del libro
Route::get('/book/{id}', [BookController::class, 'show'])
    ->name('book.show')
    ->middleware('auth.session');


// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Perfil solo para usuarios autenticados
Route::middleware('auth.session')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    // Panel administrativo (solo si el usuario ES admin)
    Route::middleware('auth.session', 'admin')->group(function() {
        Route::get('/admin', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // CRUD ADMIN
        Route::resource('/admin/books', BookAdminController::class);
    });

});

//Ruta para guardar reseñas
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Favoritos
Route::post('/favorites/toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorites.toggle');
Route::get('/my-favorites', [FavoriteController::class, 'myFavorites'])->name('my.favorites');
