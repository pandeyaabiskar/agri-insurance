<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceApplication extends Model
{
    public function projects(){
        return $this->belongsTo('App\Project', 'project_id');
    }
    public function verifications(){
        return $this->belongsTo('App\InsuranceVerification');
    }

    public function users(){
        return $this->belongsTo('App\User', 'farmer_id');
    }
}
