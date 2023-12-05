<?php

declare(strict_types=1);

namespace App\Services\City;

use Illuminate\Support\Collection;

interface CityServiceInterface
{
    public function getCitiesByName(string $cityName): Collection;
}
