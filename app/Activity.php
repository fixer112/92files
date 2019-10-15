<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    protected $casts = [

        'updated_at' => 'datetime:m-d-Y',
        'created_at' => 'datetime:m-d-Y',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');

    }
}
