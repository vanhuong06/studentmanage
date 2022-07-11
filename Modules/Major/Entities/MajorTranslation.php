<?php

namespace Modules\Major\Entities;

use Illuminate\Database\Eloquent\Model;

class MajorTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'major__major_translations';
}
