<?php

namespace App\Http\Controllers;
use App\Events\statutEvent;
use App\Models\Locataire;
use App\Models\Location;
use App\Models\Pays;
use App\Models\Type_bien;
use Illuminate\Http\Request;

class  PaysController extends Controller
{

    public function SearchTenant(){
        if(request('Q') !== null ){
            $searchTenant['data'] = Locataire::where('nom' , 'like', '%'.request('Q'). '%')->get();
            return response()->json($searchTenant);

        }
        else{
            //        $tenants = Locataire::where('users_id', '==', Auth::id())->orderBy('created_at','DESC')->paginate(2);
            $tenants = Locataire::orderBy('created_at','DESC')->paginate(2);
            return response()->json($tenants);
        }
    }


    public function getpays(){
        $pays = Pays::all();
        $tbiens = Type_bien::all();

        return response()->json([
            'land' => $pays ,
            'peol' => $tbiens,
        ]);
    }

    public function statut()
    {

        $statut = Location::all()->where('statut', '=', 1);



        if (!$statut)
            return response()->json([
                'statut' => 'disponible'
            ]);
        else
            return response()->json([
                'statut' => 'Occupeé'
            ]);


    }
}
