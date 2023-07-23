<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\SafetyObservationForm;

class SafetyObservationFormPolicy
{
    // public function viewPegawai(User $user)
    // {
    //     return $user->role === 'pegawai';
    // }

    public function editForm(User $user, SafetyObservationForm $form)
    {
        return ($user->id === $form->createdBy || $user->role === 'SHE') && $form->status === 'PENDING_REVIEW';
    }

    public function deleteForm(User $user, SafetyObservationForm $form)
    {
        return $user->role === 'SHE' || ($user->role === 'admin' && $form->status === 'REJECTED');
    }

    public function giveReview(User $user, SafetyObservationForm $form)
    {
        return $user->role === 'SHE' && $form->status === 'PENDING_REVIEW';
    }

    public function giveApprove(User $user, SafetyObservationForm $form)
    {
        return $user->role === 'manager maintenance' && $form->status === 'PENDING_APPROVAL';
    }
}
