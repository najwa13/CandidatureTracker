<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCandidatureRequest;
use App\Http\Requests\UpdateCandidatureRequest;
use App\Models\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class CandidatureController extends Controller
{
    
    public function index(Request $request): View
    {
        $candidatures = auth()->user()->candidatures()
            ->with(['entretiens', 'fichiers'])
            ->when($request->statut,   fn($q, $v) => $q->where('statut',   $v))
            ->when($request->priorite, fn($q, $v) => $q->where('priorite', $v))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('candidatures.index', compact('candidatures'));
    }

    public function create(): View
    {
        return view('candidatures.create');
    }

    public function store(StoreCandidatureRequest $request): RedirectResponse
    {
        $data            = $request->validated();
        $data['user_id'] = auth()->id();

        Candidature::create($data);

        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature ajoutée avec succès.');
    }

    public function show(Candidature $candidature): View
    {
        $this->authorize('view', $candidature);
        $candidature->load(['entretiens', 'fichiers']);

        return view('candidatures.show', compact('candidature'));
    }

    public function edit(Candidature $candidature): View
    {
        $this->authorize('update', $candidature);
        return view('candidatures.edit', compact('candidature'));
    }

    public function update(UpdateCandidatureRequest $request, Candidature $candidature): RedirectResponse
    {
        $this->authorize('update', $candidature);
        $candidature->update($request->validated());

        return redirect()->route('candidatures.show', $candidature)
            ->with('success', 'Candidature mise à jour.');
    }

    public function destroy(Candidature $candidature): RedirectResponse
    {
        $this->authorize('delete', $candidature);
        $candidature->delete(); // soft delete

        return redirect()->route('candidatures.index')
            ->with('success', 'Candidature archivée.');
    }

}
