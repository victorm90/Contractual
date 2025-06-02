@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div x-data="formData()" class="min-h-screen">
            <main class="w-full max-w-7xl mx-auto px-4 pb-8">
                <!-- Encabezado -->
                <div class="flex items-center space-x-4 py-5 lg:py-6">
                    <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                        Nuevo Contrato
                    </h2>
                    <div class="hidden h-full py-1 sm:flex">
                        <div class="h-full w-px bg-slate-300 dark:bg-navy-600"></div>
                    </div>
                    <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                        <li class="flex items-center space-x-2">
                            <a class="text-primary transition-colors hover:text-primary-focus dark:text-accent dark:hover:text-accent-light"
                                href="#">Contratos</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </li>
                        <li>Nuevo Contrato</li>
                    </ul>
                </div>

                <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
                    <!-- Barra lateral de pasos -->
                    <div class="col-span-12 grid lg:col-span-4 lg:place-items-center">
                        <div class="w-full">
                            <ol class="steps is-vertical line-space [--size:2.75rem] [--line:.5rem]">
                                <!-- Paso 1: Información Básica -->
                                <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500">
                                    <div class="step-header mask is-hexagon"
                                        :class="{
                                            'bg-primary text-white dark:bg-accent': currentStep === 1,
                                            'bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100': currentStep !==
                                                1
                                        }">
                                        <i class="fa-solid fa-info-circle text-base"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-slate-400 dark:text-navy-300">
                                            Paso 1
                                        </p>
                                        <h3 class="text-base font-medium"
                                            :class="{
                                                'text-primary dark:text-accent': currentStep === 1,
                                                'text-slate-700 dark:text-navy-100': currentStep !== 1
                                            }">
                                            Información Básica
                                        </h3>
                                    </div>
                                </li>

                                <!-- Paso 2: Información de Contacto -->
                                <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500">
                                    <div class="step-header mask is-hexagon"
                                        :class="{
                                            'bg-primary text-white dark:bg-accent': currentStep === 2,
                                            'bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100': currentStep !==
                                                2
                                        }">
                                        <i class="fa-solid fa-address-book text-base"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-slate-400 dark:text-navy-300">
                                            Paso 2
                                        </p>
                                        <h3 class="text-base font-medium"
                                            :class="{
                                                'text-primary dark:text-accent': currentStep === 2,
                                                'text-slate-700 dark:text-navy-100': currentStep !== 2
                                            }">
                                            Información de Contacto
                                        </h3>
                                    </div>
                                </li>

                                <!-- Paso 3: Información Legal -->
                                <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500">
                                    <div class="step-header mask is-hexagon"
                                        :class="{
                                            'bg-primary text-white dark:bg-accent': currentStep === 3,
                                            'bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100': currentStep !==
                                                3
                                        }">
                                        <i class="fa-solid fa-balance-scale text-base"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-slate-400 dark:text-navy-300">
                                            Paso 3
                                        </p>
                                        <h3 class="text-base font-medium"
                                            :class="{
                                                'text-primary dark:text-accent': currentStep === 3,
                                                'text-slate-700 dark:text-navy-100': currentStep !== 3
                                            }">
                                            Información Legal
                                        </h3>
                                    </div>
                                </li>

                                <!-- Paso 4: Términos y Documentos -->
                                <li class="step space-x-4 before:bg-slate-200 dark:before:bg-navy-500">
                                    <div class="step-header mask is-hexagon"
                                        :class="{
                                            'bg-primary text-white dark:bg-accent': currentStep === 4,
                                            'bg-slate-200 text-slate-500 dark:bg-navy-500 dark:text-navy-100': currentStep !==
                                                4
                                        }">
                                        <i class="fa-solid fa-file-signature text-base"></i>
                                    </div>
                                    <div class="text-left">
                                        <p class="text-xs text-slate-400 dark:text-navy-300">
                                            Paso 4
                                        </p>
                                        <h3 class="text-base font-medium"
                                            :class="{
                                                'text-primary dark:text-accent': currentStep === 4,
                                                'text-slate-700 dark:text-navy-100': currentStep !== 4
                                            }">
                                            Términos y Documentos
                                        </h3>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <!-- Contenido principal del formulario -->
                    <div class="col-span-12 grid lg:col-span-8">
                        <div class="card">
                            <!-- Encabezado de la tarjeta -->
                            <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                                <div class="flex items-center space-x-2">
                                    <div
                                        class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-1 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                                        <i class="fa-solid"
                                            :class="{
                                                'fa-info-circle': currentStep === 1,
                                                'fa-address-book': currentStep === 2,
                                                'fa-balance-scale': currentStep === 3,
                                                'fa-file-signature': currentStep === 4
                                            }"></i>
                                    </div>
                                    <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                        <span x-text="stepTitle"></span>
                                    </h4>
                                </div>
                            </div>

                            <!-- Contenido del formulario -->
                            <div class="space-y-4 p-4 sm:p-5">
                                <!-- Paso 1: Información Básica -->
                                <div x-show="currentStep === 1" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                            Nombre del Cliente <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" x-model="form.nombre_cliente" required
                                            class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                            Descripción <span class="text-red-500">*</span>
                                        </label>
                                        <textarea x-model="form.descripcion" rows="3" required
                                            class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Clasificación Legal <span class="text-red-500">*</span>
                                            </label>
                                            <select x-model="form.clas_legal_id" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="">Seleccione...</option>
                                                <option value="1">Contrato de Servicios</option>
                                                <option value="2">Contrato de Suministro</option>
                                                <option value="3">Contrato de Arrendamiento</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Empresa <span class="text-red-500">*</span>
                                            </label>
                                            <select x-model="form.empresa_id" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="">Seleccione...</option>
                                                <option value="1">Empresa A</option>
                                                <option value="2">Empresa B</option>
                                                <option value="3">Empresa C</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Paso 2: Información de Contacto -->
                                <div x-show="currentStep === 2" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Teléfono
                                            </label>
                                            <input type="text" x-model="form.telefono"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Email
                                            </label>
                                            <input type="email" x-model="form.email"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                            Dirección
                                        </label>
                                        <textarea x-model="form.direccion" rows="2"
                                            class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Provincia <span class="text-red-500">*</span>
                                            </label>
                                            <select x-model="form.provincia_id" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="">Seleccione...</option>
                                                <option value="1">La Habana</option>
                                                <option value="2">Matanzas</option>
                                                <option value="3">Villa Clara</option>
                                            </select>
                                        </div>

                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Municipio <span class="text-red-500">*</span>
                                            </label>
                                            <select x-model="form.municipio_id" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="">Seleccione...</option>
                                                <option value="1">Playa</option>
                                                <option value="2">Plaza</option>
                                                <option value="3">Centro Habana</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Paso 3: Información Legal -->
                                <div x-show="currentStep === 3" class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                            Representante Legal
                                        </label>
                                        <input type="text" x-model="form.representante_legal"
                                            class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Código REUUP
                                            </label>
                                            <input type="text" x-model="form.cod_reuup"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Código NIT
                                            </label>
                                            <input type="text" x-model="form.codigo_nit"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Cuenta Bancaria
                                            </label>
                                            <input type="text" x-model="form.cta_bancaria"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Sucursal de Crédito
                                            </label>
                                            <input type="text" x-model="form.sucursal_credito"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                    </div>
                                </div>

                                <!-- Paso 4: Términos y Documentos -->
                                <div x-show="currentStep === 4" class="space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Fecha de Firma <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" x-model="form.fecha_firmado" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Fecha de Vencimiento
                                            </label>
                                            <input type="date" x-model="form.fecha_vencimiento"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Vigencia (meses)
                                            </label>
                                            <input type="number" x-model="form.vigencia"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Días para Aviso de Renovación
                                            </label>
                                            <input type="number" x-model="form.dias_renovacion_aviso"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Forma de Pago <span class="text-red-500">*</span>
                                            </label>
                                            <select x-model="form.forma_pago_id" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="">Seleccione...</option>
                                                <option value="1">Transferencia Bancaria</option>
                                                <option value="2">Efectivo</option>
                                                <option value="3">Cheque</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Término de Pago (días)
                                            </label>
                                            <input type="number" x-model="form.termino_pago"
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Monto Total <span class="text-red-500">*</span>
                                            </label>
                                            <input type="number" x-model="form.monto_total" step="0.01" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                                Moneda <span class="text-red-500">*</span>
                                            </label>
                                            <select x-model="form.moneda" required
                                                class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                                <option value="CUP">CUP</option>
                                                <option value="USD">USD</option>
                                                <option value="EUR">EUR</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                            Documento del Contrato (PDF, Word)
                                        </label>
                                        <div @dragover.prevent="fileDragging = true" @dragleave="fileDragging = false"
                                            @drop.prevent="handleFileDrop($event)"
                                            :class="{ 'border-primary': fileDragging }" class="file-drop-area rounded-lg"
                                            @click="$refs.fileInput.click()">
                                            <i class="fas fa-cloud-upload-alt text-2xl text-slate-400 mb-2"></i>
                                            <p class="text-slate-600 dark:text-navy-200 mb-1"
                                                x-text="fileName || 'Arrastre el archivo aquí o haga clic para seleccionar'">
                                            </p>
                                            <p class="text-xs text-slate-500 dark:text-navy-300">Tamaño máximo: 2MB.
                                                Formatos aceptados: PDF, DOC, DOCX</p>
                                            <input type="file" class="hidden" x-ref="fileInput"
                                                @change="handleFileSelect" accept=".pdf,.doc,.docx">
                                        </div>
                                        <div x-show="fileName"
                                            class="mt-2 flex items-center gap-2 text-sm text-slate-700 dark:text-navy-100">
                                            <i class="fas fa-file text-slate-500 dark:text-navy-300"></i>
                                            <span x-text="fileName"></span>
                                            <button type="button" @click="removeFile"
                                                class="ml-2 text-red-500 hover:text-red-700">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-navy-200 mb-1">
                                            Observaciones
                                        </label>
                                        <textarea x-model="form.observaciones" rows="3"
                                            class="form-input w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                    </div>
                                </div>

                                <!-- Botones de navegación -->
                                <div class="flex justify-between pt-6 border-t border-slate-200 dark:border-navy-500">
                                    <button type="button" @click="prevStep" x-show="currentStep > 1"
                                        class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Anterior</span>
                                    </button>

                                    <div class="flex-grow"></div>

                                    <button type="button" @click="nextStep"
                                        class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                        <span x-text="currentStep === 4 ? 'Guardar Contrato' : 'Siguiente'"></span>
                                        <svg x-show="currentStep < 4" xmlns="http://www.w3.org/2000/svg" class="size-5"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

        <script>
            function formData() {
                return {
                    currentStep: 1,
                    stepTitle: 'Información Básica',
                    fileDragging: false,
                    fileName: '',
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
                    nextStep() {
                        if (this.currentStep < 4) {
                            this.currentStep++;
                            this.updateStepTitle();
                        } else {
                            this.submitForm();
                        }
                    },
                    prevStep() {
                        if (this.currentStep > 1) {
                            this.currentStep--;
                            this.updateStepTitle();
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
                            if (file.size > 2 * 1024 * 1024) {
                                alert('El archivo excede el tamaño máximo permitido de 2MB.');
                                return;
                            }

                            const validTypes = ['application/pdf', 'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                            ];
                            if (!validTypes.includes(file.type)) {
                                alert('Formato de archivo no válido. Por favor, suba un archivo PDF o Word.');
                                return;
                            }

                            this.fileName = file.name;
                        }
                    },
                    removeFile() {
                        this.fileName = '';
                        this.$refs.fileInput.value = '';
                    },
                    submitForm() {
                        // Generar número de contrato
                        const now = new Date();
                        const contractNum =
                            `${now.getFullYear()}${(now.getMonth()+1).toString().padStart(2, '0')}${now.getDate().toString().padStart(2, '0')}${Math.floor(Math.random() * 1000).toString().padStart(3, '0')}`;

                        alert(`Contrato guardado con éxito!\nNúmero de contrato: ${contractNum}`);
                        // Aquí iría la lógica para enviar el formulario al servidor
                    }
                }
            }
        </script>
    </main>
@endsection
