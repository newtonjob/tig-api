<?php

namespace App\Providers;

use Illuminate\Auth\GenericUser;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        Auth::viaRequest('tig', function (Request $request) {
            if (! str_contains($token = $request->bearerToken(), '|')) {
                return null;
            }

            [$ref_no, $session_id] = explode('|', $token, 2);

            if (! $email = cache("session:{$session_id}:email")) {
                return null;
            }

            return new GenericUser(compact(['ref_no', 'session_id', 'email']));
        });
    }
}
