<?php

namespace App\Providers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $states = State::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();

        View::share('states',  $states);

        $countries = Country::select('id', 'name')
            ->orderBy('name', 'ASC')
            ->get();

        View::share('countries',  $countries);
    }
}
