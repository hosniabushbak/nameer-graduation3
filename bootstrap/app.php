<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // health: '/up',

        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
     
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
                
            Route::middleware('api')
                ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'localize'                => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes::class,
            'localizationRedirect'    => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter::class,
            'localeSessionRedirect'   => \Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect::class,
            'localeCookieRedirect'    => \Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect::class,
            'localeViewPath'          => \Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath::class,

            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

            'Excel' => Maatwebsite\Excel\Facades\Excel::class,

            'auths' => \App\Http\Middleware\Authenticate::class,
            'admin' => \App\Http\Middleware\Admin::class,
            'ChangeLang'    => \App\Http\Middleware\ChangeLang::class,
            'OAuth2'    => \App\Http\Middleware\OAuth2::class,

            'Vimeo' => Vimeo\Laravel\Facades\Vimeo::class
        ]);

        $middleware->web(append: [
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
