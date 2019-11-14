<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'super_admin', 'active', 'team_id', 'role_id', 'membership_id', 'membership_started', 'membership_expired', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function profile() {

        return $this->hasOne('App\Profile');

    }

    public function account() {

        return $this->hasOne('App\Account');

    }

    public function team() {

        return $this->hasOne('App\Team');

    }

    public function role(){

        return $this->belongsTo('App\Role');
        
    }

    public function membership(){

        return $this->belongsTo('App\Membership');
        
    }

    public function clients(){

        return $this->hasMany('App\Client');

    }

    public function inventory(){

        return $this->hasMany('App\Inventory');

    }

    public function tax(){

        return $this->hasMany('App\Tax');

    }
}
