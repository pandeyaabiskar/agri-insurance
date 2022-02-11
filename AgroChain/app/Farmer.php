<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $fillable = [
        'farm_name','farm_location', 'farm_contact', 'registration', 'size', 'description'
    ];

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
