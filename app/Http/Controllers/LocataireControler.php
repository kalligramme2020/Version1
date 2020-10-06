<?php

namespace App\Http\Controllers;

use App\Events\DeleteEvent;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Locataire;
use Illuminate\Support\Facades\Auth;

class LocataireControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
//        dd($month = date('m'));

        $tenants = Locataire::where('users_id', '=', Auth::id())
                     ->orderBy('created_at','DESC')
                     ->paginate(4);
        return response()->json($tenants);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'nom' => 'required|min:3',
            'cni' => 'required|min:3','email','unique:users',
            'email' => 'required|min:5',
            'phone' => 'required|min:9,max:9'
        ]);


        if ( $request->get('image')) {

            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $filePathname = '/image/'.$name;
            \Image::make($request->get('image'))->save(public_path('image/').$name);

            $store = Locataire::create([
                'users_id' => Auth::id(),
                'nom' => $request['nom'],
                'prenom' => $request['prenom'],
                'email' => $request['email'],
                'numero' => $request['phone'],
                'ville' => $request['ville'],
                'profession' => $request['proff'],
                'cni' => $request['cni'],
                'nationalite' => $request['pays'],
                'photo' => $filePathname,
            ]);


        }
        else {
            $store = Locataire::create([
                'users_id' => Auth::id(),
                'nom' => $request['nom'],
                'prenom' => $request['prenom'],
                'email' => $request['email'],
                'numero' => $request['phone'],
                'ville' => $request['ville'],
                'profession' => $request['proff'],

                'cni' => $request['cni'],
                'nationalite' => $request['pays'],
            ]);


        }


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
        $showtenant = Locataire::find($id);
        return response()->json($showtenant);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editenant = Locataire::find($id);
        return response()->json($editenant);
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

        $tenantUp = Locataire::find($id);

        $this->validate($request,[
            'nom' => 'required|min:3',
            'cni' => 'required|min:3','email','unique:users',
            'email' => 'required|min:5'
        ]);

        if ( $request->get('image')) {

            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $filePathname = '/image/'.$name;
            \Image::make($request->get('image'))->save(public_path('image/').$name);

            $tenantUp->update([
                'nom' => $request['nom'],
                'prenom' => $request['prenom'],
                'email' => $request['email'],
                'numero' => $request['phone'],
                'ville' => $request['ville'],
                'profession' => $request['proff'],
                'cni' => $request['cni'],
                'nationalite' => $request['pays'],
                'photo' => $filePathname,
            ]);

        }
        else{
            $tenantUp->update([
                'nom' => $request['nom'],
                'prenom' => $request['prenom'],
                'email' => $request['email'],
                'numero' => $request['phone'],
                'ville' => $request['ville'],
                'profession' => $request['proff'],
                'cni' => $request['cni'],
                'nationalite' => $request['pays'],
            ]);
        }

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
        $delete = Locataire::with('locations')->find($id);
        if (count($delete->locations))
        {
            foreach ($delete->locations as  $location)
            {
                if (strtotime($location->fin_bail) > strtotime(date("Y-m-d")))
                {
                    return response()->json(405);

                }
                else
                {
                    $events = new DeleteEvent($id);
                    event($events);
                    $delete->delete();
                    return response()->json(200);
                }
            }
        }
        else
        {
            $events = new DeleteEvent($id);
            event($events);
            $delete->delete();
            return response()->json(200);
        }



    }
}
