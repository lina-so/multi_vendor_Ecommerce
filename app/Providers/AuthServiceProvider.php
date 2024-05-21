<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        // Auth::setDefaultDriver('vendor');

        // foreach(config('abilities') as $code => $label)
        // {
        //     $user = Auth::guard('vendor')->user();
        //     // dd( Auth::getDefaultDriver());
        //     // dd(Auth::guard('vendor')->user());
        //     // dd(Auth::user());

        //     // $user = Auth::guard('vendor')->user();
        //     Gate::define($code,function($user) use ($code){

        //         // return Auth::guard('vendor')->user();
        //         return $user->hasAbility($code);
        //     });
        // }



    }
}
