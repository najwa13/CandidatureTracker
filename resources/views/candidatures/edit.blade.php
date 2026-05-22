<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Modifier la candidature</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('candidatures.update', $candidature) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Mêmes champs que create avec old('champ', $candidature->champ) --}}

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Entreprise *</label>
                    <input type="text" name="entreprise"
                           value="{{ old('entreprise', $candidature->entreprise) }}"
                           class="w-full rounded-md border-gray-300 @error('entreprise') border-red-500 @enderror">
                    @error('entreprise') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poste visé *</label>
                    <input type="text" name="poste"
                           value="{{ old('poste', $candidature->poste) }}"
                           class="w-full rounded-md border-gray-300 @error('poste') border-red-500 @enderror">
                    @error('poste') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL de l'offre</label>
                    <input type="url" name="url_offre"
                           value="{{ old('url_offre', $candidature->url_offre) }}"
                           class="w-full rounded-md border-gray-300">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
                        <select name="statut" class="w-full rounded-md border-gray-300">
                            @foreach (App\Models\Candidature::STATUTS as $val => $label)
                                <option value="{{ $val }}"
                                    @selected(old('statut', $candidature->statut) === $val)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Priorité *</label>
                        <select name="priorite" class="w-full rounded-md border-gray-300">
                            @foreach (App\Models\Candidature::PRIORITES as $val => $label)
                                <option value="{{ $val }}"
                                    @selected(old('priorite', $candidature->priorite) === $val)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de candidature *</label>
                    <input type="date" name="date_candidature"
                           value="{{ old('date_candidature', $candidature->date_candidature->format('Y-m-d')) }}"
                           class="w-full rounded-md border-gray-300">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="4"
                              class="w-full rounded-md border-gray-300">{{ old('notes', $candidature->notes) }}</textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('candidatures.show', $candidature) }}"
                       class="bg-gray-100 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-200">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>