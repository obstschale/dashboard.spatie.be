<?php

namespace App\Console\Components\Speedtest;

use App\Events\Speedtest\SpeedtestFetched;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchSpeedtest extends Command
{

    protected $signature = 'dashboard:speedtest';

    protected $description = 'Fetch latest speedtest';


    public function handle()
    {
        $apiKeys  = config('services.speedtest-collector.api_key');
        $location = config('services.speedtest-collector.location');

        $client = new Client([
            'base_uri' => "https://speedtest-collector.de/api/v1/",
            'headers'  => [
                'Authorization' => "Bearer {$apiKeys}",
                'Accept'        => 'application/json'
            ]
        ]);

        $speedtest = collect(json_decode($client->get("locations/{$location}/speedtests")
            ->getBody())->data)->first();

        event(new SpeedtestFetched([
            'upload'   => sprintf("%01.2f", ($speedtest->upload / 1024 / 1024)),
            'download' => sprintf("%01.2f", ($speedtest->download / 1024 / 1024)),
            'date'     => (new Carbon($speedtest->created_at))->format('d. F. Y H:m'),
        ]));
    }
}
