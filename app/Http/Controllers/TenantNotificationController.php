<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Notifications\TenantEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantNotificationController extends Controller
{
    //
    public function getTenantsNotify()
    {
        $locations = Location::with('locataire', 'bien')
            ->where('users_id', '=', Auth::id());

        foreach ($locations as $local){
            if ($local->locataire->id == $local->locataire_id && $local->bien->id == $local->bien_id)
                if ( date('Y-m-d') == $local->fin_bail)


                    $message ="Bonjour mr/mde , merci de bien vouloir regler votre
                     loyer avant la date d'expiration qui est dans 3 jour";

                     $local->locataire->notify(new TenantEmailNotification($message))->monthlyOn($local->payment_date, '12:00')();

        }
    }
}
