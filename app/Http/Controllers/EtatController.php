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

        $states = Etat::with('location')->get()->where('users_id', '==', Auth::id());
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
        $locations = Location::with('bien')->get()->where('users_id', '==', Auth::id());
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


        if($request->file('files') !== null ){
            $pictures = [];

            foreach( $request->file('files') as $files ){

                $filename = '/image/'.$files->getClientOriginalName();
                $files->move(public_path('image'),$filename);
                $pictures[] = $filename;
            }


            $tore = Etat::create([

                'description' => $request['description'],
                'location_id' =>$request['location_lier'],
                'users_id' => Auth::id(),
                'photo' => json_encode($pictures),
            ]);

        }else{

            $tore = Etat::create([

                'description' => $request['description'],
                'location_id' =>$request['location_lier'],
                'users_id' => Auth::id(),
                // 'photo' => json_encode($pictures),
            ]);

        }

        return response()->json(['message' => 'succeé']);



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
