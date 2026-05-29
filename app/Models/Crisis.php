<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Crisis extends Model
{
    
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function donations(){

        return $this->hasMany(Donation::class, 'crisis_id');
    }

    public function volunteers(){
        
    return $this->belongsToMany(Volunteer::class, 'crisis_volunteer', 'crisis_id', 'volunteer_id')
        ->withPivot('status')
        ->withTimestamps();
    }

    public function expenses(){
        
    return $this->hasMany(Expense::class, 'crisis_id');
    }
               

}
