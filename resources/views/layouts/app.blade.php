<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CandidatureTracker') }} — @yield('title', 'Dashboard')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased h-full" x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="
        $watch('darkMode', val => { localStorage.setItem('darkMode', val); document.documentElement.classList.toggle('dark', val); });
        if (darkMode) document.documentElement.classList.add('dark');
      "
      :class="{ 'dark': darkMode }">
    <div class="min-h-screen flex bg-[#f9fafb] dark:bg-[#0f0f12]">

        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false">
        </div>

        {{-- Sidebar --}}
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-[#16161a] border-r border-gray-100 dark:border-[#2a2a32] flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:z-auto">

            {{-- Logo --}}
            <div class="flex items-center justify-between h-16 px-5 border-b border-gray-100 dark:border-[#2a2a32]">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-primary-500 flex items-center justify-center shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-base font-bold text-gray-900 dark:text-white tracking-tight">CandidatureTracker</span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden p-1.5 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#1c1c22] transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}"
                   class="nav-item group relative {{ request()->routeIs('dashboard') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                    @if(request()->routeIs('dashboard'))
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-5 rounded-full bg-primary-500"></span>
                    @endif
                </a>

                <a href="{{ route('candidatures.index') }}"
                   class="nav-item group relative {{ request()->routeIs('candidatures.*') && !request()->routeIs('archives.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    <span>Mes candidatures</span>
                    @if(request()->routeIs('candidatures.*') && !request()->routeIs('archives.*'))
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-5 rounded-full bg-primary-500"></span>
                    @endif
                </a>

                <a href="{{ route('archives.index') }}"
                   class="nav-item group relative {{ request()->routeIs('archives.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                    <span>Archives</span>
                    @if(request()->routeIs('archives.*'))
                        <span class="absolute left-0 top-1/2 -translate-y-1/2 w-0.5 h-5 rounded-full bg-primary-500"></span>
                    @endif
                </a>

                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-[#2a2a32]">
                    <a href="{{ route('profile.edit') }}"
                       class="nav-item group relative {{ request()->routeIs('profile.*') ? 'nav-item-active' : 'nav-item-inactive' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profil</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full nav-item nav-item-inactive">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </nav>

            {{-- User at bottom --}}
            <div class="flex items-center gap-3 px-5 py-4 border-t border-gray-100 dark:border-[#2a2a32]">
                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-500/20 text-primary-600 dark:text-primary-400 flex items-center justify-center text-sm font-semibold">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        {{-- Main content area --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- Topbar --}}
            <header class="h-16 bg-white/80 dark:bg-[#16161a]/80 backdrop-blur-xl border-b border-gray-100 dark:border-[#2a2a32] flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 rounded-xl text-gray-500 hover:bg-gray-100 dark:hover:bg-[#1c1c22] hover:text-gray-700 dark:hover:text-gray-300 transition-colors" aria-label="Ouvrir le menu">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center gap-2">
                    {{-- Dark mode toggle --}}
                    <button @click="darkMode = !darkMode"
                            class="p-2 rounded-xl text-gray-500 hover:bg-gray-100 dark:hover:bg-[#1c1c22] hover:text-gray-700 dark:hover:text-gray-300 transition-colors"
                            aria-label="Changer le thème">
                        <template x-if="darkMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </template>
                        <template x-if="!darkMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                        </template>
                    </button>

                    {{-- User avatar --}}
                    <div class="flex items-center gap-2 ml-2 pl-2 border-l border-gray-100 dark:border-[#2a2a32]">
                        <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-500/20 text-primary-600 dark:text-primary-400 flex items-center justify-center text-sm font-semibold">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
