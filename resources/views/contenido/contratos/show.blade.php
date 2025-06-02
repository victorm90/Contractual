@extends('layouts.main')

@section('title', 'Detalles del Contrato')


@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center justify-between py-5 lg:py-6">
            <div class="flex items-center space-x-1">
                <h2 class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                    Detalles del Contrato: <span class="text-primary">{{ $contract->nombre_cliente }}</span>
                </h2>
            </div>
            <div class="flex">
                <a href="{{ route('contratos') }}"
                    class="btn bg-secondary font-medium text-white hover:bg-secondary-focus focus:bg-secondary-focus active:bg-secondary-focus/90">
                    <i class="fas fa-arrow-left mr-2"></i>Volver
                </a>
               {{--  @can('edit-contracts')
                    <a href="{{ route('contratos.edit', $contract->id) }}"
                        class="btn bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 ml-2">
                        <i class="fas fa-edit mr-2"></i>Editar
                    </a>
                @endcan --}}
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4 lg:gap-6">
            <!-- Resumen del Contrato -->
            <div class="card col-span-2">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h3 class="font-medium text-slate-700 dark:text-navy-100">
                        Resumen del Contrato
                    </h3>
                    <div class="flex items-center">
                        <span
                            class="badge {{ $contract->estado === 'activo' ? 'bg-success' : 'bg-error' }} px-2 py-1 text-xs+ text-white">
                            {{ ucfirst($contract->estado) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Cliente</label>
                            <p class="font-medium">{{ $contract->nombre_cliente }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Empresa</label>
                            <p class="font-medium">{{ $contract->empresa->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Clasificación Legal</label>
                            <p class="font-medium">{{ $contract->clasLegal->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Forma de Pago</label>
                            <p class="font-medium">{{ $contract->formaPago->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block text-xs+ text-slate-400 dark:text-navy-300">Descripción</label>
                        <p class="mt-1">{{ $contract->descripcion ?? 'Sin descripción' }}</p>
                    </div>
                </div>
            </div>

            <!-- Fechas Clave -->
            <div class="card">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h3 class="font-medium text-slate-700 dark:text-navy-100">
                        Fechas Clave
                    </h3>
                    <i class="fas fa-calendar-alt text-slate-400"></i>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Fecha de Firma</label>
                            <p class="font-medium">
                                {{ $contract->fecha_firmado ? $contract->fecha_firmado->format('d/m/Y') : 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Fecha de Vencimiento</label>
                            <p
                                class="font-medium {{ $contract->fecha_vencimiento && $contract->fecha_vencimiento->isPast() ? 'text-error' : '' }}">
                                {{ $contract->fecha_vencimiento ? $contract->fecha_vencimiento->format('d/m/Y') : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Vigencia</label>
                            <p class="font-medium">{{ $contract->vigencia ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Días para
                                Renovación/Aviso</label>
                            <p class="font-medium">{{ $contract->dias_renovacion_aviso ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Financiera -->
            <div class="card">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h3 class="font-medium text-slate-700 dark:text-navy-100">
                        Información Financiera
                    </h3>
                    <i class="fas fa-money-bill-wave text-slate-400"></i>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Monto Total</label>
                            <p class="font-medium text-lg text-primary">
                                {{ number_format($contract->monto_total, 2) }} {{ strtoupper($contract->moneda) }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Término de Pago</label>
                            <p class="font-medium">{{ $contract->termino_pago ?? 'N/A' }} días</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Cuenta Bancaria</label>
                            <p class="font-medium">{{ $contract->cta_bancaria ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Sucursal de Crédito</label>
                            <p class="font-medium">{{ $contract->sucursal_credito ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 mt-4">
            <!-- Información de Contacto -->
            <div class="card">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h3 class="font-medium text-slate-700 dark:text-navy-100">
                        Información de Contacto
                    </h3>
                    <i class="fas fa-address-card text-slate-400"></i>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Representante Legal</label>
                            <p class="font-medium">{{ $contract->representante_legal ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Dirección</label>
                            <p class="font-medium">{{ $contract->direccion ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Ubicación</label>
                            <p class="font-medium">
                                {{ $contract->municipio->name ?? 'N/A' }}, {{ $contract->provincia->name ?? 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Email</label>
                            <p class="font-medium">{{ $contract->email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Teléfono</label>
                            <p class="font-medium">{{ $contract->telefono ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información Legal -->
            <div class="card">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h3 class="font-medium text-slate-700 dark:text-navy-100">
                        Información Legal
                    </h3>
                    <i class="fas fa-balance-scale text-slate-400"></i>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Código REUUP</label>
                            <p class="font-medium">{{ $contract->cod_reuup ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Código NIT</label>
                            <p class="font-medium">{{ $contract->codigo_nit ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Responsable</label>
                            <p class="font-medium">{{ $contract->user->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Documentación y Auditoría -->
            <div class="card">
                <div class="flex items-center justify-between border-b border-slate-200 p-4 dark:border-navy-500">
                    <h3 class="font-medium text-slate-700 dark:text-navy-100">
                        Documentación y Auditoría
                    </h3>
                    <i class="fas fa-file-contract text-slate-400"></i>
                </div>
                <div class="p-4">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Documento Adjunto</label>
                            @if ($contract->archivo_path)
                                <a href="{{ Storage::url($contract->archivo_path) }}" target="_blank"
                                    class="btn bg-info font-medium text-white hover:bg-info-focus focus:bg-info-focus active:bg-info-focus/90 mt-2">
                                    <i class="fas fa-file-pdf mr-2"></i>Ver Documento
                                </a>
                            @else
                                <p class="font-medium text-slate-400 mt-2">No hay documento adjunto</p>
                            @endif
                        </div>

                        <div>
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Observaciones</label>
                            <div class="mt-1 p-3 bg-slate-50 dark:bg-navy-700 rounded-lg">
                                {!! nl2br(e($contract->observaciones ?? 'Sin observaciones')) !!}
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-200 dark:border-navy-500">
                            <label class="block text-xs+ text-slate-400 dark:text-navy-300">Registro de Auditoría</label>
                            <div class="mt-2 space-y-2">
                                <p class="text-xs+">
                                    <span class="font-medium">Creado:</span>
                                    {{ $contract->created_at->format('d/m/Y H:i') }}
                                </p>
                                <p class="text-xs+">
                                    <span class="font-medium">Actualizado:</span>
                                    {{ $contract->updated_at->format('d/m/Y H:i') }}
                                </p>
                                @if ($contract->lastUpdatedBy)
                                    <p class="text-xs+">
                                        <span class="font-medium">Última modificación por:</span>
                                        {{ $contract->lastUpdatedBy->name }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Indicadores de Estado -->
        <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-3 sm:gap-5">
            <div class="card">
                <div class="flex justify-between p-4">
                    <div>
                        <p class="font-medium text-slate-600 dark:text-navy-100">Días restantes</p>
                        @if ($contract->fecha_vencimiento)
                            @php
                                $diasRestantes = now()->diffInDays($contract->fecha_vencimiento, false);
                            @endphp
                            <p
                                class="mt-1 text-2xl font-semibold {{ $diasRestantes < 30 ? 'text-error' : 'text-success' }}">
                                {{ $diasRestantes > 0 ? $diasRestantes : 0 }}
                                <span class="text-sm font-medium">días</span>
                            </p>
                        @else
                            <p class="mt-1 text-2xl font-semibold text-slate-400">N/A</p>
                        @endif
                    </div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-warning/10">
                        <i class="fa-regular fa-clock text-warning text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="flex justify-between p-4">
                    <div>
                        <p class="font-medium text-slate-600 dark:text-navy-100">Estado del documento</p>
                        <p
                            class="mt-1 text-2xl font-semibold {{ $contract->archivo_path ? 'text-success' : 'text-warning' }}">
                            {{ $contract->archivo_path ? 'Adjuntado' : 'Pendiente' }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-info/10">
                        <i class="fa-solid fa-file text-info text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="flex justify-between p-4">
                    <div>
                        <p class="font-medium text-slate-600 dark:text-navy-100">Estado del contrato</p>
                        <p
                            class="mt-1 text-2xl font-semibold {{ $contract->estado === 'activo' ? 'text-success' : 'text-error' }}">
                            {{ ucfirst($contract->estado) }}
                        </p>
                    </div>
                    <div class="flex items-center justify-center p-3 rounded-full bg-success/10">
                        <i class="fa-solid fa-file-contract text-success text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('styles')
    <style>
        .badge {
            border-radius: 0.25rem;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .card {
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transform: translateY(-2px);
        }

        .card-header {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
    </style>
@endsection
