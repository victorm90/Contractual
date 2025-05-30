<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.auth');
    }

    public function login(Request $request)
    {
        // Validación corregida
        $credentials = $request->validate([
            'identity' => 'required|string|max:15|min:2',
            'password' => 'required|string'
        ]);

        // Determinar si es email o username
        $loginField = filter_var($credentials['identity'], FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        // Buscar usuario por el campo correcto
        $user = User::where($loginField, $credentials['identity'])->first();

        // Verificar usuario y contraseña
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['identity' => 'Credenciales incorrectas'])->withInput();
        }

        // Verificar si el usuario está activo
        if (!$user->activo) {
            return back()->withErrors(['identity' => 'Tu cuenta está inactiva'])->withInput();
        }

        // Autenticar al usuario
        Auth::login($user, $request->filled('remember'));
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }
}
