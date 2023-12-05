<?php


namespace App\Services\City\Dto;


use Illuminate\Contracts\Support\Arrayable;

class CityDto implements Arrayable
{
    public function __construct(
        protected string $name,
        protected string $state,
        protected string $country,
        protected float $lat,
        protected float $lon,
    ){
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'state' => $this->state,
            'country' => $this->country,
            'lat' => $this->lat,
            'lon' => $this->lon,
        ];
    }
}
