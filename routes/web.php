<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BookAdminController;

// Página de inicio
Route::get('/', function () {
    return view('home');
});

// Catálogo de todos los libros
Route::get('/catalog', [BookController::class, 'catalog'])->name('catalog');

// Vista individual del libro
Route::get('/book/{id}', [BookController::class, 'show'])->name('book.show');

// Registro
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');//visual
Route::post('/register', [AuthController::class, 'register']);

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta protegida (admin)
Route::middleware('auth.session')->group(function () { //una clase que se ejecuta antes de entrar a la ruta
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

//Panel administrativo protegido con sesión
Route::middleware('auth.session')->group(function(){

    Route::get('/admin', function(){
        return view('admin.dashboard');
    }) -> name('admin.dashboard');

    //CRUD de libros del administrador
    Route::resource('/admin/books', BookAdminController::class);
    
});

// Página principal con libros destacados
Route::get('/', [BookController::class, 'index'])->name('home');





