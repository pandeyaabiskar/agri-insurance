<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    public function projects(){
        return $this->belongsTo('App\Project', 'project_id');
    }
}
