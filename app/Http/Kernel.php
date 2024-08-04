<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'admin' => [
            \App\Http\Middleware\Admin\RedirectIfNotAuthenticated::class,
            \App\Http\Middleware\Admin\CheckAccountStatus::class,
        ],
        
            
        
        'seller' => [
            \App\Http\Middleware\Seller\RedirectIfNotAuthenticated::class,
            \App\Http\Middleware\Seller\CheckAccountStatus::class,
            \App\Http\Middleware\Seller\CheckEmailVerification::class,
            \App\Http\Middleware\Seller\CheckMobileVerification::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'member' => \App\Http\Middleware\User\CheckMembership::class,
        'user' => \App\Http\Middleware\User\RedirectIfNotAuthenticated::class,
        'user.status' =>\App\Http\Middleware\User\CheckAccountStatus::class,
        'user.email.status' =>\App\Http\Middleware\User\CheckEmailVerification::class,
        'admin.guest' => \App\Http\Middleware\Admin\RedirectIfAuthenticated::class,
        'seller.guest' => \App\Http\Middleware\Seller\RedirectIfAuthenticated::class,
        'user.guest' => \App\Http\Middleware\User\RedirectIfAuthenticated::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
