<?php

namespace Modules\Timetable\Service;

use Carbon\Carbon;

class TimeService
{
    public function generateTimeRange($from, $to)
    {
        $time = Carbon::parse($from);
        $timeRange = [];

        do
        {
            array_push($timeRange, [
                'start' => $time->format("H:i"),
                'end' => $time->format("H:i")
            ]);
        } while ($time->format("H:i") !== $to);

        return $timeRange;
    }
}