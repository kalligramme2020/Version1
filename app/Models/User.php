<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','prenom','ville', 'cni', 'pays','profil','numero','google_id'
    ];

    public function locataires()
    {
        return $this->hasMany('App\Models\Locataire', 'users_id');
    }

    public function biens()
    {
        return $this->hasMany('App\Models\Bien', 'users_id');
    }

    public function locations()
    {
        return $this->hasMany('App\Models\Location');
    }


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

    protected $table = 'users';


    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email;

    }
}
