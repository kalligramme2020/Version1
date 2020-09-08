<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Locataire;
use App\Models\Location;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Paiement::with('location')->where('bailleur' , '=' ,Auth::id())->paginate(2);
        return response()->json($payments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $rentals = Location::all()->where('users_id' , '== ', Auth::id());
        $rentals = Location::with('bien', 'locataire')->get()->where('users_id' ,'==' , Auth::id());
        return response()->json($rentals);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Addinvoice = Paiement::create([
            'bailleur' => Auth::id(),
            'location_id' => $request['location'],
            'locataire' => $request['locataire'],
            'bien' => $request['bien'],
            'debut' => $request['debut'],
            'fin' => $request['fin'],
            'fait_le' => $request['date'],
            'reste' => $request['reste'],
            'avance' => $request['avance'],
            'total' => $request['total'],
            'description' => $request['description'],

        ]);

        return  response()->json([
            'message' => 'facture enregistrée'
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
        $showInvice = Paiement::with('location')->find($id);

        return response()->json($showInvice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $biens = Bien::all()->where('users_id' , '== ', Auth::id());
//        $rentals = Location::all()->where('users_id' , '== ', Auth::id());
//        $tenants = Locataire::all()->where('users_id' , '== ', Auth::id());
        $editinvoice = Paiement::with('location')->find($id);
        return  response()->json($editinvoice);


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
        $upadateInvoice = Paiement::find($id);
        $upadateInvoice->update([
            'bailleur' => Auth::id(),
            'location_id' => $request['location'],
            'locataire' => $request['locataire'],
            'bien' => $request['bien'],
            'debut' => $request['debut'],
            'fin' => $request['fin'],
            'fait_le' => $request['date'],
            'reste' => $request['reste'],
            'avance' => $request['avance'],
            'total' => $request['total'],
            'description' => $request['description'],
        ]);

        response()->json([
            'message' => 'lkfjglfdjlgdjl'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice = Paiement::find($id);
        $invoice->delete();
        return response()->json([
            'messages' => 'supprimer'
        ]);
    }

}
