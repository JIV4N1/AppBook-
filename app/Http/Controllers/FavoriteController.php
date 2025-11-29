<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Book;
use Illuminate\Support\Facades\Session;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request)
    {
        $user = Session::get('user');
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para agregar favoritos.');
        }

        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        $bookId = $request->book_id;

        // Verificar si ya es favorito
        $existingFavorite = Favorite::where('user_id', $user->id)
                                   ->where('book_id', $bookId)
                                   ->first();

        if ($existingFavorite) {
            // Si ya es favorito, eliminarlo
            $existingFavorite->delete();
            $message = 'Libro removido de favoritos';
            $isFavorite = false;
        } else {
            // Si no es favorito, agregarlo
            Favorite::create([
                'user_id' => $user->id,
                'book_id' => $bookId
            ]);
            $message = 'Libro agregado a favoritos';
            $isFavorite = true;
        }

        if ($request->ajax()) {
            return response()->json([
                'message' => $message,
                'is_favorite' => $isFavorite
            ]);
        }

        return back()->with('success', $message);
    }

    public function myFavorites()
    {
        $user = Session::get('user');
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus favoritos.');
        }

        $favorites = Favorite::with('book')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->get();

        return view('favorites.index', compact('favorites'));
    }
}