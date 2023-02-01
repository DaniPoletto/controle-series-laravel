<?php

namespace App\Providers;

use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;
use App\repositories\EloquentSeriesRepository;

class SeriesRepositoryProvider extends ServiceProvider
{
    //poderia ter vários providers nesse array e não seria necessário o register
    public $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->bind(SeriesRepository::class, EloquentSeriesRepository::class);
    }
}
