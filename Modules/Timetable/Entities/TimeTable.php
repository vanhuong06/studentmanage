<?php

namespace Modules\Timetable\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use Translatable;

    protected $table = 'timetable__timetables';
    public $translatedAttributes = [];
    protected $fillable = [];
}
