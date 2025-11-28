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
  </div>
</div>
@endsection
