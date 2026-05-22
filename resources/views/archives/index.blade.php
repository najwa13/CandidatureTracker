<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Candidatures archivées</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-amber-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Entreprise</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Poste</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Archivée le</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($candidatures as $candidature)
                        <tr class="bg-amber-50/30 hover:bg-amber-50">
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $candidature->entreprise }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $candidature->poste }}</td>
                            <td class="px-6 py-4">
                                <x-badge-statut :statut="$candidature->statut" />
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $candidature->deleted_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('archives.restore', $candidature->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                            class="text-sm text-indigo-600 hover:underline">
                                        Restaurer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                Aucune candidature archivée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $candidatures->links() }}</div>
    </div>
</x-app-layout>