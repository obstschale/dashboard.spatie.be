<?php

namespace App\Console\Components\Calendar;

use App\Events\Calendar\EventsFetched;
use Carbon\Carbon;
use DateTime;
use ICal\Event;
use ICal\ICal;
use Illuminate\Console\Command;

class FetchCalendarEvents extends Command
{

    protected $signature = 'dashboard:fetch-calendar-events';

    protected $description = 'Fetch events from a Google Calendar';


    public function handle()
    {
        $ical = new ICal();
        $ical->initUrl(config('calendars.ical'));

        $events = collect($ical->events())
            ->filter(function (Event $event) {
                $date = new Carbon($event->dtend);

                return $date > Carbon::now();
            })
            ->map(function (Event $event) {
                return [
                    'name'      => $event->summary,
                    'startdate' => (new Carbon($event->dtstart))->format(DateTime::ATOM),
                    'enddate'   => (new Carbon($event->dtend))->format(DateTime::ATOM),
                ];
            })
            ->sortBy('startdate')
            ->values()
            ->unique('name')
            ->toArray();

        event(new EventsFetched($events));
    }
}
