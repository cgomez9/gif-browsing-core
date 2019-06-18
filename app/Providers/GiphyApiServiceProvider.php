<?php

namespace App\Providers;

use App\Interfaces\GiphyApiInterface;
use App\Services\GiphyApiHandler;
use Illuminate\Support\ServiceProvider;

class GiphyApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GiphyApiHandler::class, function () {
            $url = config('giphy.url');
            $apiKey = config('giphy.api_key');
            return new GiphyApiHandler($url, $apiKey);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
