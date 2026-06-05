<x-app-layout>
    @section('title', $candidature->entreprise . ' — ' . $candidature->poste)

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">
        @if (session('success'))
            <div class="flex items-center gap-3 p-4 bg-emerald-50 dark:bg-emerald-500/10 text-emerald-700 dark:text-emerald-300 rounded-2xl border border-emerald-200 dark:border-emerald-500/20 text-sm">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-primary-50 dark:bg-primary-500/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-xl font-bold text-primary-600 dark:text-primary-400">{{ substr($candidature->entreprise, 0, 2) }}</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $candidature->poste }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $candidature->entreprise }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('candidatures.edit', $candidature) }}" class="btn-secondary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Modifier
                </a>
                <form action="{{ route('candidatures.destroy', $candidature) }}" method="POST"
                      onsubmit="return confirm('Archiver cette candidature ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-amber-700 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10 rounded-xl hover:bg-amber-100 dark:hover:bg-amber-500/20 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8"/>
                        </svg>
                        Archiver
                    </button>
                </form>
            </div>
        </div>

        {{-- Info card --}}
        <div class="card-premium p-6 sm:p-8 dark:bg-[#16161a] dark:border-[#2a2a32]">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Statut</p>
                    <x-badge-statut :statut="$candidature->statut" />
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Priorité</p>
                    <x-badge-priorite :priorite="$candidature->priorite" />
                </div>
                <div>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Date de candidature</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $candidature->date_candidature->format('d/m/Y') }}</p>
                </div>
                @if ($candidature->url_offre)
                    <div>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Offre</p>
                        <a href="{{ $candidature->url_offre }}" target="_blank"
                           class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                            Voir l'offre
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
            @if ($candidature->notes)
                <div class="mt-6 pt-6 border-t border-gray-100 dark:border-[#2a2a32]">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Notes</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">{{ $candidature->notes }}</p>
                </div>
            @endif
        </div>

        {{-- Entretiens --}}
        <div class="card-premium p-6 sm:p-8 dark:bg-[#16161a] dark:border-[#2a2a32]">
            <div class="flex items-center gap-2 mb-6">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Entretiens</h2>
            </div>

            @if ($candidature->entretiens->count() > 0)
                <div class="space-y-4">
                    @foreach ($candidature->entretiens as $entretien)
                        <div class="bg-gray-50 dark:bg-white/[0.03] rounded-xl p-4 hover:bg-gray-100/50 dark:hover:bg-white/[0.06] transition-colors">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap mb-1">
                                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ App\Models\Entretien::TYPES[$entretien->type] ?? $entretien->type }}
                                        </span>
                                        <x-badge-resultat :resultat="$entretien->resultat" />
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $entretien->date_heure->format('d/m/Y à H:i') }}
                                    </p>
                                    @if ($entretien->notes_preparation)
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ $entretien->notes_preparation }}</p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1 flex-shrink-0">
                                    <a href="{{ route('entretiens.edit', $entretien) }}"
                                       class="p-2 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-white dark:hover:bg-[#1c1c22] transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('entretiens.destroy', $entretien) }}" method="POST"
                                          onsubmit="return confirm('Supprimer cet entretien ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-white dark:hover:bg-[#1c1c22] transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-200 dark:text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Aucun entretien enregistré.</p>
                </div>
            @endif

            {{-- Add interview --}}
            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-[#2a2a32]">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Ajouter un entretien</h3>
                <form action="{{ route('candidatures.entretiens.store', $candidature) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Type <span class="text-red-400">*</span></label>
                            <select name="type" class="input-field">
                                @foreach (App\Models\Entretien::TYPES as $val => $label)
                                    <option value="{{ $val }}" @selected(old('type') === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('type') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Date et heure <span class="text-red-400">*</span></label>
                            <input type="datetime-local" name="date_heure" value="{{ old('date_heure') }}"
                                   class="input-field">
                            @error('date_heure') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Résultat <span class="text-red-400">*</span></label>
                            <select name="resultat" class="input-field">
                                @foreach (App\Models\Entretien::RESULTATS as $val => $label)
                                    <option value="{{ $val }}" @selected(old('resultat', 'pending') === $val)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Notes de préparation</label>
                            <textarea name="notes_preparation" rows="2" class="input-field">{{ old('notes_preparation') }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Ajouter l'entretien
                    </button>
                </form>
            </div>
        </div>

        {{-- Documents --}}
        <div class="card-premium p-6 sm:p-8 dark:bg-[#16161a] dark:border-[#2a2a32]">
            <div class="flex items-center gap-2 mb-6">
                <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Documents joints</h2>
            </div>

            @if ($candidature->fichiers->count() > 0)
                <div class="space-y-2 mb-6">
                    @foreach ($candidature->fichiers as $fichier)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50 dark:bg-white/[0.03] hover:bg-gray-100/50 dark:hover:bg-white/[0.06] transition-colors group">
                            <div class="flex items-center gap-3 min-w-0">
                                <div class="w-10 h-10 rounded-xl bg-white dark:bg-[#1c1c22] flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $fichier->nom_original }}</p>
                                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $fichier->taille_listible }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 flex-shrink-0 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('fichiers.download', $fichier) }}"
                                   class="p-2 rounded-lg text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-white dark:hover:bg-[#1c1c22] transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('fichiers.destroy', $fichier) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce fichier ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-2 rounded-lg text-gray-400 hover:text-red-500 hover:bg-white dark:hover:bg-[#1c1c22] transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 mb-4">
                    <svg class="w-12 h-12 text-gray-200 dark:text-gray-700 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm text-gray-400 dark:text-gray-500">Aucun document joint.</p>
                </div>
            @endif

            {{-- Upload --}}
            <form action="{{ route('fichiers.store', $candidature) }}" method="POST"
                  enctype="multipart/form-data" class="border-t border-gray-100 dark:border-[#2a2a32] pt-6">
                @csrf
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Ajouter des documents
                </label>
                <div class="flex items-center gap-3">
                    <label class="flex-1 flex items-center gap-3 px-4 py-3 rounded-xl border-2 border-dashed border-gray-200 dark:border-[#2a2a32] bg-gray-50 dark:bg-white/[0.03] hover:border-primary-300 dark:hover:border-primary-500/30 hover:bg-primary-50/30 dark:hover:bg-primary-500/5 transition-colors cursor-pointer relative" id="drop-zone">
                        <svg class="w-6 h-6 text-gray-400 dark:text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400" id="drop-text">PDF, Word — max 5 Mo</span>
                        <input type="file" name="fichiers[]" id="file-input" multiple
                               accept=".pdf,.doc,.docx"
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </label>
                    <button type="submit" id="submit-btn"
                            class="btn-primary">
                        Envoyer
                    </button>
                </div>

                <div id="file-preview" class="hidden mt-3 space-y-2"></div>

                @if ($errors->has('fichiers') || $errors->has('fichiers.*'))
                    <p class="mt-2 text-sm text-red-500 flex items-center gap-1.5">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $errors->first('fichiers') ?? $errors->first('fichiers.*') }}
                    </p>
                @endif
            </form>

            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var input = document.getElementById('file-input');
                    var preview = document.getElementById('file-preview');
                    var dropText = document.getElementById('drop-text');
                    var defaultText = dropText.textContent;
                    var selectedFiles = [];

                    function formatSize(bytes) {
                        if (bytes < 1024) return bytes + ' o';
                        if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' Ko';
                        return (bytes / 1048576).toFixed(1) + ' Mo';
                    }

                    function rebuildPreview() {
                        preview.innerHTML = '';
                        if (selectedFiles.length === 0) {
                            preview.classList.add('hidden');
                            dropText.textContent = defaultText;
                            return;
                        }
                        preview.classList.remove('hidden');
                        dropText.textContent = selectedFiles.length + ' fichier(s) sélectionné(s)';

                        selectedFiles.forEach(function (file, index) {
                            var row = document.createElement('div');
                            row.className = 'flex items-center justify-between px-3 py-2.5 rounded-xl bg-gray-50 dark:bg-white/[0.03] border border-gray-100 dark:border-[#2a2a32] text-sm group';

                            var info = document.createElement('div');
                            info.className = 'flex items-center gap-2.5 min-w-0';
                            info.innerHTML =
                                '<svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>' +
                                '<span class="text-gray-700 dark:text-gray-300 truncate">' + file.name.replace(/</g,'&lt;') + '</span>' +
                                '<span class="text-xs text-gray-400 dark:text-gray-500 shrink-0">' + formatSize(file.size) + '</span>';

                            var btn = document.createElement('button');
                            btn.type = 'button';
                            btn.className = 'p-1 rounded-lg text-gray-400 hover:text-red-500 hover:bg-white dark:hover:bg-[#1c1c22] transition-colors opacity-0 group-hover:opacity-100';
                            btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';

                            btn.addEventListener('click', function () {
                                selectedFiles.splice(index, 1);
                                syncInput();
                                rebuildPreview();
                            });

                            row.appendChild(info);
                            row.appendChild(btn);
                            preview.appendChild(row);
                        });
                    }

                    function syncInput() {
                        var dt = new DataTransfer();
                        selectedFiles.forEach(function (f) { dt.items.add(f); });
                        input.files = dt.files;
                    }

                    input.addEventListener('change', function () {
                        var newFiles = Array.from(this.files || []);
                        var existingNames = {};
                        selectedFiles.forEach(function (f) { existingNames[f.name] = true; });
                        newFiles.forEach(function (f) {
                            if (!existingNames[f.name]) {
                                selectedFiles.push(f);
                                existingNames[f.name] = true;
                            }
                        });
                        syncInput();
                        rebuildPreview();
                    });
                });
            </script>
            @endpush
        </div>
    </div>
</x-app-layout>
