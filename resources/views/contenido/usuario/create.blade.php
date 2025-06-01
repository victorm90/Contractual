<!-- Modal-->
<div x-show="showModal" x-cloak class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="fixed inset-0 bg-black/50" @click="showModal = false" x-show="showModal" x-transition></div>

    <div class="relative w-full max-w-md rounded-xl bg-white shadow-2xl dark:bg-navy-700" x-show="showModal"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

        <div class="p-5 sm:p-6">
            <div class="flex items-center justify-between pb-4">
                <h3 class="text-lg font-medium text-slate-800 dark:text-navy-100">
                    Nuevo Usuario
                </h3>
                <button @click="showModal = false"
                    class="btn -mr-1.5 size-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div x-data="userForm()">
                <form @submit.prevent="submitForm">
                    <div class="space-y-4">
                        <!-- Nombre -->
                        <label class="block">
                            <span class="text-slate-700 dark:text-navy-100">Nombre Completo</span>
                            <input x-model="form.name" type="text" required
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </label>

                        <!-- Username -->
                        <label class="block">
                            <span class="text-slate-700 dark:text-navy-100">Usuario</span>
                            <input x-model="form.username" type="text" required
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </label>

                        <!-- Email -->
                        <label class="block">
                            <span class="text-slate-700 dark:text-navy-100">Email</span>
                            <input x-model="form.email" type="email" required
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </label>

                        <!-- Contraseña -->
                        <label class="block">
                            <span class="text-slate-700 dark:text-navy-100">Contraseña</span>
                            <input x-model="form.password" type="password" required
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                        </label>

                        <!-- Rol -->
                        <label class="block">
                            <span class="text-slate-700 dark:text-navy-100">Rol</span>
                            <select x-model="form.role" required
                                class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent">
                                <option value="admin">admin</option>
                                <option value="comercial">comercial</option>
                            </select>
                        </label>

                        <!-- Estado -->
                        <label class="inline-flex items-center space-x-2">
                            <input x-model="form.activo" type="checkbox"
                                class="form-checkbox is-outline h-5 w-5 rounded border-slate-400/70 before:bg-primary checked:border-primary hover:border-primary focus:border-primary dark:border-navy-400 dark:before:bg-accent dark:checked:border-accent dark:hover:border-accent dark:focus:border-accent">
                            <span class="text-slate-700 dark:text-navy-100">Activo</span>
                        </label>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button @click="showModal = false" type="button"
                            class="btn min-w-[7rem] rounded-full border border-slate-300 font-medium text-slate-700 hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-450 dark:text-navy-100 dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                            Cancelar
                        </button>
                        <button type="submit" :disabled="isSubmitting"
                            class="btn min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span x-show="!isSubmitting">Guardar</span>
                            <span x-show="isSubmitting" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 size-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Procesando...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function userForm() {
        return {
            form: {
                name: '',
                username: '',
                email: '',
                password: '',
                role: 'comercial',
                activo: true,
            },
            isSubmitting: false,
            async submitForm() {
                this.isSubmitting = true;

                try {
                    const response = await fetch('{{ route('usuarios.store') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.form)
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        window.showAlert('success', 'Usuario creado', data.message);

                        // Cerrar modal
                        this.$parent.showModal = false;

                        // Recargar la página después de 1.5 segundos
                        setTimeout(() => {
                            window.location.href = '{{ route('usuarios') }}';
                        }, 1500);
                    } else {
                        const errorMsg = data.message || 'Error al crear usuario';
                        window.showAlert('error', 'Error', errorMsg);
                    }
                } catch (error) {
                    console.error('Detalles del error:', {
                        error: error.message,
                        response: await response.text()
                    });
                    window.showAlert('error', 'Error', 'Error detallado en consola');

                } finally {
                    this.isSubmitting = false;
                }
            }
        };
    }
</script>
