<?php

namespace Modules\Attendance\Entities;

use Illuminate\Database\Eloquent\Model;

class AttendanceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'attendance__attendance_translations';
}
