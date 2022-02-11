<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function users(){
        return $this->belongsTo('App\User', 'farmer_id');
    }

    public function contributions(){
        return $this->belongsTo('App\Contribution');
    }

    public function withdrawals(){
        return $this->belongsTo('App\Withdrawal');
    }

    public function insurances(){
        return $this->belongsTo('App\InsuranceApplication');
    }
}
