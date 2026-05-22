<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold">Mes candidatures</h2>
            <a href="{{ route('candidatures.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                + Nouvelle candidature
            </a>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">

        {{-- Messages flash --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filtres --}}
        <form method="GET" action="{{ route('candidatures.index') }}"
              class="flex gap-3 mb-6 items-end flex-wrap">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select name="statut" onchange="this.form.submit()"
                        class="rounded-md border-gray-300 text-sm">
                    <option value="">Tous les statuts</option>
                    @foreach (App\Models\Candidature::STATUTS as $val => $label)
                        <option value="{{ $val }}" @selected(request('statut') === $val)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Priorité</label>
                <select name="priorite" onchange="this.form.submit()"
                        class="rounded-md border-gray-300 text-sm">
                    <option value="">Toutes les priorités</option>
                    @foreach (App\Models\Candidature::PRIORITES as $val => $label)
                        <option value="{{ $val }}" @selected(request('priorite') === $val)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if (request('statut') || request('priorite'))
                <a href="{{ route('candidatures.index') }}"
                   class="text-sm text-gray-500 underline self-end pb-1">
                    Effacer les filtres
                </a>
            @endif
        </form>

        {{-- Liste --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entreprise</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poste</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Priorité</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entretiens</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($candidatures as $candidature)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">
                                {{ $candidature->entreprise }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $candidature->poste }}</td>
                            <td class="px-6 py-4">
                                <x-badge-statut :statut="$candidature->statut" />
                            </td>
                            <td class="px-6 py-4">
                                <x-badge-priorite :priorite="$candidature->priorite" />
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">
                                {{ $candidature->date_candidature->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-sm">
                                {{ $candidature->entretiens->count() }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('candidatures.show', $candidature) }}"
                                   class="text-indigo-600 hover:underline text-sm">Voir</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                Aucune candidature pour le moment.
                                <a href="{{ route('candidatures.create') }}"
                                   class="text-indigo-600 underline ml-1">
                                    Ajouter ma première candidature
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $candidatures->links() }}
        </div>
    </div>
</x-app-layout>