<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        $stats = [
            'total'    => $user->candidatures()->count(),
            'en_cours' => $user->candidatures()
                              ->whereIn('statut', ['to_review', 'interview_scheduled'])
                              ->count(),
            'offres'   => $user->candidatures()
                              ->where('statut', 'offer_received')
                              ->count(),
            'archives' => $user->candidatures()->onlyTrashed()->count(),
        ];

        $recentes = $user->candidatures()
            ->with('entretiens')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentes'));
    }
}
