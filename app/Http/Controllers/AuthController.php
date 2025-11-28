<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class AuthController extends Controller
{
    //
     // Mostrar formulario de registro
    public function showRegister()
    {
        return view('auth.register');
    }

    // Registrar usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Session::put('user', $user);

        return redirect('/admin')->with('success', 'Registro exitoso. Bienvenido, ' . $user->name);//variable temporal
    }

    // Mostrar formulario de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Iniciar sesión
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Credenciales incorrectas');
        }

        Session::put('user', $user);

        return redirect('/admin')->with('success', 'Bienvenido ' . $user->name);
    }   

    // Cerrar sesión
    public function logout()
    {
        Session::forget('user');
        return redirect('/')->with('success', 'Sesión cerrada correctamente.');
    }

}
