<?php

namespace App\Console\Components\Losung;

use App\Events\Losung\LosungFetched;
use Illuminate\Console\Command;
use League\Csv\Reader;
use League\Csv\Statement;

class FetchLosung extends Command
{

    protected $signature = 'dashboard:fetch-losung';

    protected $description = "Fetch today's Losung";


    /**
     * @throws \League\Csv\Exception
     */
    public function handle()
    {
        $csv = Reader::createFromPath(storage_path('app/losung2018.csv'), 'r');
        $csv->setDelimiter("\t");
        $csv->setHeaderOffset(0); //set the CSV header offset

        $today = new \DateTime();
        $stmt  = (new Statement())->offset($today->format('z') - 1)->limit(3);

        $records = $stmt->process($csv);
        foreach ($records as $record) {
            $losungDate = (new \DateTime($record['Datum']))->format('Y-m-d');
            if ($today->format('Y-m-d') === $losungDate) {
                $losung = $record;
            }
        }

        if (empty($losung)) {
            return;
        }

        foreach ($losung as $key => $value) {
            $losung[$key] = utf8_encode($value);
        }

        event(new LosungFetched($losung));
    }
}
