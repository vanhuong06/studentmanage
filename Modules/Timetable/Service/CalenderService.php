<?php

namespace Modules\Timetable\Service;

use Modules\Task\Entities\Task;


class CalenderService
{
    public function generateCalendarData($weekDays)
    {
        $calendarData = [];
        $timeRange = (new TimeService)->generateTimeRange(config('config.calendar.start_time'), config('config.calendar.end_time'));
        $lessons   = Task::with('task__tasks')
            ->calendarByRoleOrClassId()
            ->get();

        foreach ($timeRange as $time)
        {
            $timeText = $time['start'] . ' - ' . $time['end'];
            $calendarData[$timeText] = [];

            foreach ($weekDays as $index => $day)
            {
                $lesson = $lessons->where('weekday', $index)->where('start_time', $time['start'])->first();

                if ($lesson)
                {
                    array_push($calendarData[$timeText], [
                        'std_id'   => $lesson->class->name,
                        'rowspan'      => $lesson->difference/30 ?? ''
                    ]);
                }
                else if (!$lessons->where('weekday', $index)->where('start_time', '<', $time['start'])->where('end_time', '>=', $time['end'])->count())
                {
                    array_push($calendarData[$timeText], 1);
                }
                else
                {
                    array_push($calendarData[$timeText], 0);
                }
            }
        }

        return $calendarData;
    }
}