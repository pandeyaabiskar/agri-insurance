<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceVerification extends Model
{
    public function applications(){
        return $this->belongsTo('App\InsuranceApplication', 'application_id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'riskmanager_id');
    }

    public function policies(){
        return $this->belongsTo('App\InsurancePolicy');
    }
}
