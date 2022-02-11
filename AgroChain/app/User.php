<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','account', 'email', 'password', 'isAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function requests(){
        return $this->belongsTo('App\CropRequest');
    }

    public function issuedCrops(){
        return $this->belongsTo('App\IssueRecord');
    }

    public function projects(){
        return $this->belongsTo('App\Project');
    }

    public function farmers(){
        return $this->belongsTo('App\Farmer');
    }

    public function verifications(){
        return $this->belongsTo('App\InsuranceVerification');
    }

    public function applications(){
        return $this->belongsTo('App\InsuranceApplication');
    }
}
