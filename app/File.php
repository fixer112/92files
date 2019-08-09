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

    public function folder()
    {
        return $this->belongsTo('App\Folder');

    }

}