<?php

namespace Modules\Major\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use Translatable;

    protected $table = 'major__majors';
    public $translatedAttributes = [];
    protected $fillable = [
        'major_name',
        'major_id'
    ];
}
