@extends('layouts.app')

@section('title', 'Mis Reseñas - AppBook')

@section('content')
<div class="container">
    <h1>Mis Reseñas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($reviews->count() > 0)
        <div class="row">
            @foreach($reviews as $review)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title">
                                    <a href="{{ route('book.show', $review->book->id) }}" class="text-decoration-none">
                                        {{ $review->book->title }}
                                    </a>
                                </h5>
                                <span class="badge bg-warning text-dark">{{ $review->rating }} ⭐</span>
                            </div>
                            
                            <h6 class="card-subtitle mb-2 text-muted">por {{ $review->book->author }}</h6>
                            
                            <p class="card-text mt-3">
                                <strong>Mi reseña:</strong><br>
                                {{ $review->comment }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    Reseñado el {{ $review->created_at->format('d/m/Y') }}
                                </small>
                                <div>
                                    <a href="{{ route('book.show', $review->book->id) }}" class="btn btn-sm btn-primary">
                                        Ver Libro
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            <h4>📝 Aún no has escrito ninguna reseña</h4>
            <p>Explora nuestro catálogo y comparte tu opinión sobre los libros que has leído.</p>
            <a href="{{ route('catalog') }}" class="btn btn-primary">Explorar Catálogo</a>
        </div>
    @endif
</div>
@endsection