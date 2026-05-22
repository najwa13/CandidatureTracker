<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreFichierRequest;
use App\Models\Candidature;
use App\Models\Fichier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FichierController extends Controller
{
    
    public function store(StoreFichierRequest $request, Candidature $candidature): RedirectResponse
    {
        $this->authorize('update', $candidature);

        foreach ($request->file('fichiers') as $file) {
            $chemin = $file->store('candidatures/' . $candidature->id, 'local');

            $candidature->fichiers()->create([
                'nom_original' => $file->getClientOriginalName(),
                'chemin'       => $chemin,
                'type_mime'    => $file->getMimeType(),
                'taille'       => $file->getSize(),
            ]);
        }

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', count($request->file('fichiers')) . ' fichier(s) ajouté(s).');
    }

   
    public function download(Fichier $fichier): StreamedResponse
    {
        $this->authorize('download', $fichier);

        abort_unless(Storage::disk('local')->exists($fichier->chemin), 404);

        return Storage::disk('local')->download($fichier->chemin, $fichier->nom_original);
    }

    
    public function destroy(Fichier $fichier): RedirectResponse
    {
        $this->authorize('delete', $fichier);
        $candidature_id = $fichier->candidature_id;

        Storage::disk('local')->delete($fichier->chemin);

        $fichier->delete();

        return redirect()->route('candidatures.show', $candidature_id)
            ->with('success', 'Fichier supprimé.');
    }
}
