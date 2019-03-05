<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class sub_administrator extends Authenticatable
{
    use Notifiable;

    protected $guard = 'administrator';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_name' ,'email','cradit','upline_id','exp_date','is_exp','is_active','profile_image' ,'password',
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


}
