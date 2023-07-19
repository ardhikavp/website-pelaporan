<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Company;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Company $company): bool
    {
        // Gunakan metode "non-null assertion" untuk mendeklarasikan bahwa izin diberikan secara otomatis
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Company $company): bool
    {
        return $user->isAdmin();
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
