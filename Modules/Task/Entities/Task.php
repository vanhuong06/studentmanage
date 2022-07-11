<?php

namespace Modules\Task\Entities;

use Dimsav\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Management\Entities\Management;

class Task extends Model
{
    use Translatable;

    protected $table = 'task__tasks';
    public $translatedAttributes = [];
    protected $fillable = [
//        'std_id',
        'student_id',
        'name',
        'date',
        'start_time',
        'end_time'
    ];
    const WEEK_DAYS = [
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday',
        '7' => 'Sunday',
    ];

    function class()
    {
        return $this->belongsTo(Management::class, 'student_id');
    }
//    public function getDifferenceAttribute()
//    {
//        return Carbon::parse($this->end_time)->diffInMinutes($this->start_time);
//    }
//
//    public function getStartTimeAttribute($value)
//    {
//        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
//    }
//
//    public function setStartTimeAttribute($value)
//    {
//        $this->attributes['start_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
//            $value)->format('H:i:s') : null;
//    }
//
//    public function getEndTimeAttribute($value)
//    {
//        return $value ? Carbon::createFromFormat('H:i:s', $value)->format(config('panel.lesson_time_format')) : null;
//    }
//
//    public function setEndTimeAttribute($value)
//    {
//        $this->attributes['end_time'] = $value ? Carbon::createFromFormat(config('panel.lesson_time_format'),
//            $value)->format('H:i:s') : null;
//    }


    public static function isTimeAvailable($weekday, $startTime, $endTime, $task__tasks)
    {
        $task__tasks = self::where('weekday', $weekday)
            ->when($task__tasks, function ($query) use ($task__tasks) {
                $query->where('id', '!=', $task__tasks);
            })
            ->where(function ($query) use ($task__tasks) {
                $query->where('std_id', $task__tasks);

            })
            ->where([
                ['start_time', '<', $endTime],
                ['end_time', '>', $startTime],
            ])
            ->count();

        return !$task__tasks;
    }

    public function scopeCalendarByRoleOrClassId($query)
    {
        return $query
            ->when(request()->input('std_id'), function ($query) {
                $query->where('std_id', request()->input('std_id'));
            });
    }
}
