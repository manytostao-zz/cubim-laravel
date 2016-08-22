<?php

namespace CUBiM\Http;

use CUBiM\Http\Middleware\AuthorizationMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \CUBiM\Http\Middleware\RedirectIfAuthenticated::class,
    ];

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \CUBiM\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \CUBiM\Http\Middleware\VerifyCsrfToken::class,
        \CUBiM\Http\Middleware\Authenticate::class,
        \CUBiM\Http\Middleware\Authorize::class,
        \CUBiM\Http\Middleware\RetrieveNomenclators::class
    ];
}
