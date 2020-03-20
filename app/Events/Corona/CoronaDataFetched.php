<?php

namespace App\Events\Corona;

use App\Events\DashboardEvent;

class CoronaDataFetched extends DashboardEvent
{
    /** @var array */
    public $coronaData;

    public function __construct(array $coronaData)
    {
        $this->coronaData = $coronaData;
    }
}
