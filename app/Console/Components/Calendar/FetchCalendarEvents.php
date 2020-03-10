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

    protected $description = 'Fetch events from a Private Calendar';


    public function handle()
    {
        $events = collect(config('calendars.colors'))
            ->combine(config('calendars.icals'))
            ->map(static function (string $url, string $color) {
                $ical = new ICal();
                $ical->initUrl($url);

                return collect($ical->events())
                    ->map(static function (Event $event) use ($color) {
                        return [
                            'name'      => $event->summary,
                            'startdate' => (new Carbon($event->dtstart))->format(DateTime::ATOM),
                            'enddate'   => (new Carbon($event->dtend))->format(DateTime::ATOM),
                            'color'     => $color,
                        ];
                    });
            })
            ->flatten(1)
            ->filter(static function (array $event) {
                $date = new Carbon($event['enddate']);

                return $date > Carbon::now();
            })
            ->sortBy('startdate')
            ->values()
            ->unique('name')
            ->toArray();

        event(new EventsFetched($events));
    }
}
