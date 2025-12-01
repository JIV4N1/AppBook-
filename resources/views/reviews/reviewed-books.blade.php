@extends('layouts.app')

@section('title', 'Libros Reseñados - AppBook')

@section('content')
<div class="container">
    <h1 class="mb-4">Libros Reseñados</h1>

    @if($books->count() > 0)
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if($book->image)
                                        <img src="{{ $book->image }}" class="img-fluid rounded" alt="{{ $book->title }}">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 150px;">
                                            <span class="text-muted">Sin imagen</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title">{{ $book->title }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $book->author }}</h6>
                                    
                                    <div class="mb-2">
                                        <span class="badge bg-primary">{{ $book->reviews_count }} reseña(s)</span>
                                        @if($book->reviews->avg('rating'))
                                            <span class="badge bg-warning text-dark">
                                                {{ number_format($book->reviews->avg('rating'), 1) }} ⭐ promedio
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Mostrar algunas reseñas recientes --}}
                                    @if($book->reviews->count() > 0)
                                        <div class="mt-3">
                                            <h6>Últimas reseñas:</h6>
                                            @foreach($book->reviews->take(2) as $review)
                                                <div class="border-start border-3 border-primary ps-2 mb-2">
                                                    <div class="d-flex justify-content-between">
                                                        <strong class="small">{{ $review->user->name }}</strong>
                                                        <span class="text-warning small">{{ $review->rating }} ⭐</span>
                                                    </div>
                                                    <p class="small text-muted mb-1">{{ Str::limit($review->comment, 80) }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('book.show', $book->id) }}" class="btn btn-primary btn-sm">
                                Ver libro y todas las reseñas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <h4>📝 Aún no hay libros reseñados</h4>
            <p>Sé el primero en dejar una reseña en nuestro catálogo.</p>
            <a href="{{ route('catalog') }}" class="btn btn-primary">Explorar Catálogo</a>
        </div>
    @endif
</div>
@endsection