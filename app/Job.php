<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Model\Management;


class Job extends Model
{
    //
    protected $table = 'job';
    protected $fillable = [
        'id',
        'position'
    ];

    public function management(){
        return $this->hasMany(Management::class, 'position', 'id');
    }
}
