<?php

namespace App\Http\Controllers;

use App\Events\DeleteEvent;
use App\Events\statutEvent;
use App\Models\Bien;
use App\Models\Piece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date("Y-m-d");

        $biens = Bien::with( 'locations','locataire','tbien','parentid')
            ->where('users_id', '=', Auth::id())

            ->paginate(4);

             return response()->json($biens);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $biens = Bien::with('parentid')->get()
                        ->where('users_id', '==', Auth::id());

        return response()->json($biens);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3',
            'typebien' => 'required',
        ]);
        if ( $request->get('image')) {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $filePathname = '/image/'.$name;
            \Image::make($request->get('image'))->save(public_path('image/').$name);

            $databien = Bien::create([
                'bien_id' => $request['Parent_id'],
                'users_id' => Auth::id(),
                'type_bien_id' => $request['typebien'],
                'name' => $request['name'],
                'pays_id' => $request['pays'],
                'ville' => $request['ville'],
                'region' => $request['region'],
                'surface' => $request['surface'],
                'addresse' => $request['addresse'],
                'description' => $request['description'],
                'photo' => $filePathname,
            ]);
        }else{
            $databien = Bien::create([

                'bien_id' => $request['Parent_id'],
                'users_id' => Auth::id(),
                'type_bien_id' => $request['typebien'],
                'name' => $request['name'],
                'pays_id' => $request['pays'],
                'ville' => $request['ville'],
                'region' => $request['region'],
                'surface' => $request['surface'],
                'addresse' => $request['addresse'],
                'description' => $request['description'],
            ]);

        }

        $datapiece = Piece::create([
            'type_bien_id' => $request['typebien'],
            'chambre' => $request['chambre'],
            'salon'  => $request['salon'],
            'salle_bain'  => $request['bain'],
            'cuisine' => $request['cuisine'],
            'parking' => $request['parking'],
            'appartement' => $request['appartement'],
            'appart_meuble' => $request['appart_meuble'],
            'studio' => $request ['studio'],
            'studio_meuble' => $request['studio_meuble'],
            'magasin' => $request['magasin'],
            'banquet' => $request['banquet'],
        ]);

        $databien->pieces()->attach($datapiece);

        return response()->json(200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $showbien = Bien::with('pieces','tbien','parentid', 'enfantsid')->find($id);
        return response()->json($showbien);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editbien = Bien::with('pieces','tbien','countrie', 'enfantsid','parentid')->find($id);
        return response()->json($editbien);
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
        $updatebien = Bien::find($id);
        $this->validate($request,[
            'name' => 'required|min:3',
            'typebien' => 'required',
        ]);

        if ( $request->get('image')) {
//            $imageName = time() . '.' . $request->file->extension();
//            $request->file->move(public_path('image'), $imageName);
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $filePathname = '/image/'.$name;
            \Image::make($request->get('image'))->save(public_path('image/').$name);

            $updatebien->update([

                'bien_id' => $request['Parent_id'],
                'users_id' => Auth::id(),
                'type_bien_id' => $request['typebien'],
                'name' => $request['name'],
                'pays_id' => $request['pays'],
                'ville' => $request['ville'],
                'region' => $request['region'],
                'surface' => $request['surface'],
                'addresse' => $request['addresse'],
                'description' => $request['description'],
                'photo' => $filePathname,
            ]);
        }else{
            $updatebien->update([

                'bien_id' => $request['Parent_id'],
                'users_id' => Auth::id(),
                'type_bien_id' => $request['typebien'],
                'name' => $request['name'],
                'pays_id' => $request['pays'],
                'ville' => $request['ville'],
                'region' => $request['region'],
                'surface' => $request['surface'],
                'addresse' => $request['addresse'],
                'description' => $request['description'],
            ]);

        }

//        $datapiece->update([
//            'type_bien_id' => $request['typebien'],
//            'chambre' => $request['chambre'],
//            'salon'  => $request['salon'],
//            'salle_bain'  => $request['bain'],
//            'cuisine' => $request['cuisine'],
//            'parking' => $request['parking'],
//            'appartement' => $request['appart'],
//            'appart_meuble' => $request['appart_meuble'],
//            'studio' => $request ['studio'],
//            'studio_meuble' => $request['studio_meuble'],
//            'magasin' => $request['magasin'],
//            'terasse' => $request['terasse'],
//        ]);

//        $updatebien->pieces()->attach($datapiece);

        return response()->json(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Bien::with('enfantsid','locations')->find($id);
            if (count($delete->enfantsid))
            {
                return response()->json(405);

            }
            else
            {
                if ( count($delete->locations) )
                {
                    foreach ($delete->locations as $location)
                    {
                        if (strtotime($location->fin_bail) > strtotime(date("Y-m-d")))
                        {
//                            dd('oui c en cour ');


                        }
                        else
                        {

//                            $delete->pieces()->detach();
//                            $events = new DeleteEvent($delete->id);
//                            event($events);
//                            $delete->delete();
//                            return response()->json(200);
                        }
                    }
                }
                else
                {
                    $delete->pieces()->detach();
                    $events = new DeleteEvent($delete->id);
                    event($events);
                    $delete->delete();
                    return response()->json(200);
                }

            }

    }
}
