<?php

namespace Modules\Manage\Entities;

use Illuminate\Database\Eloquent\Model;

class ManageTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'manage__manage_translations';
}
