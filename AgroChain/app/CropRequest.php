<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CropRequest extends Model
{
    public function crops(){
        return $this->belongsTo('App\Crop', 'crop_id');
    }
    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function issuedCrops(){
        return $this->belongsTo('App\IssueRecord');
    }


}
