<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CandidatureTracker') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen flex">
    {{-- Left: illustration side (desktop) --}}
    <div class="hidden lg:flex flex-1 bg-gradient-to-br from-primary-500 via-primary-600 to-primary-800 relative overflow-hidden items-center justify-center">
        <div class="absolute inset-0 opacity-30" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMiIvPjwvZz48L2c+PC9zdmc+')"></div>
        <div class="absolute top-20 -left-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 -right-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="relative z-10 text-center px-12 max-w-md">
            <h2 class="text-3xl font-bold text-white mb-4">
                @yield('auth-title', 'Centralise tes candidatures')
            </h2>
            <p class="text-white/80 text-lg leading-relaxed">
                @yield('auth-description', 'Suis chaque étape de ta recherche d\'emploi, organise tes entretiens et ne rate jamais une relance.')
            </p>
        </div>
    </div>

    {{-- Right: form --}}
    <div class="flex-1 flex items-center justify-center p-6 bg-[#f9fafb]">
        <div class="w-full max-w-sm animate-slide-up">
            <div class="text-center mb-8">
                <div class="w-12 h-12 rounded-2xl bg-primary-500 flex items-center justify-center mx-auto mb-4 shadow-lg shadow-primary-500/25">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">@yield('auth-heading', 'CandidatureTracker')</h1>
                <p class="text-sm text-gray-500 mt-1">@yield('auth-subheading', '')</p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>
