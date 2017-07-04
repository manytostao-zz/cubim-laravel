<?php

namespace CUBiM\Http;

use CUBiM\Http\Middleware\Authenticate;
use CUBiM\Http\Middleware\Authorize;
use CUBiM\Http\Middleware\EncryptCookies;
use CUBiM\Http\Middleware\FunctionalTrace;
use CUBiM\Http\Middleware\RedirectIfAuthenticated;
use CUBiM\Http\Middleware\RetrieveNomenclators;
use CUBiM\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'guest' => RedirectIfAuthenticated::class
    ];

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        CheckForMaintenanceMode::class,
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        Authenticate::class,
        Authorize::class,
        RetrieveNomenclators::class,
        FunctionalTrace::class
    ];
}
