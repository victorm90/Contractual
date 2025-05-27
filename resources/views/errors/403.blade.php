@extends('layouts.main')

@section('contenido')
    <main class="main-content w-full pb-8 bg-gray-100 flex flex-col items-center justify-center p-4 animate-fade-in">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8 relative overflow-hidden">
            <!-- Efecto de ola decorativa -->
            <div class="absolute -top-20 -right-20 w-40 h-40 bg-indigo-500 rounded-full opacity-20"></div>
            <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-purple-500 rounded-full opacity-20"></div>

            <div class="text-center">
                <div class="text-9xl text-indigo-600 font-bold mb-4 animate-bounce">403</div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Acceso Denegado</h1>
                <p class="text-gray-600 mb-6">{{ $customMessage }}</p>

                <!-- Animación SVG -->
                <div class="mb-6">
                    <svg class="w-24 h-24 mx-auto text-red-500 animate-pulse" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <a href="{{ url()->previous() }}"
                    class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                    ← Volver atrás
                </a>
            </div>
        </div>
    </main>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-bounce {
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }
    </style>
@endsection
