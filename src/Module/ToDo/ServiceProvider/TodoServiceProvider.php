<?php

namespace Service\Module\ToDo\ServiceProvider;

use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Public' => public_path('scripts'),
        ], 'public');
    }
}
