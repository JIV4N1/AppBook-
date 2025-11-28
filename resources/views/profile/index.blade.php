@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Mi Perfil</h4>
        </div>

        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Correo:</strong> {{ $user->email }}</p>
            <p><strong>Fecha de registro:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

</div>
@endsection
