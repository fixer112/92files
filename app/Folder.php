<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    protected $guarded = [];

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