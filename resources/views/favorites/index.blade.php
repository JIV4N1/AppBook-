@extends('layouts.app')

@section('title', 'Mis Favoritos - AppBook')

@section('content')
<div class="container">
    <h1>Mis Libros Favoritos</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($favorites->count() > 0)
        <div class="row">
            @foreach($favorites as $favorite)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if($favorite->book->image)
                            <img src="{{ $favorite->book->image }}" class="card-img-top" alt="{{ $favorite->book->title }}">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                <span class="text-muted">Sin imagen</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $favorite->book->title }}</h5>
                            <p class="card-text text-muted">{{ $favorite->book->author }}</p>
                            <p class="card-text">${{ number_format($favorite->book->price, 2) }}</p>
                            <a href="{{ route('book.show', $favorite->book->id) }}" class="btn btn-primary">Ver Detalles</a>
                            <form action="{{ route('favorites.toggle') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $favorite->book->id }}">
                                <button type="submit" class="btn btn-danger">❌ Quitar</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info">
            <p>No tienes libros favoritos aún.</p>
            <a href="{{ route('catalog') }}" class="btn btn-primary">Explorar Catálogo</a>
        </div>
    @endif
</div>
@endsection