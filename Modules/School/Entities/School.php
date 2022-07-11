<?php

namespace Modules\School\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use Translatable;

    protected $table = 'school__schools';
    public $translatedAttributes = [];
    protected $fillable = [
        'school_name',
        'school_code',
        'school_major',
    ];
}
