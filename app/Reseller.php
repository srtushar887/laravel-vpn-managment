<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    public function admin()
    {
        return $this->hasOne(Admin::class,'id','upline_id');
    }
}
