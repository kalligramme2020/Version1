<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Locataire;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::with('bien','locataire')
            ->where('users_id', '=', Auth::id())
            ->paginate(2);
//        dd($locations);
        return response()->json($locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locataires = Locataire::all()->where('users_id', '==', Auth::id());
        $biens = Bien::with('pieces', 'tbien')->get()->where('users_id', '==', Auth::id());
        return response()->json([
            'locataires' => $locataires,
            'biens' => $biens
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Addlocation = Location::create([
            'locataire_id' => $request['locataire_id'],
            'users_id' => Auth::id(),
            'bien_id' => $request['bienlouer'],
            'description' => $request['description'],
            'residence1' => $request['residence1'],
            'residence2' => $request['residence2'],
            'loyer_hc' => $request['loyerhc'],
            'loyer_ac' => $request['loyerac'],
            'charge' => $request['charge'],
            'debut_bail' => $request['debutb'],
            'fin_bail' => $request['finb'],
            'activiter' => $request['activite'],
            'type_bail' => $request['typebail'],
            'identifiant' => $request['identifiant'],
            'garantir' => $request['garantir'],
            'payment_date' => $request['paiement_date'],

        ]);

        return response()->json([
           'message'=> 'enregistrement reussit'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showlocation = Location::with('bailler','locataire', 'bien')->find($id);
//        dd($showlocation);
        return response()->json($showlocation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editLocation = Location::with('locataire', 'bien')->find($id);
//        $biens = Bien::all()->where('users_id', '==', Auth::id());
        return response()->json($editLocation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updateLocation = Location::find($id);
        $updateLocation->update([
            'locataire_id' => $request['locataire_id'],
            'users_id' => Auth::id(),
            'bien_id' => $request['bienlouer'],
            'activiter_proprio' => $request['proprioDescription'],
            'activiter_locataire' => $request['locataireDescription'],
            'conditions' => $request['condition'],
            'description' => $request['description'],
            'montant_proprio' => $request['proprio'],
            'montant_locataire' => $request['locataire'],
            'residence1' => $request['residence1'],
            'residence2' => $request['residence2'],
            'loyer_hc' => $request['loyerhc'],
            'loyer_ac' => $request['loyerac'],
            'charge' => $request['charge'],
            'debut_bail' => $request['debutb'],
            'fin_bail' => $request['finb'],
            'activiter' => $request['activite'],
            'type_bail' => $request['typebail'],
            'identifiant' => $request['identifiant'],
            'garantir' => $request['garantir'],
            'payment_date' => $request['paiement_date'],
        ]);

        return response()->json(['messsage' => 'dkljlkjdflkjkldjl']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $location = Location::find($id);
//        $location->etats()->delete();
        $location->paiments()->delete();
        $location->delete();
        return response()->json(['messsage' => 'dkljlkjdflkjkldjl']);
    }


}
