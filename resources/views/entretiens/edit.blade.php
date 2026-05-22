<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Modifier l'entretien</h2>
    </x-slot>

    <div class="py-6 max-w-2xl mx-auto px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('entretiens.update', $entretien) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                        <select name="type" class="w-full rounded-md border-gray-300">
                            @foreach (App\Models\Entretien::TYPES as $val => $label)
                                <option value="{{ $val }}"
                                    @selected(old('type', $entretien->type) === $val)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('type') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date et heure *</label>
                        <input type="datetime-local" name="date_heure"
                               value="{{ old('date_heure', $entretien->date_heure->format('Y-m-d\TH:i')) }}"
                               class="w-full rounded-md border-gray-300">
                        @error('date_heure') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Résultat *</label>
                    <select name="resultat" class="w-full rounded-md border-gray-300">
                        @foreach (App\Models\Entretien::RESULTATS as $val => $label)
                            <option value="{{ $val }}"
                                @selected(old('resultat', $entretien->resultat) === $val)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Notes de préparation
                    </label>
                    <textarea name="notes_preparation" rows="4"
                              class="w-full rounded-md border-gray-300">{{ old('notes_preparation', $entretien->notes_preparation) }}</textarea>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                        Enregistrer
                    </button>
                    <a href="{{ route('candidatures.show', $entretien->candidature_id) }}"
                       class="bg-gray-100 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-200">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
