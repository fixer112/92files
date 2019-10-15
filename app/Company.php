<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $guarded = [];
    // protected $dateFormat = 'd-m-Y';

    protected $casts = [

        'updated_at' => 'datetime:m-d-Y',
        'created_at' => 'datetime:m-d-Y',
    ];

    public function files()
    {
        return $this->hasMany('App\File');

    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id');

    }
    public function photo()
    {
        return $this->logo ? 'storage/' . $this->logo : 'assets\app\images\avatars\0.jpeg';
    }
}