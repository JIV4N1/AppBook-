<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

//Crearle un paginador al CRUD de libros

class BookAdminController extends Controller
{
    // Mostrar todos los libros
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.books.create');
    }

    // Guardar nuevo libro
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Libro agregado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    // Actualizar libro
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|url',
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente.');
    }

    // Eliminar libro
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Libro eliminado correctamente.');
    }
}
