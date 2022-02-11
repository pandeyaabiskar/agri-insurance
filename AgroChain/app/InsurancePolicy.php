<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsurancePolicy extends Model
{
    public function verifications(){
        return $this->belongsTo('App\InsuranceVerification', 'verification_id');
    }
}
