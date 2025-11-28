@extends('layouts.app')

@section('title', $book->title . ' - AppBook')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="row">
  <div class="col-md-4">
    @if ($book->image)
      
        <img src="{{ $book->image }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
    @else
   
    @endif
  </div>

  <div class="col-md-8">
    <h2>{{ $book->title }}</h2>
    <h5 class="text-muted">{{ $book->author }}</h5>
    @if($book->genre)
      <p><span class="badge bg-secondary">{{ $book->genre }}</span></p>
    @endif

    <p class="mt-3">{{ $book->description ?? 'Sin descripción disponible.' }}</p>

    <p class="fw-bold text-success fs-4">Precio: ${{ number_format($book->price, 2) }}</p>

    <a href="{{ route('catalog') }}" class="btn btn-secondary mt-3">Volver al catálogo</a>

  <h3>Reseñas</h3>

    @forelse($book->reviews as $review)
        <div class="card mb-2">
            <div class="card-body">
                <strong>{{ $review->user->name }}</strong>
                <span> — {{ $review->rating }} ⭐</span>
                <p>{{ $review->comment }}</p>
            </div>
        </div>
    @empty
        <p>No hay reseñas todavía.</p>
    @endforelse

    @if (session('user'))
    <div class="card mt-4">
        <div class="card-body">
            <h5>Dejar una reseña</h5>

            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf

                <input type="hidden" name="book_id" value="{{ $book->id }}">

                <label>Calificación</label>
                <select name="rating" class="form-control mb-2">
                    <option value="5">5 ⭐</option>
                    <option value="4">4 ⭐</option>
                    <option value="3">3 ⭐</option>
                    <option value="2">2 ⭐</option>
                    <option value="1">1 ⭐</option>
                </select>

                <label>Comentario</label>
                <textarea name="comment" class="form-control mb-2" required></textarea>

                <button class="btn btn-primary">Enviar reseña</button>
            </form>
        </div>  
    </div>
@endif



  </div>
</div>
@endsection
