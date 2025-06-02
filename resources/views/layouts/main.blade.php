<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('titulo')</title>

    <link rel="icon" type="image/png" href="Admin/images/favicon.png">

    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('Admin/css/app.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">

    <link
        href="css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js']);

    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
            document.documentElement.classList.add("dark");
    </script>
</head>

<body x-data="" class="is-header-blur" x-bind="$store.global.documentBody">
    <!-- App preloader-->
    <div class="app-preloader fixed z-50 grid h-full w-full place-content-center bg-slate-50 dark:bg-navy-900">
        <div class="app-preloader-inner relative inline-block size-48"></div>
    </div>

    <!-- Page Wrapper -->
    <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak="">

        <!-- ======= Sidebar ======= -->
        @include('layouts.sidebar')
        <!-- End Sidebar-->

        <!-- App Header Wrapper-->
        @include('layouts.header')

        <!-- Mobile Searchbar -->
        @include('layouts.mobile')

        <!-- Right Sidebar -->
        {{-- @include('layouts.rightsidebar') --}}

        <!-- Main Content Wrapper -->
        @yield('contenido')
    </div>
    <!--
        This is a place for Alpine.js Teleport feature
        @see https://alpinejs.dev/directives/teleport
      -->
    <div id="x-teleport-target"></div>

    <!-- Javascript Assets -->
    <script src="{{ asset('Admin/js/app.js') }}" defer=""></script>

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Función global para mostrar alertas
        window.showAlert = function(type, title, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            const styles = {
                error: {
                    icon: 'error',
                    title: title,
                    background: '#fee2e2',
                    iconColor: '#dc2626',
                    color: '#991b1b',
                    customClass: {
                        popup: 'animated swing'
                    }
                },
                success: {
                    icon: 'success',
                    title: title,
                    background: '#dcfce7',
                    iconColor: '#16a34a',
                    color: '#166534',
                    customClass: {
                        popup: 'animated tada'
                    }
                },
                warning: {
                    icon: 'warning',
                    title: title,
                    background: '#fef3c7',
                    iconColor: '#f59e0b',
                    color: '#92400e',
                    customClass: {
                        popup: 'animated pulse'
                    }
                },
                info: {
                    icon: 'info',
                    title: title,
                    background: '#dbeafe',
                    iconColor: '#3b82f6',
                    color: '#1e40af',
                    customClass: {
                        popup: 'animated fadeIn'
                    }
                }
            };

            Toast.fire({
                ...styles[type],
                html: message
            });
        };

        // Manejar mensajes flash de Laravel
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                window.showAlert('success', 'Éxito', @json(Session::get('success')));
            @endif

            @if (Session::has('error'))
                window.showAlert('error', 'Error', @json(Session::get('error')));
            @endif

            @if (Session::has('warning'))
                window.showAlert('warning', 'Advertencia', @json(Session::get('warning')));
            @endif

            @if (Session::has('info'))
                window.showAlert('info', 'Información', @json(Session::get('info')));
            @endif
        });
    </script>

    @stack('script')
</body>

</html>
