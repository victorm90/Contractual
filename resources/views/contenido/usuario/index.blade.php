@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main class="main-content w-full px-[var(--margin-x)] pb-8 " x-data="userModal">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <h2 class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-2xl">
                Gestión de Usuarios
            </h2>
        </div>

        <!-- Contenedor para Toasts -->
        <div id="toast-container" class="fixed top-4 right-4 z-50 w-full max-w-xs space-y-4"></div>

        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
            <!-- Users Table -->
            <div>
                <div class="flex items-center justify-between">
                    <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        Listado de Usuarios
                    </h2>
                    <div class="flex">
                        <!-- Botón de búsqueda -->
                        <div class="flex items-center" x-data="{ isInputActive: false, search: '' }">
                            <input x-show="isInputActive" x-model="search" x-transition
                                class="form-input bg-transparent px-3 py-1.5 mr-2 w-48 transition-all duration-200 rounded-full border border-slate-300 focus:border-primary dark:border-navy-450 dark:focus:border-accent"
                                placeholder="Buscar usuario..." type="text"
                                @keyup.enter="window.location.href = '{{ route('usuarios') }}?search=' + search">
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
                                <span class="hidden sm:inline">Nuevo Usuario</span>
                            </button>

                            @include('contenido.usuario.create')
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
                                Nombre
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Username
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Email
                            </th>
                            <th
                                class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Rol
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
                        @forelse($usuarios as $usuario)
                            <tr
                                class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500 hover:bg-slate-100/75 dark:hover:bg-navy-600/75">
                                <td
                                    class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 lg:px-5">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar size-9">
                                            <img class="rounded-full"
                                                src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=random"
                                                alt="avatar">
                                        </div>
                                        <span>{{ $usuario->name }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <span
                                        class="font-mono text-sm text-slate-600 dark:text-navy-200">{{ $usuario->username }}</span>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <a href="mailto:{{ $usuario->email }}"
                                        class="text-primary hover:text-primary-focus dark:text-accent-light dark:hover:text-accent">{{ $usuario->email }}</a>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    @php
                                        $roleClasses = [
                                            'admin' =>
                                                'bg-primary/10 text-primary dark:bg-accent/15 dark:text-accent-light',
                                            'comercial' => 'bg-success/10 text-success dark:bg-success/15',
                                            'default' =>
                                                'bg-slate-100 text-slate-800 dark:bg-navy-500 dark:text-navy-100',
                                        ];
                                        $roleClass =
                                            $roleClasses[strtolower($usuario->role)] ?? $roleClasses['default'];
                                    @endphp
                                    <div class="badge {{ $roleClass }} rounded-full px-3 py-1 text-xs+ font-medium">
                                        {{ ucfirst($usuario->role) }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div x-data="estadoToggle({{ $usuario->id }}, {{ $usuario->activo ? 'true' : 'false' }})" class="flex items-center space-x-2 justify-center">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" :checked="estado" @change="cambiarEstado"
                                                class="form-switch h-5 w-10 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white" />
                                        </label>
                                        <span class="text-sm" :class="estado ? 'text-green-600' : 'text-red-600'"
                                            x-text="estado ? 'Activo' : 'Inactivo'"></span>
                                    </div>
                                </td>

                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <div class="flex space-x-2">
                                        <a href="#" @click.prevent="openEditModal({{ $usuario->id }})"
                                            class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                            title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zM19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                                title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-4.5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166M18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-slate-500 dark:text-navy-200">
                                    No se encontraron usuarios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($usuarios->hasPages())
                <div
                    class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
                    <div class="text-xs+">
                        Mostrando {{ $usuarios->firstItem() }} - {{ $usuarios->lastItem() }} de
                        {{ $usuarios->total() }} registros
                    </div>

                    <div>
                        {{ $usuarios->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            @endif
        </div>

        <script>
            function estadoToggle(userId, initialEstado) {
                return {
                    estado: initialEstado,
                    cambiarEstado() {
                        const nuevoEstado = this.estado ? 0 : 1;

                        fetch(`/usuarios/${userId}/estado`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    estado: nuevoEstado
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    this.estado = !this.estado;
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Estado actualizado',
                                        text: data.message,
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: data.message
                                    });
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error de red',
                                    text: 'No se pudo conectar al servidor.'
                                });
                            });
                    }
                };
            }
        </script>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('userModal', () => ({
                    showEditModal: false,
                    currentUserId: null,
                    formData: {
                        name: '',
                        username: '',
                        email: '',
                        role: 'admin'
                    },

                    init() {
                        // Esta función se ejecuta automáticamente al inicializar el componente
                    },

                    openEditModal(userId) {
                        this.currentUserId = userId;
                        console.log('Intentando abrir modal para usuario:', userId);

                        fetch(`/usuarios/${userId}/edit`)
                            .then(response => {
                                if (!response.ok) throw new Error('Usuario no encontrado');
                                return response.json();
                            })
                            .then(data => {
                                console.log('Datos recibidos:', data);
                                this.formData = {
                                    name: data.name,
                                    username: data.username,
                                    email: data.email,
                                    role: data.role
                                };
                                this.showEditModal = true;
                            })
                            .catch(error => {
                                console.error('Error al cargar usuario:', error);
                                alert('Error: ' + error.message);
                            });
                    },

                    submitForm() {
                        console.log('Enviando formulario para usuario:', this.currentUserId);
                        const formData = new FormData();
                        formData.append('_method', 'PUT');
                        formData.append('name', this.formData.name);
                        formData.append('username', this.formData.username);
                        formData.append('email', this.formData.email);
                        formData.append('role', this.formData.role);

                        fetch(`/usuarios/${this.currentUserId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-Token': '{{ csrf_token() }}',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: formData
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Usuario actualizado correctamente');
                                    location.reload();
                                } else {
                                    alert('Error: ' + (data.message || 'Error desconocido'));
                                }
                            })
                            .catch(error => {
                                console.error('Error al actualizar:', error);
                                alert('Error en la solicitud');
                            });
                    }
                }));
            });
        </script>

        @include('contenido.usuario.edit')
    </main>

@endsection
