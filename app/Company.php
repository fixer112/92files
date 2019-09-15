<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id');

    }
    public function photo()
    {
        return $this->logo ? 'storage/' . $this->logo : 'assets\app\images\avatars\0.jpeg';
    }
}
