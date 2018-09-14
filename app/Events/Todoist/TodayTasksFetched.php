<?php

namespace App\Events\Todoist;

use App\Events\DashboardEvent;

class TodayTasksFetched extends DashboardEvent
{
    /** @var array */
    public $tasks;

    public function __construct(array $tasks)
    {
        $this->tasks = $tasks;
    }
}
