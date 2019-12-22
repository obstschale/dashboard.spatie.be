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
        $apiKeys = config('services.todoist.api_keys');
        $users = config('services.todoist.users');

        $client = new Client([
            'base_uri' => 'https://api.todoist.com/rest/v1/',
            'headers'  => [
                'Authorization' => "Bearer {$apiKeys[0]}",
                'Accept'        => 'application/json'
            ]
        ]);

        $tasksHH = $client->get('tasks');
        $tasksHH = collect(json_decode($tasksHH->getBody()))
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
            ->sortBy('priority', SORT_REGULAR, true)
            ->values()
            ->toArray();

        // Almut

        $client = new Client([
            'base_uri' => 'https://api.todoist.com/rest/v1/',
            'headers'  => [
                'Authorization' => "Bearer {$apiKeys[1]}",
                'Accept'        => 'application/json'
            ]
        ]);

        $tasksAlmut = $client->get('tasks');
        $tasksAlmut = collect(json_decode($tasksAlmut->getBody()))
            ->filter(function ($task) {
                return ! $task->completed;
            })
            ->filter(function ($task) {
                if (isset($task->project_id)) {
                    return $task->project_id === 2181086582;
                }

                return false;
            })
            ->sortBy('priority', SORT_REGULAR, true)
            ->values()
            ->toArray();

         event(new TodayTasksFetched([
             'hans-helge' => $tasksHH,
             'almut' => $tasksAlmut
         ]));
    }
}
