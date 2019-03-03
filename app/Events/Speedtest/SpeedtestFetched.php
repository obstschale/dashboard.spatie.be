<?php

namespace App\Events\Speedtest;

use App\Events\DashboardEvent;

class SpeedtestFetched extends DashboardEvent
{
    /** @var array */
    public $speedtest;

    public function __construct(array $speedtest)
    {
        $this->speedtest = $speedtest;
    }
}
