<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function show403(Request $request)
    {
        $errorType = $request->session()->get('error_type', 'default');
        $errorMessages = [
            'admin-access' => 'Acceso restringido a administradores',
            'commercial-access' => 'Acceso restringido al área comercial',
            'sales-access' => 'Acceso restringido al área de ventas',
            'support-access' => 'Acceso restringido al área de soporte',
            'default' => 'No tienes permiso para acceder a esta página',
        ];

        return view('errors.403', [
            'message' => $errorMessages[$errorType] ?? $errorMessages['default']
        ]);
    }
}
