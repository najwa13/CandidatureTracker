<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">
                {{ $candidature->entreprise }} — {{ $candidature->poste }}
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('candidatures.edit', $candidature) }}"
                   class="bg-gray-100 text-gray-700 px-4 py-2 rounded-md text-sm hover:bg-gray-200">
                    Modifier
                </a>
                <form action="{{ route('candidatures.destroy', $candidature) }}" method="POST"
                      onsubmit="return confirm('Archiver cette candidature ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-100 text-red-700 px-4 py-2 rounded-md text-sm hover:bg-red-200">
                        Archiver
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 space-y-6">

        {{-- Flash --}}
        @if (session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-md">{{ session('success') }}</div>
        @endif

        {{-- Informations candidature --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Informations</h3>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500">Statut</dt>
                    <dd class="mt-1"><x-badge-statut :statut="$candidature->statut" /></dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Priorité</dt>
                    <dd class="mt-1"><x-badge-priorite :priorite="$candidature->priorite" /></dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500">Date de candidature</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        {{ $candidature->date_candidature->format('d/m/Y') }}
                    </dd>
                </div>
                @if ($candidature->url_offre)
                <div>
                    <dt class="text-sm text-gray-500">Offre</dt>
                    <dd class="mt-1">
                        <a href="{{ $candidature->url_offre }}" target="_blank"
                           class="text-indigo-600 text-sm hover:underline">
                            Voir l'offre →
                        </a>
                    </dd>
                </div>
                @endif
            </dl>
            @if ($candidature->notes)
                <div class="mt-4 pt-4 border-t">
                    <dt class="text-sm text-gray-500 mb-1">Notes</dt>
                    <dd class="text-sm text-gray-700 whitespace-pre-line">{{ $candidature->notes }}</dd>
                </div>
            @endif
        </div>

        {{-- SECTION ENTRETIENS --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Entretiens</h3>

            @forelse ($candidature->entretiens as $entretien)
                <div class="border rounded-lg p-4 mb-3">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <span class="font-medium text-sm">
                                    {{ App\Models\Entretien::TYPES[$entretien->type] ?? $entretien->type }}
                                </span>
                                <x-badge-resultat :resultat="$entretien->resultat" />
                            </div>
                            <p class="text-sm text-gray-500">
                                {{ $entretien->date_heure->format('d/m/Y à H:i') }}
                            </p>
                            @if ($entretien->notes_preparation)
                                <p class="text-sm text-gray-600 mt-2">{{ $entretien->notes_preparation }}</p>
                            @endif
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('entretiens.edit', $entretien) }}"
                               class="text-sm text-indigo-600 hover:underline">Modifier</a>
                            <form action="{{ route('entretiens.destroy', $entretien) }}" method="POST"
                                  onsubmit="return confirm('Supprimer cet entretien ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-600 hover:underline">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400">Aucun entretien enregistré.</p>
            @endforelse

            {{-- Formulaire ajout entretien --}}
            <div class="mt-6 pt-6 border-t">
                <h4 class="font-medium text-gray-800 mb-4">Ajouter un entretien</h4>
                <form action="{{ route('entretiens.store', $candidature) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                            <select name="type" class="w-full rounded-md border-gray-300">
                                @foreach (App\Models\Entretien::TYPES as $val => $label)
                                    <option value="{{ $val }}" @selected(old('type') === $val)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure *</label>
                            <input type="datetime-local" name="date_heure"
                                   value="{{ old('date_heure') }}"
                                   class="w-full rounded-md border-gray-300">
                            @error('date_heure') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Résultat *</label>
                            <select name="resultat" class="w-full rounded-md border-gray-300">
                                @foreach (App\Models\Entretien::RESULTATS as $val => $label)
                                    <option value="{{ $val }}" @selected(old('resultat', 'pending') === $val)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Notes de préparation
                            </label>
                            <textarea name="notes_preparation" rows="2"
                                      class="w-full rounded-md border-gray-300 text-sm">{{ old('notes_preparation') }}</textarea>
                        </div>
                    </div>
                    <button type="submit"
                            class="bg-indigo-600 text-white px-5 py-2 rounded-md text-sm hover:bg-indigo-700">
                        Ajouter l'entretien
                    </button>
                </form>
            </div>
        </div>

        {{-- SECTION FICHIERS (BONUS) --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="font-semibold text-gray-900 mb-4">Documents joints</h3>

            @forelse ($candidature->fichiers as $fichier)
                <div class="flex items-center justify-between border rounded-lg px-4 py-3 mb-2">
                    <div class="flex items-center gap-3">
                        <span class="text-gray-400 text-xl">📄</span>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $fichier->nom_original }}</p>
                            <p class="text-xs text-gray-400">{{ $fichier->taille_lisible }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('fichiers.download', $fichier) }}"
                           class="text-sm text-indigo-600 hover:underline">
                            Télécharger
                        </a>
                        <form action="{{ route('fichiers.destroy', $fichier) }}" method="POST"
                              onsubmit="return confirm('Supprimer ce fichier ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-500 hover:underline">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-400 mb-4">Aucun document joint.</p>
            @endforelse

            {{-- Upload multi-fichiers --}}
            <form action="{{ route('fichiers.store', $candidature) }}" method="POST"
                  enctype="multipart/form-data" class="mt-4 pt-4 border-t">
                @csrf
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Ajouter des documents (PDF, Word — max 5 Mo chacun)
                </label>
                <input type="file" name="fichiers[]" multiple
                       accept=".pdf,.doc,.docx"
                       class="block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4 file:rounded-md
                              file:border-0 file:text-sm file:font-medium
                              file:bg-indigo-50 file:text-indigo-700
                              hover:file:bg-indigo-100">
                @error('fichiers.*')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('fichiers')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <button type="submit"
                        class="mt-3 bg-gray-800 text-white px-5 py-2 rounded-md text-sm hover:bg-gray-700">
                    Envoyer les documents
                </button>
            </form>
        </div>

    </div>
</x-app-layout>