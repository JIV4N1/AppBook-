<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Session::get('user');

        // Si no existe el usuario, redirige (por si acaso)
        if (!$user) {
            return redirect('/login')->with('error', 'Por favor inicia sesión.');
        }

        return view('profile.index', compact('user'));
    }
}
