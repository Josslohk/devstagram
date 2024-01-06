<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Devstagram - @yield('titulo')</title>
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        <style>
            html, :host {
                font-family: sans-serif; !important
            }
        </style>
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-3xl font-black">
                    DevStagram
                </h1>
                <nav class="flex gap-2 items-center">
                    <a  class="font-bold uppercase text-gray-600 text-sm" href="#">Login</a>
                    <a  class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}">Crear Cuenta</a>
                </nav>
            </div>
        </header>
        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10">
                @yield('titulo')
            </h2>
            @yield('contenido')
        </main>
        <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
            {{-- DevStagram - Todos los derechos Reservados @php echo date('Y') @endphp --}}
            {{-- Helpers --}}
            {{-- DevStagram - Todos los derechos Reservados {{ now() }} --}}
            DevStagram - Todos los derechos Reservados {{ now()->year }}
            {{-- DevStagram - Todos los derechos Reservados {{ now()->month }} --}}
        </footer>
        {{-- Imprimir con sintaxis php --}}
        {{-- <?php echo date('Y'); ?> --}}
        {{-- Imprimir sin sintaxis php --}}
        {{-- {{1+1}} --}}
    </body>