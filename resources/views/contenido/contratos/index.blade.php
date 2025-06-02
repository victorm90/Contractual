@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <!-- Header renovado con efecto de vidrio y gradiente -->
        <div class="glass-card bg-gradient-to-r bg-slate-150 to-primary-focus rounded-xl p-6 mb-6 shadow-lg">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="text-2xl font-bold text-dark lg:text-3xl flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Gestión de Contratos
                    </h2>
                    <p class="mt-2 text-primary-100 opacity-90">Administra y supervisa todos los contratos de tu
                        organización</p>
                </div>

                <!-- Filtros de estado renovados -->
                <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                    <a href="{{ route('contratos') }}"
                        class="filter-pill {{ !request('estado') ? 'active-pill bg-white text-primary' : 'bg-white/20 text-white' }}">
                        <span class="flex items-center">
                            <span class="h-2 w-2 rounded-full bg-slate-400 mr-2"></span>
                            Todos
                        </span>
                        <span class="ml-2 bg-primary/10 text-primary px-2 py-0.5 rounded-full text-xs">
                            {{ $totalContratos }}
                        </span>
                    </a>
                    <a href="{{ route('contratos') }}?estado=vigente"
                        class="filter-pill {{ request('estado') === 'vigente' ? 'active-pill bg-white text-success' : 'bg-white/20 text-white' }}">
                        <span class="flex items-center">
                            <span class="h-2 w-2 rounded-full bg-success mr-2"></span>
                            Vigentes
                        </span>
                        <span class="ml-2 bg-success/10 text-success px-2 py-0.5 rounded-full text-xs">
                            {{ $vigentesCount }}
                        </span>
                    </a>
                    <a href="{{ route('contratos') }}?estado=vencido"
                        class="filter-pill {{ request('estado') === 'vencido' ? 'active-pill bg-white text-danger' : 'bg-white/20 text-white' }}">
                        <span class="flex items-center">
                            <span class="h-2 w-2 rounded-full bg-danger mr-2"></span>
                            Vencidos
                        </span>
                        <span class="ml-2 bg-danger/10 text-danger px-2 py-0.5 rounded-full text-xs">
                            {{ $vencidosCount }}
                        </span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Barra de acciones mejorada -->
        <div
            class="action-bar bg-slate-50 dark:bg-navy-800 rounded-lg p-4 mb-4 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <h3 class="text-lg font-semibold text-slate-800 dark:text-navy-100 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-primary" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Registros de Contratos
            </h3>

            <div class="mt-3 sm:mt-0 flex items-center space-x-3">
                <!-- Búsqueda mejorada -->
                <div class="search-container relative" x-data="{ open: false }">
                    <button @click="open = true"
                        class="btn bg-slate-150 hover:bg-slate-200 text-slate-800 dark:bg-navy-500 dark:hover:bg-navy-450 dark:text-navy-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="ml-1 hidden sm:inline">Buscar</span>
                    </button>

                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-1 w-80 z-10">
                        <div
                            class="bg-white dark:bg-navy-700 rounded-lg shadow-lg p-2 border border-slate-200 dark:border-navy-600">
                            <form action="{{ route('contratos') }}" method="GET">
                                <div class="relative">
                                    <input name="search" type="text" placeholder="Buscar por cliente, descripción..."
                                        value="{{ $search ?? '' }}"
                                        class="form-input w-full pl-9 rounded-full border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 focus:border-primary focus:ring-primary dark:border-navy-450 dark:focus:border-accent">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="absolute left-3 top-2.5 h-4 w-4 text-slate-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Botón de nuevo contrato con efecto hover -->
                <div x-data="{ showModal: false }">
                    <button @click="showModal = true"
                        class="btn bg-primary text-white hover:bg-primary-focus hover:shadow-lg hover:shadow-primary/20 focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90 transform transition duration-300 hover:scale-[1.02]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Añadir</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Tarjeta de tabla renovada -->
        <div class="card rounded-xl overflow-hidden border border-slate-200 dark:border-navy-600 shadow-md">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-100 dark:bg-navy-800">
                        <tr>
                            <th
                                class="whitespace-nowrap px-5 py-4 font-semibold uppercase text-slate-800 dark:text-navy-100 border-b border-slate-200 dark:border-navy-600">
                                <div class="flex items-center">
                                    <span>Cliente</span>
                                    <button class="ml-1 text-slate-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                        </svg>
                                    </button>
                                </div>
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-4 font-semibold uppercase text-slate-800 dark:text-navy-100 border-b border-slate-200 dark:border-navy-600">
                                Descripción
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-4 font-semibold uppercase text-slate-800 dark:text-navy-100 border-b border-slate-200 dark:border-navy-600">
                                Vencimiento
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-4 font-semibold uppercase text-slate-800 dark:text-navy-100 border-b border-slate-200 dark:border-navy-600">
                                Valor
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-4 font-semibold uppercase text-slate-800 dark:text-navy-100 border-b border-slate-200 dark:border-navy-600">
                                Estado
                            </th>
                            <th
                                class="whitespace-nowrap px-5 py-4 font-semibold uppercase text-slate-800 dark:text-navy-100 border-b border-slate-200 dark:border-navy-600 text-right">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-navy-600">
                        @forelse($contratos as $contrato)
                            @php
                                $hoy = now();
                                $diasParaVencer = $hoy->diffInDays($contrato->fecha_vencimiento, false);

                                // Determinar clase de estado
                                if ($diasParaVencer < 0) {
                                    $estadoClase = 'bg-danger/10 text-danger dark:bg-danger/15';
                                    $estadoTexto = 'Vencido';
                                    $iconoEstado =
                                        'M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z';
                                } elseif ($diasParaVencer <= 30) {
                                    $estadoClase = 'bg-warning/10 text-warning dark:bg-warning/15';
                                    $estadoTexto = 'Próximo a vencer';
                                    $iconoEstado = 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                                } else {
                                    $estadoClase = 'bg-success/10 text-success dark:bg-success/15';
                                    $estadoTexto = 'Vigente';
                                    $iconoEstado = 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
                                }
                            @endphp

                            <tr class="hover:bg-slate-50/80 dark:hover:bg-navy-700/50 transition-colors">
                                <!-- Columna Cliente -->
                                <td class="px-5 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="avatar size-10 bg-primary/10 text-primary flex items-center justify-center rounded-full">
                                            <span class="font-medium">{{ substr($contrato->nombre_cliente, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <p class="font-medium text-slate-700 dark:text-navy-100">
                                                {{ $contrato->nombre_cliente }}</p>
                                            <p class="text-xs text-slate-500 dark:text-navy-300 mt-1">
                                                {{ $contrato->empresa->nombre ?? 'Sin empresa' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- Columna Descripción -->
                                <td class="px-5 py-4">
                                    <div class="max-w-xs">
                                        <p class="font-medium text-slate-700 dark:text-navy-100 line-clamp-1">
                                            {{ $contrato->descripcion }}</p>
                                        <div class="mt-1 flex flex-wrap gap-1">
                                            <span class="tag bg-info/10 text-info text-xs">
                                                {{ $contrato->clas_legal->nombre ?? 'Sin clasificación' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Columna Vencimiento con barra de progreso -->
                                <td class="px-5 py-4">
                                    <div class="flex items-center">
                                        <div class="mr-3">
                                            <div class="text-sm font-medium text-slate-700 dark:text-navy-100">
                                                {{ $contrato->fecha_vencimiento->format('d M Y') }}
                                            </div>
                                            <div
                                                class="text-xs {{ $diasParaVencer < 0 ? 'text-danger' : ($diasParaVencer <= 30 ? 'text-warning' : 'text-success') }} mt-1">
                                                @if ($diasParaVencer < 0)
                                                    Hace {{ abs($diasParaVencer) }} días
                                                @else
                                                    {{ $diasParaVencer }} días restantes
                                                @endif
                                            </div>
                                        </div>
                                        <div class="w-16">
                                            <div
                                                class="progress-bar h-2 rounded-full bg-slate-150 dark:bg-navy-500 overflow-hidden">
                                                <div class="h-full rounded-full 
                                                    {{ $diasParaVencer < 0 ? 'bg-danger' : ($diasParaVencer <= 30 ? 'bg-warning' : 'bg-success') }}"
                                                    style="width: {{ $diasParaVencer < 0 ? '100%' : min(100, max(0, 100 - ($diasParaVencer / 365) * 100)) }}%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Columna Valor -->
                                <td class="px-5 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-mono font-medium text-slate-800 dark:text-navy-100">
                                            {{ number_format($contrato->monto_total, 2) }}
                                        </span>
                                        <span class="text-xs text-slate-500 dark:text-navy-300 mt-1">
                                            {{ $contrato->moneda }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Columna Estado -->
                                <td class="px-5 py-4">
                                    <div class="flex items-center">
                                        <div class="relative">
                                            <div
                                                class="status-indicator {{ $diasParaVencer < 0 ? 'bg-danger' : ($diasParaVencer <= 30 ? 'bg-warning' : 'bg-success') }}">
                                            </div>
                                        </div>
                                        <div class="ml-2 text-sm font-medium">
                                            {{ $estadoTexto }}
                                        </div>
                                    </div>
                                </td>

                                <!-- Columna Acciones con menú desplegable -->
                                <td class="px-5 py-4 text-right">
                                    <div class="flex justify-end space-x-1">
                                        <div x-data="{ open: false }" class="relative">
                                            <button @click="open = !open"
                                                class="btn size-8 rounded-full p-0 bg-slate-100 hover:bg-slate-200 text-slate-600 dark:bg-navy-600 dark:hover:bg-navy-450 dark:text-navy-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                                </svg>
                                            </button>

                                            <div x-show="open" @click.away="open = false"
                                                class="absolute right-0 z-10 mt-1 w-48 origin-top-right rounded-md bg-white dark:bg-navy-700 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                <div class="py-1">
                                                    <a href="{{ route('contratos.show', $contrato->id) }}"
                                                        class="menu-item group">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="h-4 w-4 mr-2 text-slate-500 group-hover:text-primary"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Ver detalles
                                                    </a>
                                                    @if ($contrato->archivo_path)
                                                        <a href="{{ Storage::url($contrato->archivo_path) }}"
                                                            target="_blank" class="menu-item group">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4 w-4 mr-2 text-slate-500 group-hover:text-primary"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                            Descargar
                                                        </a>
                                                    @endif
                                                    <form action="{{ route('contratos', $contrato->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button"
                                                            onclick="confirmDelete({{ $contrato->id }})"
                                                            class="menu-item group w-full text-left">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-4 w-4 mr-2 text-slate-500 group-hover:bg-error"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-5 py-8 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-16 w-16 text-slate-400 dark:text-navy-300" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-slate-700 dark:text-navy-100">No se
                                            encontraron contratos</h3>
                                        <p class="text-slate-500 dark:text-navy-300 mt-2">Intenta ajustar tus filtros de
                                            búsqueda</p>
                                        <a href="{{ route('contratos') }}"
                                            class="btn bg-slate-150 hover:bg-slate-200 text-slate-800 dark:bg-navy-500 dark:hover:bg-navy-450 dark:text-navy-100 mt-4">
                                            Restablecer filtros
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación mejorada -->
            @if ($contratos->hasPages())
                <div class="border-t border-slate-200 dark:border-navy-600 px-5 py-4">
                    <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                        <div class="text-sm text-slate-600 dark:text-navy-200">
                            Mostrando {{ $contratos->firstItem() }} - {{ $contratos->lastItem() }} de
                            {{ $contratos->total() }}
                        </div>
                        <div>
                            {{ $contratos->onEachSide(1)->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <script>
            function confirmDelete(contratoId) {
                Swal.fire({
                    title: '¿Eliminar contrato?',
                    text: "Esta acción no se puede deshacer",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        confirmButton: 'btn bg-danger font-medium text-white hover:bg-danger-focus',
                        cancelButton: 'btn bg-secondary font-medium text-slate-700 hover:bg-secondary-focus'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${contratoId}`).submit();
                    }
                });
            }
        </script>
    </main>
@endsection

<style>
    .glass-card {
        background: rgba(59, 130, 246, 0.85);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .filter-pill {
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .active-pill {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            opacity: 0.7;
        }

        50% {
            opacity: 1;
        }

        100% {
            opacity: 0.7;
        }
    }

    .tag {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        line-height: 1rem;
    }

    .menu-item {
        display: flex;
        align-items: center;
        padding: 0.5rem 1.5rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .menu-item:hover {
        background-color: rgba(59, 130, 246, 0.05);
    }
</style>
