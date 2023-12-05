<?php

namespace App\Providers;

use App\Services\City\OpenWeatherCityService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

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
        $this->bindCitiesService();
//        $this->bindWeatherService();
    }

//    protected function bindWeatherService(): void
//    {
//        $this->app->bind("App\Services\City\CityServiceInterface", static function () {
//            $resource = config('weather.resource');
//            switch ($resource) {
//                case 'openweather':
//                    //return new OpenWeatherCityService();
//                case 'mock':
//                    //todo make mockServiceClass
//                    break;
//
//                // place more services for outer resources
//                default:
//                    throw new \Exception("Service provider not defined for $resource");
//            }
//        });
//    }

    protected function bindCitiesService(): void
    {
        $this->app->bind("App\Services\City\CityServiceInterface", static function () {
            $resource = config('cities.resource');
            switch ($resource) {
                case 'openweather':
                    return new OpenWeatherCityService();
                case 'mock':
                    //todo make mockServiceClass
                    break;

                // place more services for outer resources
                default:
                    throw new \Exception("Service provider not defined for $resource");
            }
        });
    }
}
