<?php


namespace App\Services\City;

use App\Models\City;
use Illuminate\Support\Collection;

abstract class AbstractCityService implements CityServiceInterface
{
    public function getCitiesByName(string $cityName): Collection
    {
        // todo try catch and return status exception
        //todo try to get City by name first from cache too
        $cityDtoCollection = $this->getFromResource($cityName); //return dto
        // todo store City from dto and return
        return $cityDtoCollection;
    }

    abstract protected function getFromResource(string $cityName);//: ?Collection;
}
