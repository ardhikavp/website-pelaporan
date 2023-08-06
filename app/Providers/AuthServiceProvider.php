<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Company;
use App\Policies\CompanyPolicy;
use App\Policies\SafetyBehaviorChecklistPolicy;
use App\Policies\SafetyObservationFormPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Company::class => CompanyPolicy::class,
        // SafetyObservationForm::class => SafetyObservationFormPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::resource('company', CompanyPolicy::class);
        Gate::define('edit-safety-observation-form', [SafetyObservationFormPolicy::class, 'editForm']);
        Gate::define('delete-safety-observation-form', [SafetyObservationFormPolicy::class, 'deleteForm']);
        Gate::define('give-safety-observation-review', [SafetyObservationFormPolicy::class, 'giveReview']);
        Gate::define('give-safety-observation-approve', [SafetyObservationFormPolicy::class, 'giveApprove']);

        Gate::define('export-safety-behavior-checklist', [SafetyBehaviorChecklistPolicy::class, 'exportFormSBC']);
        Gate::define('view-safety-behavior-checklist', [SafetyBehaviorChecklistPolicy::class, 'viewFormSBC']);
        Gate::define('edit-safety-behavior-checklist', [SafetyBehaviorChecklistPolicy::class, 'editFormSBC']);
        Gate::define('delete-safety-behavior-checklist', [SafetyBehaviorChecklistPolicy::class, 'deleteFormSBC']);
        Gate::define('give-safety-behavior-checklist-review', [SafetyBehaviorChecklistPolicy::class, 'giveReviewSBC']);
        Gate::define('give-safety-behavior-checklist-approve', [SafetyBehaviorChecklistPolicy::class, 'giveApproveSBC']);
    }
}
