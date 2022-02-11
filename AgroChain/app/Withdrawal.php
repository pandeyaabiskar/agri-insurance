<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    public function projects(){
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function approvals(){
        return $this->belongsTo('App\Approval');
    }
}
