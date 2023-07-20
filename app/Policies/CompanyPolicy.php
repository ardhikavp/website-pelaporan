<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->role === 'admin' || $user->role === 'SHE'
            ? Response::allow()
            : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }


    public function view(User $user, Company $company)
    {
        // Gunakan metode "non-null assertion" untuk mendeklarasikan bahwa izin diberikan secara otomatis
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    public function create(User $user)
    {
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    public function update(User $user, Company $company)
    {
        return $user->isAdmin() || $user->isSHE() ? Response::allow() : Response::deny('Anda tidak memiliki izin untuk akses halaman ini.');
    }

    public function delete(User $user, Company $company): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Company $company): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Company $company): bool
    {
        return $user->isAdmin();
    }
}
