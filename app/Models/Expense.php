<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $guarded = [];

    public function crisis(){
        
    return $this->belongsTo(Crisis::class, 'crisis_id');
    }

     public function volunteer(){

    return $this->belongsTo(Volunteer::class, 'volunteer_id');
    }

}
