<?php

namespace Modules\Timetable\Entities;

use Illuminate\Database\Eloquent\Model;

class TimeTableTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'timetable__timetable_translations';
}
