<?php

namespace App\Console\Components\Todoist;

use App\Events\Todoist\TodayTasksFetched;
use App\Services\GitHub\GitHubApi;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class TodayTasks extends Command
{

    protected $signature = 'dashboard:today-tasks';

    protected $description = 'Fetch tasks for today from Todoist';


    public function handle(GitHubApi $gitHub)
    {
        $apiKey = config('services.todoist.api_key');

        $client = new Client([
            'base_uri' => 'https://beta.todoist.com/API/v8/',
            'headers'  => [
                'Authorization' => "Bearer {$apiKey}",
                'Accept'        => 'application/json'
            ]
        ]);

        $tasks = $client->get('tasks');
        $tasks = collect(json_decode($tasks->getBody()))
            ->filter(function ($task) {
                return ! $task->completed;
            })
            ->filter(function ($task) {
                if (isset($task->due->date)) {
                    $date = Carbon::parse($task->due->date);
                    return Carbon::now() >= $date;
                }

                return false;
            })
            ->sortBy('priority')
            ->toArray();

         event(new TodayTasksFetched($tasks));
    }
}
