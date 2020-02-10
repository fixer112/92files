<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

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

    //protected $dateFormat = 'd/m/Y';
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
        'dob' => 'datetime:m-d-Y',
        'updated_at' => 'datetime:m-d-Y',
        'created_at' => 'datetime:m-d-Y',
    ];

    public function files()
    {
        return $this->hasMany('App\File');

    }

    public function activities()
    {
        return $this->hasMany('App\Activity');

    }

    public function adminFiles()
    {
        return $this->hasMany('App\File', 'admin_id');

    }

    public function folders()
    {
        return $this->hasMany('App\Folder');

    }

    public function adminFolders()
    {
        return $this->hasMany('App\Folder', 'admin_id');

    }
    public function adminCompanies()
    {
        return $this->hasMany('App\Company', 'admin_id');

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
    public function getFullNameAttribute()
    {
        return $this->attributes['fname'] . ' ' . $this->attributes['lname'];
    }
    public function photo()
    {
        return $this->pic ? Storage::url($this->pic) /* '/storage/' . $this->pic */ : '\assets\app\images\avatars\0.jpeg';
    }

    public function legalAge()
    {
        return date('Y') - $this->dob->format('Y') >= 18 ? 'Above 18 years' : 'Below 18 years';
    }
    /* public function setPasswordAttribute($password)
{
$this->attributes['password'] = \bcrypt($password);
} */
}