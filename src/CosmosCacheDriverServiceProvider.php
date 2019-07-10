<?php

namespace Krisell\CosmosCacheDriver;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class CosmosCacheDriverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Cache::extend('cosmos', function ($app) {
            return Cache::repository(
                new CosmosStore(app('db')->connection('cosmos'),
                config('cache.stores.cosmos.table'),
            ));
        });
    }

    public function register()
    {

    }
}