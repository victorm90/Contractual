<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    public function index(Request $request)
    {
        $titulo = 'Contratos';

        $search = $request->input('search');
        $estado = $request->input('estado');

        $contratosQuery = Contrato::query()
            ->with(['clasLegal', 'empresa', 'provincia', 'municipio', 'formaPago']);

        // Contadores globales (sin paginación ni filtros por estado o búsqueda)
        $totalContratos = $contratosQuery->count();
        $vigentesCount = (clone $contratosQuery)->where('fecha_vencimiento', '>=', now()->toDateString())->count();
        $vencidosCount = (clone $contratosQuery)->where('fecha_vencimiento', '<', now()->toDateString())->count();

        // Aplicar filtros de búsqueda y estado
        $contratos = $contratosQuery
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nombre_cliente', 'like', "%{$search}%")
                        ->orWhere('descripcion', 'like', "%{$search}%")
                        ->orWhere('cod_reuup', 'like', "%{$search}%")
                        ->orWhere('codigo_nit', 'like', "%{$search}%");
                });
            })
            ->when($estado, function ($query, $estado) {
                if ($estado === 'vigente') {
                    return $query->where('fecha_vencimiento', '>=', now()->toDateString());
                } elseif ($estado === 'vencido') {
                    return $query->where('fecha_vencimiento', '<', now()->toDateString());
                }
                return $query;
            })
            ->orderBy('fecha_vencimiento', 'asc')
            ->paginate(8);

        return view('contenido.contratos.index', compact(
            'contratos',
            'search',
            'estado',
            'titulo',
            'totalContratos',
            'vigentesCount',
            'vencidosCount'
        ));
    }
}
