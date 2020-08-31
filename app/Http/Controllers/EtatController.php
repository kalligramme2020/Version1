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
        $files = $request['photos'];

        if(!empty($files)){

            foreach ($files as $file) {

                $name = time().'.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
                \Image::make($request->get('photos'))->save(public_path('profil/').$name);

                $state = Etat::create([
                    'users_id' => Auth::id(),
                    'description' => $request['description'],
                    'location_id' => $request['location_lier'],
                    'photo' => $name,
                ]);
            }
        }

        return response()->json([
            'message' => 'nouveletat'
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

        return response()->json([
            'message' => 'nouveletat'
        ]);
    }
}
