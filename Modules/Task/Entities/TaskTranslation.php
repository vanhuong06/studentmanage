<?php

namespace Modules\Task\Entities;

use Illuminate\Database\Eloquent\Model;

class TaskTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'task__task_translations';
}
