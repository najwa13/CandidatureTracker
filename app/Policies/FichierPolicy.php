<?php

namespace App\Policies;

use App\Models\Fichier;
use App\Models\User;

class FichierPolicy
{
    public function download(User $user, Fichier $fichier): bool
    {
        return $user->id === $fichier->candidature->user_id;
    }

    public function delete(User $user, Fichier $fichier): bool
    {
        return $user->id === $fichier->candidature->user_id;
    }
}
