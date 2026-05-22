<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidature;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class ArchiveController extends Controller
{
     public function index(): View
    {
        $candidatures = auth()->user()->candidatures()
            ->onlyTrashed()
            ->with(['entretiens', 'fichiers'])
            ->latest('deleted_at')
            ->paginate(15);

        return view('archives.index', compact('candidatures'));
    }

    public function restore(int $id): RedirectResponse
    {
        $candidature = Candidature::withTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $this->authorize('restore', $candidature);
        $candidature->restore();

        return redirect()->route('archives.index')
            ->with('success', 'Candidature restaurée avec succès.');
    }
}
