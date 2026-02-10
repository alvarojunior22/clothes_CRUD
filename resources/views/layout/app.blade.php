<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Clothes_CRUD') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="flex h-screen overflow-hidden">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col">
        <div class="h-16 flex items-center justify-center border-b border-gray-200 font-bold text-lg">
            {{ config('app.name', 'Clothes_CRUD') }}
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-gray-100
                      {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                Inicio
            </a>

            <a href="{{ route('productos.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-gray-100
                      {{ request()->routeIs('productos.*') ? 'bg-gray-200 font-semibold' : '' }}">
                Productos
            </a>

            
        </nav>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 flex flex-col">

        <!-- TOPBAR -->
        <header class="h-16 bg-white border-b flex items-center justify-between px-6">
            <input type="text" placeholder="Buscar productos..."
                   class="w-full max-w-lg bg-gray-100 rounded-lg px-4 py-2 text-sm">

            <div class="flex items-center gap-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="flex items-center gap-2 focus:outline-none">
                            <img class="w-8 h-8 rounded-full object-cover"
                                 src="{{ Auth::user()->profile_photo_url }}"
                                 alt="{{ Auth::user()->name }}">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2">
                            <div class="text-sm font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="border-t"></div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            Perfil
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                Cerrar sesión
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>

    </div>
</div>

@livewireScripts
</body>
</html>
