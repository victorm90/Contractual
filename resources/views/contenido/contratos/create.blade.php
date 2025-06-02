@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-file-contract me-2"></i>Nuevo Contrato</h4>
                    </div>
                    <div class="card-body">
                        <form id="contratoForm" action="{{ route('contratos.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <div class="alert alert-info">
                                        <strong>Número de contrato:</strong> Se generará automáticamente al guardar
                                        (Formato: Fecha + 3 dígitos consecutivos)
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Columna Izquierda -->
                                <div class="col-md-6">
                                    <!-- Información Básica -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Información Básica</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="nombre_cliente" class="form-label">Nombre del Cliente <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nombre_cliente"
                                                    name="nombre_cliente" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="clas_legal_id" class="form-label">Clasificación Legal <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select select2" id="clas_legal_id" name="clas_legal_id"
                                                    required>
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($clasificacionesLegales as $clas)
                                                        <option value="{{ $clas->id }}">{{ $clas->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="empresa_id" class="form-label">Empresa <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-select select2" id="empresa_id" name="empresa_id"
                                                    required>
                                                    <option value="">Seleccione...</option>
                                                    @foreach ($empresas as $empresa)
                                                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Información de Contacto -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Información de Contacto</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="telefono" class="form-label">Teléfono</label>
                                                    <input type="text" class="form-control" id="telefono"
                                                        name="telefono">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="direccion" class="form-label">Dirección</label>
                                                <textarea class="form-control" id="direccion" name="direccion" rows="2"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="provincia_id" class="form-label">Provincia <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select select2" id="provincia_id"
                                                        name="provincia_id" required>
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($provincias as $provincia)
                                                            <option value="{{ $provincia->id }}">{{ $provincia->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="municipio_id" class="form-label">Municipio <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select select2" id="municipio_id"
                                                        name="municipio_id" required disabled>
                                                        <option value="">Primero seleccione una provincia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Columna Derecha -->
                                <div class="col-md-6">
                                    <!-- Información Legal -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Información Legal</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="representante_legal" class="form-label">Representante
                                                    Legal</label>
                                                <input type="text" class="form-control" id="representante_legal"
                                                    name="representante_legal">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="cod_reuup" class="form-label">Código REUUP</label>
                                                    <input type="text" class="form-control" id="cod_reuup"
                                                        name="cod_reuup">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="codigo_nit" class="form-label">Código NIT</label>
                                                    <input type="text" class="form-control" id="codigo_nit"
                                                        name="codigo_nit">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="cta_bancaria" class="form-label">Cuenta Bancaria</label>
                                                    <input type="text" class="form-control" id="cta_bancaria"
                                                        name="cta_bancaria">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="sucursal_credito" class="form-label">Sucursal de
                                                        Crédito</label>
                                                    <input type="text" class="form-control" id="sucursal_credito"
                                                        name="sucursal_credito">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Términos del Contrato -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Términos del Contrato</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="fecha_firmado" class="form-label">Fecha de Firma <span
                                                            class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="fecha_firmado"
                                                        name="fecha_firmado" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="fecha_vencimiento" class="form-label">Fecha de
                                                        Vencimiento</label>
                                                    <input type="date" class="form-control" id="fecha_vencimiento"
                                                        name="fecha_vencimiento">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="vigencia" class="form-label">Vigencia (meses)</label>
                                                    <input type="number" class="form-control" id="vigencia"
                                                        name="vigencia">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="dias_renovacion_aviso" class="form-label">Días para Aviso
                                                        de Renovación</label>
                                                    <input type="number" class="form-control" id="dias_renovacion_aviso"
                                                        name="dias_renovacion_aviso">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="forma_pago_id" class="form-label">Forma de Pago <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="forma_pago_id" name="forma_pago_id"
                                                        required>
                                                        <option value="">Seleccione...</option>
                                                        @foreach ($formasPago as $forma)
                                                            <option value="{{ $forma->id }}">{{ $forma->nombre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="termino_pago" class="form-label">Término de Pago
                                                        (días)</label>
                                                    <input type="number" class="form-control" id="termino_pago"
                                                        name="termino_pago">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="monto_total" class="form-label">Monto Total <span
                                                            class="text-danger">*</span></label>
                                                    <input type="number" step="0.01" class="form-control"
                                                        id="monto_total" name="monto_total" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="moneda" class="form-label">Moneda <span
                                                            class="text-danger">*</span></label>
                                                    <select class="form-select" id="moneda" name="moneda" required>
                                                        <option value="CUP">CUP</option>
                                                        <option value="USD">USD</option>
                                                        <option value="EUR">EUR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Archivo y Observaciones -->
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-header bg-light">
                                            <h5 class="mb-0">Documentación</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="archivo" class="form-label">Documento del Contrato (PDF,
                                                    Word)</label>
                                                <div class="file-drop-area">
                                                    <span class="file-msg">Arrastre el archivo aquí o haga clic para
                                                        seleccionar</span>
                                                    <input class="file-input" type="file" id="archivo"
                                                        name="archivo" accept=".pdf,.doc,.docx">
                                                </div>
                                                <small class="text-muted">Tamaño máximo: 2MB. Formatos aceptados: PDF, DOC,
                                                    DOCX</small>
                                            </div>

                                            <div class="mb-3">
                                                <label for="observaciones" class="form-label">Observaciones</label>
                                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('contratos') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i> Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Guardar Contrato
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
