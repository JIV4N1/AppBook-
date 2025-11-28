<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Página principal: muestra libros destacados
     */
    public function index()
    {
        // Libros más recientes o destacados
        $books = Book::latest()->take(4)->get();
        return view('home', compact('books'));
    }

    /**
     * Catálogo general de libros
     */
    public function catalog()
    {
        $books = Book::paginate(8);
        return view('catalog', compact('books'));
    }

    /**
     * Ver un libro individual
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book.show', compact('book'));
    }
}
