@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center justify-between py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Gestión de Contratos
            </h2>

            <!-- Filtros de estado -->
            <div class="flex items-center space-x-2">
                <span class="text-sm text-slate-600 dark:text-navy-200">Filtrar:</span>
                <a href="{{ route('contratos') }}?estado=vigente"
                    class="badge px-3 py-1.5 rounded-full text-xs+ font-medium 
                    {{ request('estado') === 'vigente' ? 'bg-success/10 text-success' : 'bg-slate-100 text-slate-800 dark:bg-navy-500 dark:text-navy-100' }}">
                    Vigentes
                </a>
                <a href="{{ route('contratos') }}?estado=vencido"
                    class="badge px-3 py-1.5 rounded-full text-xs+ font-medium 
                    {{ request('estado') === 'vencido' ? 'bg-danger/10 text-danger' : 'bg-slate-100 text-slate-800 dark:bg-navy-500 dark:text-navy-100' }}">
                    Vencidos
                </a>
                <a href="{{ route('contratos') }}"
                    class="badge px-3 py-1.5 rounded-full text-xs+ font-medium bg-slate-100 text-slate-800 dark:bg-navy-500 dark:text-navy-100">
                    Todos
                </a>
            </div>
        </div>

        <!-- Contenedor para Toasts -->
        <div id="toast-container" class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4"></div>

        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
            <!-- Contratos Table -->
            <div>
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        Listado de Contratos
                    </h2>
                    <div class="flex">
                        <!-- Botón de búsqueda -->
                        <div class="flex items-center" x-data="{ isInputActive: false, search: '{{ $search ?? '' }}' }">
                            <input x-show="isInputActive" x-model="search" x-transition
                                class="form-input bg-transparent px-3 py-1.5 mr-2 w-48 transition-all duration-200 rounded-full border border-slate-300 focus:border-primary dark:border-navy-450 dark:focus:border-accent"
                                placeholder="Buscar contrato..." type="text"
                                @keyup.enter="window.location.href = '{{ route('contratos') }}?search=' + search">
                            <button @click="isInputActive = !isInputActive"
                                class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Botón de agregar nuevo -->
                        <div x-data="{ showModal: false }">
                            <button @click="showModal = true"
                                class="btn bg-primary text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4">
                                    </path>
                                </svg>
                                <span class="hidden sm:inline">Nuevo Contrato</span>
                            </button>

                            @include('contenido.contratos.create')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                <table class="is-hoverable w-full text-left">
                    <thead>
                        <tr>
                            <th
                                class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Cliente
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Descripción
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Fecha Vencimiento
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Monto Total
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Estado
                            </th>
                            <th
                                class="whitespace-nowrap rounded-tr-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
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

                            <tr
                                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500 hover:bg-slate-100/75 dark:hover:bg-navy-600/75">
                                <td
                                    class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar size-9">
                                            <div class="is-initial rounded-full bg-info/10 text-info">
                                                {{ substr($contrato->nombre_cliente, 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $contrato->nombre_cliente }}</p>
                                            <p class="text-xs text-slate-500 dark:text-navy-300">
                                                {{ $contrato->empresa->nombre ?? 'Sin empresa' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 sm:px-5">
                                    <div class="max-w-xs">
                                        <p class="line-clamp-1 font-medium">{{ $contrato->descripcion }}</p>
                                        <p class="mt-1 text-xs text-slate-500 dark:text-navy-300">
                                            {{ $contrato->clas_legal->nombre ?? 'Sin clasificación' }}
                                        </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div>
                                        <p class="font-medium">{{ $contrato->fecha_vencimiento->format('d M Y') }}</p>
                                        <p
                                            class="text-xs {{ $diasParaVencer < 0 ? 'text-danger' : ($diasParaVencer <= 30 ? 'text-warning' : 'text-success') }}">
                                            @if ($diasParaVencer < 0)
                                                Hace {{ abs($diasParaVencer) }} días
                                            @else
                                                {{ $diasParaVencer }} días restantes
                                            @endif
                                        </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="flex items-center">
                                        <span
                                            class="font-mono font-medium">{{ number_format($contrato->monto_total, 2) }}</span>
                                        <span
                                            class="ml-1 text-xs uppercase text-slate-500 dark:text-navy-300">{{ $contrato->moneda }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="flex items-center">
                                        <div
                                            class="badge {{ $estadoClase }} space-x-1 rounded-full px-3 py-1 text-xs+ font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="{{ $iconoEstado }}" />
                                            </svg>
                                            <span>{{ $estadoTexto }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('contratos', $contrato->id) }}"
                                            class="btn size-8 rounded-full p-0 bg-info/10 text-info hover:bg-info/20 focus:bg-info/20 active:bg-info/25 dark:bg-info/15 dark:hover:bg-info/20 dark:focus:bg-info/20 dark:active:bg-info/25"
                                            title="Ver Detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        @if ($contrato->archivo_path)
                                            <a href="{{ Storage::url($contrato->archivo_path) }}" target="_blank"
                                                class="btn size-8 rounded-full p-0 bg-primary/10 text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent/15 dark:hover:bg-accent/20 dark:focus:bg-accent/20 dark:active:bg-accent/25"
                                                title="Descargar Contrato">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                </svg>
                                            </a>
                                        @endif

                                        <form action="{{ route('contratos', $contrato->id) }}" method="POST"
                                            id="delete-form-{{ $contrato->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                class="btn size-8 rounded-full p-0 bg-error/10 text-error hover:bg-error/20 focus:bg-danger/20 active:bg-danger/25 dark:bg-danger/15 dark:hover:bg-danger/20 dark:focus:bg-danger/20 dark:active:bg-danger/25"
                                                title="Eliminar" onclick="confirmDelete({{ $contrato->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="1.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-slate-500 dark:text-navy-200">
                                    No se encontraron contratos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($contratos->hasPages())
                <div
                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                    <div class="text-xs+">
                        Mostrando {{ $contratos->firstItem() }} - {{ $contratos->lastItem() }} de
                        {{ $contratos->total() }} registros
                    </div>

                    <div>
                        {{ $contratos->links('vendor.pagination.tailwind') }}
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

@section('script')

@endsection
