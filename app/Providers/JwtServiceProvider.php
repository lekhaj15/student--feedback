<?php

namespace App\Providers;

use PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider;

class JwtServiceProvider extends LaravelServiceProvider
{
    /**
     * Alias the middleware.
     *
     * @return void
     */
    protected function aliasMiddleware()
    {
    }
}
