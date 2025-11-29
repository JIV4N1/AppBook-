<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
public function store(Request $request)
{
    $user = Session::get('user');
    
    // ✅ DEBUG PARA VER QUÉ USUARIO ESTÁ EN SESIÓN
    \Log::info('Usuario en sesión al crear reseña:', [
        'session_user_id' => $user ? $user->id : 'null',
        'session_user_name' => $user ? $user->name : 'null',
        'all_session_data' => Session::all()
    ]);

    if (!$user) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión.');
    }

    $request->validate([
        'book_id' => 'required|exists:books,id',
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string'
    ]);

    // ✅ DEBUG DE LA RESEÑA QUE SE VA A CREAR
    \Log::info('Creando reseña con usuario:', ['user_id' => $user->id]);

    Review::create([
        'user_id' => $user->id,
        'book_id' => $request->book_id,
        'rating' => $request->rating,
        'comment' => $request->comment
    ]);

    return back()->with('success', 'Reseña agregada correctamente');
}

public function myReviews()
    {
        // 1. Verificar sesión
        $user = Session::get('user');
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus reseñas.');
        }

        // 2. Obtener reseñas del usuario con información del libro
        $reviews = Review::with('book') // Cargar relación con libro
                        ->where('user_id', $user->id)
                        ->latest()
                        ->get();

        // 3. Pasar a la vista
        return view('reviews.my-reviews', compact('reviews'));
    }
}
