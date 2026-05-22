<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreEntretienRequest;
use App\Http\Requests\UpdateEntretienRequest;
use App\Models\Candidature;
use App\Models\Entretien;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EntretienController extends Controller
{
    public function store(StoreEntretienRequest $request, Candidature $candidature): RedirectResponse
    {
        $this->authorize('update', $candidature);
        $candidature->entretiens()->create($request->validated());

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Entretien ajouté.');
    }

    public function edit(Entretien $entretien): View
    {
        $this->authorize('update', $entretien);
        return view('entretiens.edit', compact('entretien'));
    }

    public function update(UpdateEntretienRequest $request, Entretien $entretien): RedirectResponse
    {
        $this->authorize('update', $entretien);
        $entretien->update($request->validated());

        return redirect()->route('candidatures.show', $entretien->candidature_id)
            ->with('success', 'Entretien mis à jour.');
    }

    public function destroy(Entretien $entretien): RedirectResponse
    {
        $this->authorize('delete', $entretien);
        $candidature_id = $entretien->candidature_id;
        $entretien->delete();

        return redirect()->route('candidatures.show', $candidature_id)
            ->with('success', 'Entretien supprimé.');
    }
}
 