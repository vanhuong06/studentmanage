<?php

namespace Modules\Management\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Job;
use Modules\Attendance\Entities\Attendance;
use Modules\Manage\Entities\Manage;
use Modules\Management\Events\ManagementContentIsRendering;

class Management extends Model
{
    use Translatable;

    protected $guarded = ['_token'];
    protected $table = 'management__management';
    public $translatedAttributes = [];
    protected $fillable = [
        'name',
        'phone',
        'position',
        'school_code',
        'major',
        'address'
    ];

    public function getBodyAttribute($body)
    {
        event($event = new ManagementContentIsRendering($body));

        return $event->getBody();
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function manage(){
        return $this->hasMany(Manage::class);
    }
    public function jobs()
    {
        return $this-> belongsTo(Job::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
}
