<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EtatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $states = Etat::all()->where('users_id', '==', Auth::id());
        foreach ($states as $data){

            $data->photo = json_decode($data->photo);
        }

        return response()->json($states);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::all()->where('users_id', '==', Auth::id());
        return response()->json($locations);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $pictures = [];
            foreach( $request->file('file') as $files ){

                $filename = '/image/'.$files->getClientOriginalName();
                $files->move(public_path('image'),$filename);
                $pictures[] = $filename;
            }

        $desc = $request['description'];
        $local = $request['location'];

            $tore = Etat::create([

                'description' => $desc,
                    'location_id' =>$local,
                    'users_id' => Auth::id(),
                  'photo' => json_encode($pictures),
            ]);

            return response()->json(['message' => 'hfhfkshfhsjkhks']);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etat = Etat::find($id);
        $etat->delete();
        return response()->json([
            'message' => 'supprimer'
        ]);
    }
}
