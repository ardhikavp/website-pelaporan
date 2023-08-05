<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Answer;

class SafetyBehaviorChecklistPolicy
{
    /**
     * Create a new policy instance.
     */
    // public function __construct()
    // {

    // }

    public function viewFormSBC(User $user, Answer $answer)
    {
        return (($user->company_id === $answer->company_id && ($user->role === 'safety officer' || $user->role === 'safety representatif'))
        || $user->role === 'SHE' || $user->role === 'admin' || $user->role === 'manager maintenance')
        && ($answer->status === 'APPROVED' || $answer->status === 'REJECTED');
    }

    public function editFormSBC(User $user, Answer $answer)
    {
        return ($user->id === $answer->user_id || $user->role === 'SHE') && $answer->status === 'PENDING_REVIEW';
    }

    public function deleteFormSBC(User $user, Answer $answer)
    {
        return $user->role === 'SHE' || ($user->role === 'admin' && $answer->status === 'REJECTED');
    }

    public function giveReviewSBC(User $user, Answer $answer)
    {
        return ($user->role === 'safety officer' || $user->role === 'safety representatif') && $user->company_id === $answer->company_id && $answer->status === 'PENDING_REVIEW';
    }

    public function giveApproveSBC(User $user, Answer $answer)
    {
        return $user->role === 'manager maintenance' && $answer->status === 'PENDING_APPROVAL';
    }
}
