<?php

namespace QRFeedz\Backend;

use Brunocfalcao\Tracer\Middleware\VisitTracing;
use Illuminate\Support\Facades\Route;
use QRFeedz\Foundation\Abstracts\QRFeedzServiceProvider;

class BackendServiceProvider extends QRFeedzServiceProvider
{
    public function boot()
    {
        $this->loadViews();
        $this->overrideResources();
    }

    public function register()
    {
        //
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(
            __DIR__.'/../resources/views',
            'qrfeedz-backend'
        );
    }

    protected function loadRoutes()
    {
        // Load default backend routes.
        $routesPath = __DIR__.'/../routes/backend.php';

        Route::middleware([
            'web',
            VisitTracing::class,
        ])
            ->group(function () use ($routesPath) {
                include $routesPath;
            });
    }

    protected function overrideResources()
    {
        $this->publishes([
            __DIR__.'/../resources/overrides/' => base_path('/'),
        ], 'qrfeedz-backend-overrides');
    }
}
