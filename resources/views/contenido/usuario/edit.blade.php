{{-- Modal de edición --}}
<div x-show="showEditModal" x-cloak
    class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-navy-700 rounded-lg shadow-lg w-full max-w-md">
        <div class="p-5">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Editar Usuario</h3>

            <form @submit.prevent="submitForm">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <label class="block mt-4">
                    <span class="text-slate-700 dark:text-navy-100">Nombre Completo</span>
                    <input x-model="formData.name" type="text" required
                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2">
                </label>

                <!-- Username -->
                <label class="block mt-4">
                    <span class="text-slate-700 dark:text-navy-100">Usuario</span>
                    <input x-model="formData.username" type="text" required
                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2">
                </label>

                <!-- Email -->
                <label class="block mt-4">
                    <span class="text-slate-700 dark:text-navy-100">Email</span>
                    <input x-model="formData.email" type="email" required
                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2">
                </label>

                <!-- Rol -->
                <label class="block mt-4">
                    <span class="text-slate-700 dark:text-navy-100">Rol</span>
                    <select x-model="formData.role" required
                        class="form-select mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2">
                        <option value="admin">Admin</option>
                        <option value="comercial">Comercial</option>
                    </select>
                </label>

                <div class="flex justify-end space-x-3 mt-6">
                    <button @click.prevent="showEditModal = false" type="button"
                        class="btn border border-slate-300 dark:border-navy-450">Cancelar</button>
                    <button type="submit" class="btn bg-primary text-white hover:bg-primary-focus">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
