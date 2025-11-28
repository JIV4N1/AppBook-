@extends('layouts.app')

@section('title', 'Agregar Libro - AppBook')

@section('content')
<h1 class="mb-4">Agregar nuevo libro</h1>

@if ($errors->any())
            <div class="alert alert-danger"> <!--Patron de diseño que genera un cuadro de error-->
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

<form method="POST" action="{{ route('books.store') }}">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Autor</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Precio</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01">
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">URL de imagen</label>
        <input type="text" class="form-control" id="image" name="image">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
