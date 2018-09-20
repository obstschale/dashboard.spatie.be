<?php

namespace App\Events\Losung;

use App\Events\DashboardEvent;

class LosungFetched extends DashboardEvent
{
    /** @var array */
    public $losung;

    public function __construct(array $losung)
    {
        $this->losung = $losung;
    }
}
