<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        return view('layouts.auth');
    }

    /**
     * Maneja el login (POST)
     */
    public function login(Request $request): RedirectResponse
    {
        try {
            $credentials = $request->validate([
                'identity' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string'],
            ]);

            $loginField = filter_var($credentials['identity'], FILTER_VALIDATE_EMAIL)
                ? 'email'
                : 'username';

            if (!Auth::attempt([$loginField => $credentials['identity'], $credentials['password']], $request->filled('remember'))) {
                throw ValidationException::withMessages([
                    'identity' => __('auth.failed'),
                ]);
            }

            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                throw ValidationException::withMessages([
                    'identity' => __('auth.inactive'),
                ]);
            }

            $request->session()->regenerate();

            return $this->authenticatedRedirect($user);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Login Error: ' . $e->getMessage(), [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return back()->withErrors([
                'system_error' => __('auth.system_error')
            ]);
        }
    }

    /**
     * Maneja el logout
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->with('status', __('auth.logout_success'));
        } catch (\Exception $e) {
            Log::critical('Logout Error: ' . $e->getMessage(), [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            return back()->withErrors([
                'system_error' => __('auth.system_error')
            ]);
        }
    }

    /**
     * Redirección post-autenticación
     */
    protected function authenticatedRedirect(User $user): RedirectResponse
    {
        return match ($user->role) {
            'admin' => redirect()->intended(route('admin.dashboard')),
            'commercial' => redirect()->intended(route('commercial.dashboard')),
            default => redirect()->intended(route('home'))
        };
    }
}
