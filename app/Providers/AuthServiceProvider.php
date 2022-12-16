<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        //verify email
        // VerifyEmail::createUrlUsing(function ($notifiable) {
        //     return URL::temporarySignedRoute(
        //         'verification.verify',
        //         Carbon::now()->addMinutes(60),
        //         ['id' => $notifiable->getKey()]
        //     );
        // });

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $spaUrl = "http://localhost:8080/verify-email?token=$url";
            return (new MailMessage)
                ->subject('Verify your email address')
                ->line('Please click the button below to verify your email address.')
                ->action('Verify Email Address', $spaUrl);
        });

        // Passport::personalAccessTokensExpireIn(now()->addMinutes(1));
    }
}
