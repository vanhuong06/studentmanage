<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;

class SchoolTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'school__school_translations';
}
