<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function show403(Request $request)
    {
        $errorType = $request->session()->get('error_type');
        $customMessage = $this->getErrorMessage($errorType);

        return view('errors.403', compact('customMessage'));
    }

    private function getErrorMessage($type)
    {
        return match ($type) {
            'admin_access' => 'Acceso restringido a administradores',
            'commercial_access' => 'Sección exclusiva para equipo comercial',
            default => 'Acceso no autorizado'
        };
    }
}
