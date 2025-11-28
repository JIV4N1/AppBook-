@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="text-center">
    <h1>Panel de Administración</h1>
    <p class="lead">Bienvenido, {{ session('user')->name ?? 'Usuario' }}</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">Gestionar Libros</a>
    <a href="{{ route('logout') }}" class="btn btn-danger mt-3">Cerrar sesión</a>
</div>
@endsection
