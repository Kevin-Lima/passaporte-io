<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Passaporte.io') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-base-content bg-base-200">
        
        <div class="min-h-screen flex flex-col">
            
            @include('layouts.navigation')

            @if (isset($header))
                <header class="bg-base-100 shadow-sm border-b border-base-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-grow w-full max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>

            <footer class="footer footer-center p-10 bg-base-100 text-base-content rounded mt-auto border-t border-base-200">
                <nav class="grid grid-flow-col gap-4">
                    <a href="#" class="link link-hover font-medium">Sobre nós</a>
                    <a href="#" class="link link-hover font-medium">Contato</a>
                    <a href="#" class="link link-hover font-medium">Termos de Uso</a>
                    <a href="#" class="link link-hover font-medium">Política de Privacidade</a>
                </nav> 
                <aside>
                    <p class="font-bold text-lg mb-2">
                        Passaporte.io <br/>Garantindo seu lugar nos melhores eventos.
                    </p> 
                    <p>Copyright © {{ date('Y') }} - Todos os direitos reservados</p>
                </aside>
            </footer>
        </div>

        @if (session('success'))
            <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                <div class="alert alert-success text-white shadow-lg">
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="toast toast-top toast-end z-50" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)">
                <div class="alert alert-error text-white shadow-lg">
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
    </body>
</html>