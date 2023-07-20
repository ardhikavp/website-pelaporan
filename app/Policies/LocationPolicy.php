<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Location;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Location $location)
    {
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Location $location)
    {
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Location $location)
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Location $location)
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Location $location)
    {
        return $user->isAdmin() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }
}
