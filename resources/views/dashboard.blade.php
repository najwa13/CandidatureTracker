<x-app-layout>
    @section('title', 'Dashboard')

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if (session('success'))
            <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 rounded-2xl border border-emerald-200 dark:border-emerald-500/20 text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Vue d'ensemble de vos candidatures</p>
        </div>

        {{-- Stats cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card-premium p-5 dark:bg-[#16161a] dark:border-[#2a2a32]">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Total</span>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Candidatures</p>
            </div>

            <div class="card-premium p-5 dark:bg-[#16161a] dark:border-[#2a2a32]">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Actives</span>
                </div>
                <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['en_cours'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">En cours</p>
            </div>

            <div class="card-premium p-5 dark:bg-[#16161a] dark:border-[#2a2a32]">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Succès</span>
                </div>
                <p class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $stats['offres'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Offres reçues</p>
            </div>

            <div class="card-premium p-5 dark:bg-[#16161a] dark:border-[#2a2a32]">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-500/10 flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium text-gray-400 dark:text-gray-500">Archivées</span>
                </div>
                <p class="text-3xl font-bold text-amber-600 dark:text-amber-400">{{ $stats['archives'] }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Archivées</p>
            </div>
        </div>

        {{-- Grid: recentes + entretiens --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Candidatures recentes --}}
            <div class="lg:col-span-2 card-premium overflow-hidden dark:bg-[#16161a] dark:border-[#2a2a32]">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-[#2a2a32] flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <h2 class="font-semibold text-gray-900 dark:text-white">Candidatures récentes</h2>
                    </div>
                    <a href="{{ route('candidatures.index') }}" class="text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">Voir tout</a>
                </div>
                <div class="divide-y divide-gray-50 dark:divide-[#2a2a32]">
                    @forelse ($recentes as $candidature)
                        <a href="{{ route('candidatures.show', $candidature) }}"
                           class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 dark:hover:bg-white/[0.03] transition-colors group">
                            <div class="w-10 h-10 rounded-xl bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center flex-shrink-0">
                                <span class="text-sm font-bold text-primary-600 dark:text-primary-400">{{ substr($candidature->entreprise, 0, 2) }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                                    {{ $candidature->poste }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $candidature->entreprise }}</p>
                            </div>
                            <x-badge-statut :statut="$candidature->statut" />
                        </a>
                    @empty
                        <div class="px-5 py-12 text-center">
                            <svg class="w-12 h-12 text-gray-200 dark:text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Aucune candidature pour le moment.</p>
                            <a href="{{ route('candidatures.create') }}" class="text-sm text-primary-600 dark:text-primary-400 hover:underline mt-1 inline-block font-medium">Ajouter ma première candidature</a>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Prochains entretiens --}}
            <div class="card-premium overflow-hidden dark:bg-[#16161a] dark:border-[#2a2a32]">
                <div class="px-5 py-4 border-b border-gray-100 dark:border-[#2a2a32] flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="font-semibold text-gray-900 dark:text-white">Prochains entretiens</h2>
                </div>
                <div class="divide-y divide-gray-50 dark:divide-[#2a2a32]">
                    @forelse ($prochainsEntretiens as $entretien)
                        <div class="px-5 py-4">
                            <div class="flex items-start gap-3">
                                <div class="w-2 h-2 rounded-full bg-primary-500 mt-2 flex-shrink-0"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $entretien->candidature->poste }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $entretien->candidature->entreprise }}</p>
                                    <div class="flex items-center gap-2 mt-2">
                                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $entretien->date_heure->format('d/m/Y H:i') }}</span>
                                        <span class="ml-1 text-xs font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-500/10 px-2 py-0.5 rounded-full">
                                            {{ App\Models\Entretien::TYPES[$entretien->type] ?? $entretien->type }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-5 py-12 text-center">
                            <svg class="w-12 h-12 text-gray-200 dark:text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Aucun entretien à venir.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
