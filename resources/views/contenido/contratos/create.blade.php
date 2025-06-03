@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <style>
            :root {
                --primary: #4361ee;
                --primary-light: #eef2ff;
                --primary-dark: #3a56d4;
                --accent: #06b6d4;
                --success: #10b981;
                --warning: #f59e0b;
                --danger: #ef4444;
                --dark: #1e293b;
                --light: #f8fafc;
                --gray-100: #f1f5f9;
                --gray-200: #e2e8f0;
                --gray-300: #cbd5e1;
                --gray-400: #94a3b8;
                --gray-500: #64748b;
                --gray-600: #475569;
                --gray-700: #334155;
                --gray-800: #1e293b;
                --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                --radius-sm: 0.375rem;
                --radius-md: 0.5rem;
                --radius-lg: 0.75rem;
                --transition: all 0.3s ease;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
                background-color: #f0f4f8;
                color: var(--gray-700);
                line-height: 1.6;
            }

            .main-content {
                max-width: 100%;
                padding: 2rem;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
            }

            /* Header */
            .page-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid var(--gray-200);
            }

            .page-title {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .page-title h2 {
                font-size: 1.75rem;
                font-weight: 700;
                color: var(--dark);
                letter-spacing: -0.025em;
            }

            .page-title .icon {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 2.5rem;
                height: 2.5rem;
                border-radius: var(--radius-md);
                background: var(--primary-light);
                color: var(--primary);
            }

            /* Layout */
            .contract-form-container {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            @media (min-width: 1024px) {
                .contract-form-container {
                    grid-template-columns: 320px 1fr;
                }
            }

            /* Steps */
            .steps-container {
                background: white;
                border-radius: var(--radius-lg);
                padding: 1.5rem;
                box-shadow: var(--shadow-sm);
                position: relative;
                overflow: hidden;
            }

            .steps-container::before {
                content: '';
                position: absolute;
                top: 5rem;
                bottom: 5rem;
                left: 2.5rem;
                width: 2px;
                background: var(--gray-200);
                z-index: 1;
            }

            .step {
                position: relative;
                display: flex;
                margin-bottom: 2rem;
                z-index: 2;
            }

            .step:last-child {
                margin-bottom: 0;
            }

            .step-icon {
                width: 3rem;
                height: 3rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 1rem;
                flex-shrink: 0;
                background: var(--gray-100);
                color: var(--gray-500);
                border: 2px solid var(--gray-300);
                transition: var(--transition);
            }

            .step.active .step-icon {
                background: var(--primary);
                color: white;
                border-color: var(--primary);
                box-shadow: 0 4px 6px -1px rgba(67, 97, 238, 0.3), 0 2px 4px -1px rgba(67, 97, 238, 0.1);
            }

            .step.completed .step-icon {
                background: var(--success);
                color: white;
                border-color: var(--success);
            }

            .step-content {
                flex: 1;
            }

            .step-content h3 {
                font-weight: 600;
                font-size: 1rem;
                margin-bottom: 0.25rem;
                color: var(--gray-700);
            }

            .step.active .step-content h3 {
                color: var(--primary);
            }

            .step-content p {
                font-size: 0.875rem;
                color: var(--gray-500);
            }

            /* Form Card */
            .form-card {
                background: white;
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-md);
                overflow: hidden;
            }

            .card-header {
                padding: 1.5rem;
                background: var(--primary-light);
                border-bottom: 1px solid var(--gray-200);
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }

            .card-header-icon {
                width: 2.5rem;
                height: 2.5rem;
                border-radius: var(--radius-md);
                background: var(--primary);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .card-header h3 {
                font-size: 1.25rem;
                font-weight: 600;
                color: var(--dark);
            }

            .card-body {
                padding: 1.5rem;
            }

            /* Form Elements */
            .form-group {
                margin-bottom: 1.25rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-weight: 500;
                color: var(--gray-700);
                font-size: 0.875rem;
            }

            .required::after {
                content: '*';
                color: var(--danger);
                margin-left: 0.25rem;
            }

            .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                border: 1px solid var(--gray-300);
                border-radius: var(--radius-md);
                font-family: inherit;
                font-size: 1rem;
                transition: var(--transition);
                background: white;
            }

            .form-control:focus {
                outline: none;
                border-color: var(--primary);
                box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            }

            .form-control.error {
                border-color: var(--danger);
            }

            .error-message {
                display: block;
                margin-top: 0.25rem;
                font-size: 0.75rem;
                color: var(--danger);
            }

            .grid-cols-2 {
                display: grid;
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            @media (min-width: 640px) {
                .grid-cols-2 {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            /* File Upload */
            .file-upload {
                border: 2px dashed var(--gray-300);
                border-radius: var(--radius-md);
                padding: 2rem;
                text-align: center;
                transition: var(--transition);
                cursor: pointer;
                background: var(--gray-100);
            }

            .file-upload:hover,
            .file-upload.dragover {
                border-color: var(--primary);
                background: var(--primary-light);
            }

            .file-upload-icon {
                font-size: 2.5rem;
                color: var(--gray-400);
                margin-bottom: 0.75rem;
            }

            .file-upload-text {
                margin-bottom: 0.5rem;
                color: var(--gray-600);
            }

            .file-upload-hint {
                font-size: 0.875rem;
                color: var(--gray-500);
            }

            .file-preview {
                display: flex;
                align-items: center;
                background: var(--gray-100);
                padding: 0.75rem;
                border-radius: var(--radius-md);
                margin-top: 1rem;
            }

            .file-preview i {
                font-size: 1.5rem;
                color: var(--primary);
                margin-right: 0.75rem;
            }

            .file-preview-info {
                flex: 1;
            }

            .file-preview-name {
                font-weight: 500;
                color: var(--gray-700);
            }

            .file-preview-size {
                font-size: 0.875rem;
                color: var(--gray-500);
            }

            /* Buttons */
            .form-footer {
                display: flex;
                justify-content: space-between;
                padding: 1.5rem;
                border-top: 1px solid var(--gray-200);
                margin-top: 1rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                border-radius: var(--radius-md);
                font-weight: 500;
                font-family: inherit;
                font-size: 1rem;
                cursor: pointer;
                transition: var(--transition);
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                border: none;
            }

            .btn-prev {
                background: white;
                color: var(--gray-700);
                border: 1px solid var(--gray-300);
            }

            .btn-prev:hover {
                background: var(--gray-100);
                border-color: var(--gray-400);
            }

            .btn-next {
                background: var(--primary);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-next:hover {
                background: var(--primary-dark);
                box-shadow: 0 10px 15px -3px rgba(67, 97, 238, 0.3), 0 4px 6px -2px rgba(67, 97, 238, 0.1);
            }

            .btn-submit {
                background: var(--success);
                color: white;
                box-shadow: var(--shadow-md);
            }

            .btn-submit:hover {
                background: #0da271;
            }

            /* Progress Bar */
            .progress-container {
                padding: 0 1.5rem 1.5rem;
            }

            .progress-header {
                display: flex;
                justify-content: space-between;
                margin-bottom: 0.5rem;
            }

            .progress-title {
                font-weight: 500;
                color: var(--gray-700);
            }

            .progress-value {
                font-weight: 600;
                color: var(--primary);
            }

            .progress-bar {
                height: 8px;
                background: var(--gray-200);
                border-radius: 4px;
                overflow: hidden;
            }

            .progress-fill {
                height: 100%;
                background: var(--primary);
                border-radius: 4px;
                transition: width 0.5s ease;
            }

            /* Animations */
            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .fade-in {
                animation: fadeIn 0.4s ease forwards;
            }
        </style>
        <div class="container" x-data="formData()">
            <!-- Encabezado -->
            <div class="page-header">
                <div class="page-title">
                    <div class="icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h2>Nuevo Contrato</h2>
                </div>
            </div>

            <!-- Contenedor principal -->
            <div class="contract-form-container">
                <!-- Barra lateral de pasos -->
                <div class="steps-container">
                    <div class="step" :class="{ 'active': currentStep === 1, 'completed': currentStep > 1 }">
                        <div class="step-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="step-content">
                            <h3>Información Básica</h3>
                            <p>Datos principales del contrato</p>
                        </div>
                    </div>

                    <div class="step" :class="{ 'active': currentStep === 2, 'completed': currentStep > 2 }">
                        <div class="step-icon">
                            <i class="fas fa-address-book"></i>
                        </div>
                        <div class="step-content">
                            <h3>Información de Contacto</h3>
                            <p>Detalles de contacto del cliente</p>
                        </div>
                    </div>

                    <div class="step" :class="{ 'active': currentStep === 3, 'completed': currentStep > 3 }">
                        <div class="step-icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <div class="step-content">
                            <h3>Información Legal</h3>
                            <p>Datos legales y registros</p>
                        </div>
                    </div>

                    <div class="step" :class="{ 'active': currentStep === 4, 'completed': currentStep > 4 }">
                        <div class="step-icon">
                            <i class="fas fa-file-signature"></i>
                        </div>
                        <div class="step-content">
                            <h3>Términos y Documentos</h3>
                            <p>Finalizar y adjuntar documentos</p>
                        </div>
                    </div>
                </div>

                <!-- Contenido principal del formulario -->
                <div class="form-card">
                    <!-- Barra de progreso -->
                    <div class="progress-container">
                        <div class="progress-header">
                            <span class="progress-title">Progreso del formulario</span>
                            <span class="progress-value" x-text="`${progress}%`"></span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" :style="`width: ${progress}%`"></div>
                        </div>
                    </div>

                    <!-- Encabezado de la tarjeta -->
                    <div class="card-header">
                        <div class="card-header-icon">
                            <i class="fas"
                                :class="{
                                    'fa-info-circle': currentStep === 1,
                                    'fa-address-book': currentStep === 2,
                                    'fa-balance-scale': currentStep === 3,
                                    'fa-file-signature': currentStep === 4
                                }"></i>
                        </div>
                        <h3 x-text="stepTitle"></h3>
                    </div>

                    <!-- Contenido del formulario -->
                    <div class="card-body">
                        <!-- Paso 1: Información Básica -->
                        <div x-show="currentStep === 1" class="fade-in">
                            <div class="form-group">
                                <label class="form-label required">Nombre del Cliente</label>
                                <input type="text" x-model="form.nombre_cliente" required class="form-control">
                                <span class="error-message" x-show="errors.nombre_cliente">Este campo es obligatorio</span>
                            </div>

                            <div class="form-group">
                                <label class="form-label required">Descripción</label>
                                <textarea x-model="form.descripcion" rows="3" required class="form-control"></textarea>
                                <span class="error-message" x-show="errors.descripcion">Este campo es obligatorio</span>
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label required">Clasificación Legal</label>
                                    <select x-model="form.clas_legal_id" required class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Contrato de Servicios</option>
                                        <option value="2">Contrato de Suministro</option>
                                        <option value="3">Contrato de Arrendamiento</option>
                                        <option value="4">Contrato de Licencia</option>
                                        <option value="5">Contrato de Confidencialidad</option>
                                    </select>
                                    <span class="error-message" x-show="errors.clas_legal_id">Este campo es
                                        obligatorio</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label required">Empresa</label>
                                    <select x-model="form.empresa_id" required class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Empresa A</option>
                                        <option value="2">Empresa B</option>
                                        <option value="3">Empresa C</option>
                                        <option value="4">Empresa D</option>
                                    </select>
                                    <span class="error-message" x-show="errors.empresa_id">Este campo es obligatorio</span>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 2: Información de Contacto -->
                        <div x-show="currentStep === 2" class="fade-in">
                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" x-model="form.telefono" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" x-model="form.email" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Dirección</label>
                                <textarea x-model="form.direccion" rows="2" class="form-control"></textarea>
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label required">Provincia</label>
                                    <select x-model="form.provincia_id" required class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">La Habana</option>
                                        <option value="2">Matanzas</option>
                                        <option value="3">Villa Clara</option>
                                        <option value="4">Pinar del Río</option>
                                        <option value="5">Santiago de Cuba</option>
                                    </select>
                                    <span class="error-message" x-show="errors.provincia_id">Este campo es
                                        obligatorio</span>
                                </div>

                                <div class="form-group">
                                    <label class="form-label required">Municipio</label>
                                    <select x-model="form.municipio_id" required class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Playa</option>
                                        <option value="2">Plaza</option>
                                        <option value="3">Centro Habana</option>
                                        <option value="4">Habana Vieja</option>
                                    </select>
                                    <span class="error-message" x-show="errors.municipio_id">Este campo es
                                        obligatorio</span>
                                </div>
                            </div>
                        </div>

                        <!-- Paso 3: Información Legal -->
                        <div x-show="currentStep === 3" class="fade-in">
                            <div class="form-group">
                                <label class="form-label">Representante Legal</label>
                                <input type="text" x-model="form.representante_legal" class="form-control">
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label">Código REUUP</label>
                                    <input type="text" x-model="form.cod_reuup" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Código NIT</label>
                                    <input type="text" x-model="form.codigo_nit" class="form-control">
                                </div>
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label">Cuenta Bancaria</label>
                                    <input type="text" x-model="form.cta_bancaria" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Sucursal de Crédito</label>
                                    <input type="text" x-model="form.sucursal_credito" class="form-control">
                                </div>
                            </div>
                        </div>

                        <!-- Paso 4: Términos y Documentos -->
                        <div x-show="currentStep === 4" class="fade-in">
                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label required">Fecha de Firma</label>
                                    <input type="date" x-model="form.fecha_firmado" required class="form-control">
                                    <span class="error-message" x-show="errors.fecha_firmado">Este campo es
                                        obligatorio</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Fecha de Vencimiento</label>
                                    <input type="date" x-model="form.fecha_vencimiento" class="form-control">
                                </div>
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label">Vigencia (meses)</label>
                                    <input type="number" x-model="form.vigencia" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Días para Aviso de Renovación</label>
                                    <input type="number" x-model="form.dias_renovacion_aviso" class="form-control">
                                </div>
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label required">Forma de Pago</label>
                                    <select x-model="form.forma_pago_id" required class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="1">Transferencia Bancaria</option>
                                        <option value="2">Efectivo</option>
                                        <option value="3">Cheque</option>
                                        <option value="4">Tarjeta de Crédito</option>
                                    </select>
                                    <span class="error-message" x-show="errors.forma_pago_id">Este campo es
                                        obligatorio</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Término de Pago (días)</label>
                                    <input type="number" x-model="form.termino_pago" class="form-control">
                                </div>
                            </div>

                            <div class="grid-cols-2">
                                <div class="form-group">
                                    <label class="form-label required">Monto Total</label>
                                    <input type="number" x-model="form.monto_total" step="0.01" required
                                        class="form-control">
                                    <span class="error-message" x-show="errors.monto_total">Este campo es
                                        obligatorio</span>
                                </div>
                                <div class="form-group">
                                    <label class="form-label required">Moneda</label>
                                    <select x-model="form.moneda" required class="form-control">
                                        <option value="CUP">CUP</option>
                                        <option value="USD">USD</option>
                                        <option value="EUR">EUR</option>
                                        <option value="MLC">MLC</option>
                                    </select>
                                    <span class="error-message" x-show="errors.moneda">Este campo es obligatorio</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Documento del Contrato (PDF, Word)</label>
                                <div class="file-upload" @dragover.prevent="fileDragging = true"
                                    @dragleave="fileDragging = false" @drop.prevent="handleFileDrop($event)"
                                    :class="{ 'dragover': fileDragging }" @click="$refs.fileInput.click()">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </div>
                                    <p class="file-upload-text"
                                        x-text="fileName || 'Arrastre el archivo aquí o haga clic para seleccionar'"></p>
                                    <p class="file-upload-hint">Tamaño máximo: 2MB. Formatos aceptados: PDF, DOC, DOCX</p>
                                    <input type="file" class="hidden" x-ref="fileInput" @change="handleFileSelect"
                                        accept=".pdf,.doc,.docx">
                                </div>

                                <div x-show="fileName" class="file-preview">
                                    <i class="fas fa-file-pdf"></i>
                                    <div class="file-preview-info">
                                        <div class="file-preview-name" x-text="fileName"></div>
                                        <div class="file-preview-size" x-text="fileSize"></div>
                                    </div>
                                    <button type="button" @click="removeFile" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Observaciones</label>
                                <textarea x-model="form.observaciones" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Pie de página con botones de navegación -->
                    <div class="form-footer">
                        <button type="button" @click="prevStep" x-show="currentStep > 1" class="btn btn-prev">
                            <i class="fas fa-arrow-left"></i> Anterior
                        </button>
                        <div x-show="currentStep === 1"></div>

                        <button type="button" @click="nextStep" class="btn"
                            :class="{
                                'btn-next': currentStep < 4,
                                'btn-submit': currentStep === 4
                            }">
                            <span x-text="currentStep === 4 ? 'Guardar Contrato' : 'Siguiente'"></span>
                            <i class="fas" :class="currentStep === 4 ? 'fa-check' : 'fa-arrow-right'"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function formData() {
                return {
                    currentStep: 1,
                    stepTitle: 'Información Básica',
                    progress: 25,
                    fileDragging: false,
                    fileName: '',
                    fileSize: '',
                    errors: {
                        nombre_cliente: false,
                        descripcion: false,
                        clas_legal_id: false,
                        empresa_id: false,
                        provincia_id: false,
                        municipio_id: false,
                        fecha_firmado: false,
                        forma_pago_id: false,
                        monto_total: false,
                        moneda: false
                    },
                    form: {
                        nombre_cliente: '',
                        descripcion: '',
                        clas_legal_id: '',
                        empresa_id: '',
                        telefono: '',
                        email: '',
                        direccion: '',
                        provincia_id: '',
                        municipio_id: '',
                        representante_legal: '',
                        cod_reuup: '',
                        codigo_nit: '',
                        cta_bancaria: '',
                        sucursal_credito: '',
                        fecha_firmado: '',
                        fecha_vencimiento: '',
                        vigencia: '',
                        dias_renovacion_aviso: '',
                        forma_pago_id: '',
                        termino_pago: '',
                        monto_total: '',
                        moneda: 'CUP',
                        observaciones: ''
                    },
                    validateStep() {
                        let isValid = true;

                        // Reset errors
                        Object.keys(this.errors).forEach(key => this.errors[key] = false);

                        // Validate current step
                        if (this.currentStep === 1) {
                            if (!this.form.nombre_cliente.trim()) {
                                this.errors.nombre_cliente = true;
                                isValid = false;
                            }
                            if (!this.form.descripcion.trim()) {
                                this.errors.descripcion = true;
                                isValid = false;
                            }
                            if (!this.form.clas_legal_id) {
                                this.errors.clas_legal_id = true;
                                isValid = false;
                            }
                            if (!this.form.empresa_id) {
                                this.errors.empresa_id = true;
                                isValid = false;
                            }
                        }

                        if (this.currentStep === 2) {
                            if (!this.form.provincia_id) {
                                this.errors.provincia_id = true;
                                isValid = false;
                            }
                            if (!this.form.municipio_id) {
                                this.errors.municipio_id = true;
                                isValid = false;
                            }
                        }

                        if (this.currentStep === 4) {
                            if (!this.form.fecha_firmado) {
                                this.errors.fecha_firmado = true;
                                isValid = false;
                            }
                            if (!this.form.forma_pago_id) {
                                this.errors.forma_pago_id = true;
                                isValid = false;
                            }
                            if (!this.form.monto_total) {
                                this.errors.monto_total = true;
                                isValid = false;
                            }
                            if (!this.form.moneda) {
                                this.errors.moneda = true;
                                isValid = false;
                            }
                        }

                        return isValid;
                    },
                    nextStep() {
                        if (!this.validateStep()) {
                            return;
                        }

                        if (this.currentStep < 4) {
                            this.currentStep++;
                            this.updateStepTitle();
                            this.updateProgress();
                        } else {
                            this.submitForm();
                        }
                    },
                    prevStep() {
                        if (this.currentStep > 1) {
                            this.currentStep--;
                            this.updateStepTitle();
                            this.updateProgress();
                        }
                    },
                    updateStepTitle() {
                        const titles = {
                            1: 'Información Básica',
                            2: 'Información de Contacto',
                            3: 'Información Legal',
                            4: 'Términos y Documentos'
                        };
                        this.stepTitle = titles[this.currentStep];
                    },
                    updateProgress() {
                        this.progress = this.currentStep * 25;
                    },
                    handleFileDrop(e) {
                        this.fileDragging = false;
                        const files = e.dataTransfer.files;
                        if (files.length) {
                            this.handleFiles(files[0]);
                        }
                    },
                    handleFileSelect(e) {
                        this.handleFiles(e.target.files[0]);
                    },
                    handleFiles(file) {
                        if (file) {
                            // Validate file size
                            if (file.size > 2 * 1024 * 1024) {
                                alert('El archivo excede el tamaño máximo permitido de 2MB.');
                                return;
                            }

                            // Validate file type
                            const validTypes = ['application/pdf', 'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                            ];
                            if (!validTypes.includes(file.type)) {
                                alert('Formato de archivo no válido. Por favor, suba un archivo PDF o Word.');
                                return;
                            }

                            this.fileName = file.name;
                            this.fileSize = this.formatFileSize(file.size);
                        }
                    },
                    formatFileSize(bytes) {
                        if (bytes === 0) return '0 Bytes';
                        const k = 1024;
                        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                        const i = Math.floor(Math.log(bytes) / Math.log(k));
                        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                    },
                    removeFile() {
                        this.fileName = '';
                        this.fileSize = '';
                        this.$refs.fileInput.value = '';
                    },
                    submitForm() {
                        // Generate contract number
                        const now = new Date();
                        const contractNum =
                            `${now.getFullYear()}${(now.getMonth()+1).toString().padStart(2, '0')}${now.getDate().toString().padStart(2, '0')}${Math.floor(Math.random() * 1000).toString().padStart(3, '0')}`;

                        // Show success modal
                        this.showSuccessModal(contractNum);
                    },
                    showSuccessModal(contractNum) {
                        // In a real app, this would be a proper modal
                        alert(
                            `¡Contrato guardado con éxito!\nNúmero de contrato: ${contractNum}\n\nSerá redirigido a la página de detalles.`);

                        // Simulate redirect
                        setTimeout(() => {
                            // In a real app: window.location.href = `/contratos/${contractNum}`;
                            alert('Redirigiendo a la página de detalles del contrato...');
                        }, 1500);
                    }
                }
            }
        </script>

    </main>
@endsection
