<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CandidatureTracker — Suivez vos candidatures simplement</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    {{-- Nav --}}
    <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-gray-900">CandidatureTracker</span>
                </a>
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-sm">S'inscrire</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <section class="relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-indigo-50/50 pointer-events-none"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[600px] bg-indigo-100/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 lg:py-32">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium mb-6 border border-indigo-100">
                    <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
                    Application de suivi de candidatures
                </div>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight leading-tight">
                    Suivez vos candidatures<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-indigo-500">comme un pro</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-gray-500 leading-relaxed max-w-2xl mx-auto">
                    Organisez, suivez et gérez toutes vos candidatures en un seul endroit. 
                    Ne ratez plus jamais une opportunité professionnelle.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-8 py-3.5 text-base font-semibold text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-colors shadow-lg shadow-indigo-200 hover:shadow-xl hover:shadow-indigo-200 w-full sm:w-auto text-center">
                        Commencer gratuitement
                    </a>
                    <a href="#features" class="px-8 py-3.5 text-base font-semibold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors w-full sm:w-auto text-center">
                        En savoir plus
                    </a>
                </div>
                <div class="mt-8 flex items-center justify-center gap-8 text-sm text-gray-400">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Gratuit
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Sans limite
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Sécurisé
                    </span>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats --}}
    <section class="border-y border-gray-100 bg-gray-50/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">100%</p>
                    <p class="text-sm text-gray-500 mt-1">Gratuit</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">∞</p>
                    <p class="text-sm text-gray-500 mt-1">Candidatures illimitées</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">5 min</p>
                    <p class="text-sm text-gray-500 mt-1">Prise en main</p>
                </div>
                <div class="text-center">
                    <p class="text-3xl font-bold text-gray-900">100%</p>
                    <p class="text-sm text-gray-500 mt-1">Sécurisé</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section id="features" class="py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Tout ce dont vous avez besoin</h2>
                <p class="mt-4 text-lg text-gray-500">Une interface moderne et intuitive pour gérer votre recherche d'emploi.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-lg hover:border-indigo-100 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Suivi complet</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Ajoutez vos candidatures, suivez leur statut et ne perdez jamais le fil de vos recherches.</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-lg hover:border-indigo-100 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Calendrier d'entretiens</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Planifiez et gérez vos entretiens avec une vue timeline claire et des rappels.</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-lg hover:border-indigo-100 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Statistiques claires</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Visualisez votre progression avec des tableaux de bord et des indicateurs pertinents.</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-lg hover:border-indigo-100 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Documents attachés</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Joignez vos CV, lettres de motivation et tous les documents importants à chaque candidature.</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-lg hover:border-indigo-100 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Filtres avancés</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Filtrez par statut, priorité ou date pour retrouver rapidement une candidature.</p>
                </div>
                <div class="bg-white rounded-2xl border border-gray-100 p-8 hover:shadow-lg hover:border-indigo-100 transition-all duration-200">
                    <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Données sécurisées</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Vos données sont protégées et accessibles uniquement par vous, en toute confidentialité.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-gradient-to-r from-indigo-600 to-indigo-700">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white">Prêt à organiser vos candidatures ?</h2>
            <p class="mt-4 text-lg text-indigo-200">Rejoignez-nous gratuitement et reprenez le contrôle de votre recherche d'emploi.</p>
            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-3.5 text-base font-semibold text-indigo-700 bg-white rounded-xl hover:bg-indigo-50 transition-colors shadow-lg w-full sm:w-auto text-center">
                    Créer un compte gratuit
                </a>
                <a href="{{ route('login') }}" class="px-8 py-3.5 text-base font-semibold text-white border border-white/30 rounded-xl hover:bg-white/10 transition-colors w-full sm:w-auto text-center">
                    Se connecter
                </a>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-50 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-900">CandidatureTracker</span>
                </div>
                <div class="flex items-center gap-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-gray-700 transition-colors">Conditions d'utilisation</a>
                    <a href="#" class="hover:text-gray-700 transition-colors">Confidentialité</a>
                    <a href="#" class="hover:text-gray-700 transition-colors">Contact</a>
                </div>
                <p class="text-sm text-gray-400">&copy; {{ date('Y') }} Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
