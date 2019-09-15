<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /* protected $fillable = [
    'name', 'email', 'password',
    ]; */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files()
    {
        return $this->hasMany('App\File');

    }

    public function folders()
    {
        return $this->hasMany('App\Folder');

    }
    public function isAdmin()
    {
        return $this->role != 'user' ? true : false;
    }
    public function isSuperAdmin()
    {
        return $this->role == 'superadmin' ? true : false;
    }
    public function routeRole()
    {
        return $this->role != 'user' ? 'admin' : 'user/' . $this->id;
    }
    public function photo()
    {
        return $this->pic ? 'storage/' . $this->pic : 'assets\app\images\avatars\0.jpeg';
    }
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \bcrypt($password);
    }
}