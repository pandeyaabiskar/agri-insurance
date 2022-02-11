<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    public function withdrawals(){
        return $this->belongsTo('App\Withdrawal', 'withdrawal_id');
    }
}
