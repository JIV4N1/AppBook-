@extends('layouts.app')

@section('title', 'Inicio - AppBook')

@section('content')
<h2 class="mb-4 text-center"> Libros Destacados</h2>

<div class="row">
  @php use Illuminate\Support\Str; @endphp

  @foreach ($books as $book)
    <div class="col-md-3 mb-4">
      <div class="card h-100">
        @if ($book->image)
           
            <img src="{{ $book->image }}" class="card-img-top" alt="{{ $book->title }}">
        @else
           
        @endif

        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $book->title }}</h5>
          <p class="text-muted mb-2">{{ $book->author }}</p>
          <p class="fw-bold text-success mb-3">${{ number_format($book->price, 2) }}</p>
          <a href="{{ route('book.show', $book->id) }}" class="btn btn-outline-primary mt-auto w-100">Ver detalles</a>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection
