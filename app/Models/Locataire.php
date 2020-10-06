<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Locataire extends Model
{

    use Notifiable,HasApiTokens;

    protected $table ="locataire";

    protected $fillable = ['nom', 'prenom', 'email','numero', 'photo','cni','ville','nationalite', 'profession', 'users_id'];
    /**
     * @var mixed
     */
    private $email;

    public function user(){
        return $this->belongsTo('App\Models\User','users_id');
    }

    public function biens()
    {
        return $this->belongsToMany('App\Models\Bien', 'location','bien_id','locataire_id')->withTimestamps();
    }

    public function locations()
    {
        return $this->hasMany('App\Models\location', 'locataire_id');
    }

    public function invoces()
    {
        return $this->hasMany('App\Models\Paiement', 'locataire_id');
    }


    public function routeNotificationForMail($notification)
    {
        // Return email address only...
        return $this->email;

    }


}
