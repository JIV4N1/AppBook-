@extends('layouts.app')

@section('title', 'Gestión de Libros - AppBook')

@section('content')
<h1 class="mb-4"> Lista de libros</h1>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('books.create') }}" class="btn btn-primary mb-3">+ Agregar nuevo libro</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>{{ $book->title }}</td>
            <td>{{ $book->author }}</td>
            <td>${{ number_format($book->price, 2) }}</td>
            <td>
                <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este libro?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
