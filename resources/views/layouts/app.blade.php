<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="grid h-screen grid-cols-[auto,1fr] grid-rows-[auto,1fr] bg-gray-100 font-sans antialiased">
    {{-- menu --}}
    <div x-data="{ open: false }" class="col-span-2 col-start-1 row-span-1 row-start-1 lg:col-span-1 lg:col-start-1 lg:row-span-2 lg:row-start-1">
        {{-- topbar --}}
        <div class="flex h-16 w-full items-center justify-between bg-white px-4 lg:hidden">
            <div class="flex gap-2">
                <x-icon.ticket-solid class="w-6 text-primary-500" />
                <p class="text-lg font-bold">TickTick</p>
            </div>
            <button x-on:click="open = !open">
                <span :class="{ 'hidden': open }">
                    <x-icon.menu class="h-6 w-6 text-gray-900" />
                </span>
                <span :class="{ 'hidden': !open }">
                    <x-icon.menu-close class="h-6 w-6 text-gray-900" />
                </span>
            </button>
        </div>
        {{-- navigation --}}
        <nav :class="{ 'left-0': open }" class="group fixed top-0 -left-64 flex h-screen w-64 transform flex-col items-start justify-between overflow-hidden border-r border-gray-100 bg-white transition-all duration-300 lg:relative lg:!left-0 lg:w-20 hover:lg:!w-64">
            {{-- top menu items --}}
            <div>
                <div class="relative mb-4 flex w-64 gap-2 bg-white px-6 py-7">
                    <x-icon.ticket-solid class="w-7 text-primary-500" />
                    <div class="transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">
                        <p class="text-xl font-bold">TickTick</p>
                        <p class="-mt-2 text-sm text-gray-500 hover:text-primary-500 hover:underline"><a target="_blank" href="https://github.com/MauricioRobertoDev">Por Mauricio Roberto</a></p>
                    </div>
                </div>
                <a href="#" class="relative flex w-64 gap-4 bg-white py-5 px-7 text-gray-500 hover:text-primary-500">
                    <x-icon.grid class="w-6" />
                    <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Dashboard</p>
                </a>

                @unlessrole('does not have this role')
                    <a href="{{ route('myticket.index') }}" class="{{ request()->routeIs('myticket.index') ? '!text-primary-500' : '' }} relative flex w-64 gap-4 bg-white px-7 py-5 text-gray-500 hover:text-primary-500">
                        <x-icon.ticket class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Meus tickets</p>
                    </a>
                @endunlessrole

                @role('admin')
                    <a href="{{ route('ticket.index') }}" class="{{ request()->routeIs('ticket.index') ? '!text-primary-500' : '' }} relative flex w-64 gap-4 bg-white px-7 py-5 text-gray-500 hover:text-primary-500">
                        <x-icon.ticket class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Tickets</p>
                    </a>
                    <a href="{{ route('user.index') }}" class="{{ request()->routeIs('user.index') ? '!text-primary-500' : '' }} relative flex w-64 gap-4 bg-white px-7 py-5 text-gray-500 hover:text-primary-500">
                        <x-icon.users class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Usuários</p>
                    </a>
                    <a href="#" class="relative flex w-64 gap-4 bg-white py-5 px-7 text-gray-500 hover:text-primary-500">
                        <x-icon.log class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Histórico</p>
                    </a>
                    <a href="{{ route('department.index') }}" class="{{ request()->routeIs('department.index') ? '!text-primary-500' : '' }} relative flex w-64 gap-4 bg-white px-7 py-5 text-gray-500 hover:text-primary-500">
                        <x-icon.department class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Departamentos</p>
                    </a>
                    <a href="{{ route('tag.index') }}" class="{{ request()->routeIs('tag.index') ? '!text-primary-500' : '' }} relative flex w-64 gap-4 bg-white px-7 py-5 text-gray-500 hover:text-primary-500">
                        <x-icon.tag class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Tags</p>
                    </a>
                @endrole
            </div>
            {{-- bottom menu items --}}
            <div>
                {{-- theme --}}
                <a href="{{ route('profile.edit') }}" class="relative flex h-20 w-64 gap-5 bg-white px-5 py-5 text-gray-500 hover:bg-primary-50 hover:text-primary-500">

                    @if (auth()->user()->avatar)
                        <img src="{{ asset(auth()->user()->avatar) }}" class="h-10 w-10 flex-grow-0 rounded-md" />
                    @else
                        <img src="{{ asset('avatars/default.png') }}" class="h-10 w-10 flex-grow-0 rounded-md" />
                    @endif

                    <div class="flex-grow truncate whitespace-nowrap text-start">
                        <p class="truncate text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs font-medium text-gray-500">{{ auth()->user()->email }}</p>
                    </div>
                </a>
                {{-- logout --}}

                <form action="{{ route('logout') }}" method='post'>
                    @csrf
                    <button type="submit" class="relative flex w-64 gap-2 bg-white py-5 px-7 text-gray-500 hover:text-red-500">
                        <x-icon.logout class="w-6" />
                        <p class="font-semibold transition-all duration-300 lg:opacity-0 group-hover:lg:opacity-100">Sair</p>
                    </button>
                </form>
            </div>
        </nav>
    </div>
    {{-- content --}}
    <main class="col-span-2 col-start-1 row-span-1 row-start-2 h-full overflow-y-auto lg:col-span-1 lg:col-start-2 lg:row-span-2 lg:row-start-1">
        {{ $slot }}
    </main>
    @livewireScripts
</body>

</html>
