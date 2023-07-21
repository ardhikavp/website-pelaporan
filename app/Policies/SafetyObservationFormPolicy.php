<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\SafetyObservationForm;

class SafetyObservationFormPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function boot(): void
    {
    Gate::define('update-post', function (User $user, Post $post) {
        return $user->id === $post->user_id;
    });
    }
}
