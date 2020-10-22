<?php

return [
    'icals' => [ env('ICAL1'), env('ICAL2'), env('ICAL3'), env('ICAL4'), env('ICAL5')],
    'colors' => explode(',', env('ICAL_COLORS')),
];
