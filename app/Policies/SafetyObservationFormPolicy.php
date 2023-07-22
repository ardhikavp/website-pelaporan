<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\SafetyObservationForm;

class SafetyObservationFormPolicy
{
    public function editForm(User $user, SafetyObservationForm $form)
    {
        return ($user->id === $form->createdBy || $user->role === 'SHE') && $form->status === 'PENDING_REVIEW';
    }

    public function deleteForm(User $user, SafetyObservationForm $form)
    {
        return $user->role === 'SHE' || ($user->role === 'admin' && $form->status === 'REJECTED');
    }
}
