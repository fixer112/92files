<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
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
    public function company()
    {
        return $this->belongsTo('App\Company');

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