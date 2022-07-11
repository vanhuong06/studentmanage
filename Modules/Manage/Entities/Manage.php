<?php

namespace Modules\Manage\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Management\Entities\Management;

class Manage extends Model
{
    use Translatable;

    protected $table = 'manage__manages';
    public $translatedAttributes = [];
    protected $fillable = [];

    public function employee()
    {
        return $this->belongsTo(Management::class, 'emp_id');
    }
}
