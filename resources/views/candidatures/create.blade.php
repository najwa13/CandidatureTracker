<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Nouvelle candidature</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="{{ route('candidatures.store') }}" method="POST">
                @csrf

                {{-- Entreprise --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Entreprise <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="entreprise" value="{{ old('entreprise') }}"
                           class="w-full rounded-md border-gray-300 @error('entreprise') border-red-500 @enderror">
                    @error('entreprise')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Poste --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Poste visé <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="poste" value="{{ old('poste') }}"
                           class="w-full rounded-md border-gray-300 @error('poste') border-red-500 @enderror">
                    @error('poste')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- URL --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        URL de l'offre (optionnel)
                    </label>
                    <input type="url" name="url_offre" value="{{ old('url_offre') }}"
                           placeholder="https://..."
                           class="w-full rounded-md border-gray-300 @error('url_offre') border-red-500 @enderror">
                    @error('url_offre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Statut + Priorité --}}
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Statut <span class="text-red-500">*</span>
                        </label>
                        <select name="statut"
                                class="w-full rounded-md border-gray-300 @error('statut') border-red-500 @enderror">
                            @foreach (App\Models\Candidature::STATUTS as $val => $label)
                                <option value="{{ $val }}" @selected(old('statut', 'to_review') === $val)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('statut')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Priorité <span class="text-red-500">*</span>
                        </label>
                        <select name="priorite"
                                class="w-full rounded-md border-gray-300 @error('priorite') border-red-500 @enderror">
                            @foreach (App\Models\Candidature::PRIORITES as $val => $label)
                                <option value="{{ $val }}" @selected(old('priorite', 'medium') === $val)>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('priorite')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Date --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Date de candidature <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date_candidature"
                           value="{{ old('date_candidature', date('Y-m-d')) }}"
                           class="w-full rounded-md border-gray-300 @error('date_candidature') border-red-500 @enderror">
                    @error('date_candidature')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Notes --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Notes libres
                    </label>
                    <textarea name="notes" rows="4"
                              class="w-full rounded-md border-gray-300">{{ old('notes') }}</textarea>
                </div>

                {{-- Boutons --}}
                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                        Enregistrer
                    </button>
                    <a href="{{ route('candidatures.index') }}"
                       class="bg-gray-100 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-200">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>