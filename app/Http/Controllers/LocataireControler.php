<?php

namespace App\Http\Controllers;

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

    private function refresh(){
        $tenants = Locataire::all()->where('users_id', '==', Auth::id());
        return response()->json( $tenants );
    }

    public function index()
    {
                $tenants = Locataire::where('users_id', '=', Auth::id())
                    ->orderBy('created_at','DESC')
                    ->paginate(2);

            return response()->json($tenants);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
//            $imageName = time() . '.' . $request->file->extension();
//            $request->file->move(public_path('image'), $imageName);
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
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
                'photo' => $name,
            ]);
        }else {
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

       return response()->json([
           'messages' => 'le locataire a eté crééer avec succé',
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
//            $imageName = time() . '.' . $request->file->extension();
//            $request->file->move(public_path('image'), $imageName);
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
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
                'photo' => $name,
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

        return response()->json([
            'messages' => 'le locataire a eté modifier avec succé',

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
        $tenant = Locataire::find($id);
        $tenant->delete();
        return $this->refresh();
    }
}
