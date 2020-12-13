<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    public function requests(){
        return $this->belongsTo('App\CropRequest');
    }
}
