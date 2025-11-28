@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Crear cuenta</h2>

        @if ($errors->any())
            <div class="alert alert-danger"> <!--Patron de diseño que genera un cuadro de error-->
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf <!--crea un token CSRF para proteger el formulario contra ataques de falsificación de solicitudes entre sitios-->
            <div class="mb-3">
                <label for="name" class="form-label">Nombre completo</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrarme</button>
        </form>
    </div>
</div>
@endsection
