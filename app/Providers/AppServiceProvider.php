<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        Validator::extend('file_ext', function ($attribute, $value, $parameters, $validator) {
            $ext = strtolower($value->getClientOriginalExtension());
            return in_array($ext, ['png', 'jpg', 'pdf']);
        });
        
    }
}
