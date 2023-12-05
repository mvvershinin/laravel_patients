<?php


namespace App\Services\City;

use App\Services\City\Dto\CityDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class OpenWeatherCityService extends AbstractCityService
{
    protected string $openweather_api_key;
    protected string $endpoint;


    public function __construct()
    {
        $this->endpoint = "http://api.openweathermap.org/geo/1.0/direct?";
        $this->openweather_api_key = env('OPENWEATHER_KEY');
    }

    protected function getFromResource(string $cityName)//: ?Collection
    {
        $q = http_build_query([
            'q' => $cityName,
            'limit' => 100,
            'appid' => $this->openweather_api_key,
        ]);
        try {
            $response = $this->executeGet($this->endpoint . $q);

            return collect($response->json() ?? [])->map(function ($item) {
                return new CityDto(
                    $item['name'],
                    $item['state'],
                    $item['country'],
                    $item['lat'],
                    $item['lon'],
                );
            });
        } catch (\Throwable $exception) {
            $errorMessage = $exception->getMessage();
            $errorCode = $exception->getCode();
            $errorTrace = $exception->getTraceAsString();
            Log::error("Error: $errorMessage | Code: $errorCode | Trace: $errorTrace");
            // todo openweather cities custom exception
            throw $exception;
        }
    }

    protected function executeGet(string $url):Response
    {
        return Http::get($url);
    }
}
