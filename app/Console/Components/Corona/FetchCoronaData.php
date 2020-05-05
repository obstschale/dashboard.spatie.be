<?php

namespace App\Console\Components\Corona;

use App\Events\Corona\CoronaDataFetched;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchCoronaData extends Command
{

    protected $signature = 'dashboard:corona';

    protected $description = 'Fetch latest corona data';


    public function handle()
    {
        $client = new Client([
            'base_uri' => "https://corona.lmao.ninja",
            'headers'  => [
                'Accept'        => 'application/json'
            ]
        ]);

        $all = json_decode($client->get("v2/all")->getBody());
        $germany = json_decode($client->get('v2/countries/germany')->getBody());

        event(new CoronaDataFetched([
            'all'   => $all,
            'germany' => $germany,
        ]));
    }
}
