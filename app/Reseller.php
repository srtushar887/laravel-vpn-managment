<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Reseller extends Authenticatable
{
    use Notifiable;

    protected $guard = 'reseller';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','name','cradit' ,'password','pass_rep','upline_id','administrator_id','is_block','exp_date', 'password',
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






}
