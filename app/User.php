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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class,'id','upline_id');
    }

    public function administrator()
    {
        return $this->hasOne(sub_administrator::class,'id','administrator_id');
    }

    public function reseller()
    {
        return $this->hasOne(Reseller::class,'id','reseller_id');
    }

    public function sureseller()
    {
        return $this->hasOne(Subreseller::class,'id','subreseller_id');
    }

}
