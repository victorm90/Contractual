<?php

namespace App\Http\Controllers;

use App\Models\ClasLegal;
use App\Models\Contrato;
use App\Models\Empresa;
use App\Models\FormPago;
use App\Models\Provincia;
use Carbon\Carbon;
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

    public function create()
    {
        $titulo = 'Contratos';    
        $provincias = Provincia::all();
        $clasificacionesLegales = ClasLegal::all();
        $empresas = Empresa::all();
        $formasPago = FormPago::all();

        return view('contenido.contratos.create', compact(
            'provincias',
            'clasificacionesLegales',
            'empresas',
            'formasPago',
            'titulo'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'descripcion' => 'required|string',
            // ... otras validaciones
            'archivo' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Generar número de contrato automático
        $today = Carbon::now();
        $lastContrato = Contrato::whereDate('created_at', $today)->orderBy('id', 'desc')->first();
        $sequence = $lastContrato ? intval(substr($lastContrato->numero_contrato, -3)) + 1 : 1;
        $numeroContrato = $today->format('Ymd') . str_pad($sequence, 3, '0', STR_PAD_LEFT);

        $contratoData = $request->except('archivo');
        $contratoData['numero_contrato'] = $numeroContrato;
        $contratoData['user_id'] = auth()->id();
        $contratoData['last_updated_by'] = auth()->id();

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('contratos', $fileName, 'public');

            $contratoData['archivo_path'] = '/storage/' . $filePath;
            $contratoData['archivo_mime'] = $file->getClientMimeType();
        }

        Contrato::create($contratoData);

        return redirect()->route('contratos')->with('success', 'Contrato creado exitosamente.');
    }

    public function getMunicipiosByProvincia(Provincia $provincia)
    {
        return response()->json($provincia->municipios);
    }

    public function show(Contrato $contract)
    {
        // Cargar relaciones necesarias para evitar N+1 queries
        $contract->load([
            'clasLegal',
            'empresa',
            'provincia',
            'municipio',
            'formaPago',
            'user',
            'lastUpdatedByUser'
        ]);

        return view('contenido.contratos.show', compact('contract'));
    }
}
