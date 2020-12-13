<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueRecord extends Model
{
    public function requests(){
        return $this->belongsTo('App\CropRequest', 'request_id');
    }
    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
