<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $titulo = 'Gestión de Usuarios';

        // Consulta optimizada con búsqueda y paginación
        $usuarios = User::query()
            ->when(request('search'), function ($query) {
                $search = request('search');
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->select(['id', 'name', 'username', 'activo', 'email', 'role', 'created_at'])
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('contenido.usuario.index', compact('titulo', 'usuarios'));
    }


    public function estado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|boolean',
        ]);

        try {
            $usuario = User::findOrFail($id);
            $usuario->activo = $request->estado;
            $usuario->save();

            return response()->json(['success' => true, 'message' => 'Estado actualizado correctamente']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al actualizar estado']);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $titulo = 'Crear Usuarios';
        return view('contenido.usuario.create', compact('titulo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|min:5',
                'role' => 'required|in:admin,comercial',
                'activo' => 'sometimes|boolean'
            ], [
                // ... tus mensajes personalizados ...
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'activo' => $request->boolean('activo'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Usuario creado con éxito'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Error al crear usuario: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error en el servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Lógica de actualización...

        return back()->with('info', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Lógica de eliminación...

        return redirect()->route('usuarios')
            ->with('warning', 'Usuario eliminado del sistema');
    }
}
