<?php

namespace App\Providers;

use App\Api\Serializer\CustomSerializer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        //app('api.transformer')->getAdapter()->getFractal()->setSerializer(new CustomSerializer());
        $this->app->make('api.transformer')->getAdapter()->getFractal()->setSerializer(new CustomSerializer());
    }

    public function boot()
    {

    }
}
