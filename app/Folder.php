<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    protected $guarded = [];

    protected $casts = [

        'updated_at' => 'datetime:m-d-Y',
        'created_at' => 'datetime:m-d-Y',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');

    }

    public function admin()
    {
        return $this->belongsTo('App\User', 'admin_id');

    }

    public function files()
    {
        return $this->belongsToMany('App\File');

    }
}