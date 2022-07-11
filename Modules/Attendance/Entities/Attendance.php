<?php

namespace Modules\Attendance\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Management\Entities\Management;

class Attendance extends Model
{
    use Translatable;

    protected $table = 'attendance__attendances';
    public $translatedAttributes = [];
    protected $fillable = [
        'emp_id',
        'attendance_time',
        'attendance_date'
    ];

    public function employees()
    {
        return $this->belongsTo(Management::class);
    }
}
