<?php

namespace Modules\Addmajor\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AddMajor extends Model
{
    use Translatable;

    protected $table = 'addmajor__addmajors';
    public $translatedAttributes = [];
    protected $fillable = [
        'school_code',
        'major_id'
    ];
}
