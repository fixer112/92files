<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
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

    public function folders()
    {
        return $this->belongsToMany('App\Folder');

    }

}