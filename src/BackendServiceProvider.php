<?php

namespace QRFeedz\Backend;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use QRFeedz\Foundation\Abstracts\QRFeedzServiceProvider;

class BackendServiceProvider extends QRFeedzServiceProvider
{
    public function boot()
    {
        $this->loadViews();
        $this->overrideResources();
        $this->registerViewComposers();
        $this->registerAnonymousBladeComponents();
        $this->loadTranslations();
    }

    public function register()
    {
        //
    }

    protected function registerViewComposers()
    {
        View::composer('*', 'QRFeedz\Backend\View\Composers\SidebarComposer');
    }

    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'qrfeedz-backend');
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(
            __DIR__.'/../resources/views',
            'qrfeedz-backend'
        );
    }

    protected function overrideResources()
    {
        $this->publishes([
            __DIR__.'/../resources/overrides/' => base_path('/'),
        ], 'qrfeedz-backend-overrides');
    }

    protected function registerAnonymousBladeComponents()
    {
        Blade::anonymousComponentPath(
            __DIR__.'/../resources/views/components'
        );
    }
}
