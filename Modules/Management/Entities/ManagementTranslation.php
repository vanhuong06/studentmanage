<?php

namespace Modules\Management\Entities;

use Illuminate\Database\Eloquent\Model;

class ManagementTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'management__management_translations';
}
