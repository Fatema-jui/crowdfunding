<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded=[];
    public function crises()
{
    return $this->belongsToMany(Crisis::class, 'crisis_volunteer');
}
}
