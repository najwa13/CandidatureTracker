<?php

namespace App\Policies;

use App\Models\Candidature;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CandidaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }
    public function view(User $user, Candidature $candidature): bool
    {
        return $user->id === $candidature->user_id;
    }

    public function update(User $user, Candidature $candidature): bool
    {
        return $user->id === $candidature->user_id;
    }

    public function delete(User $user, Candidature $candidature): bool
    {
        return $user->id === $candidature->user_id;
    }

    public function restore(User $user, Candidature $candidature): bool
    {
        return $user->id === $candidature->user_id;
    }

}
