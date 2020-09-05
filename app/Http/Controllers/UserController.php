<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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

        $updateUser = User::find($id);


        if ( $request->get('file')) {
            $image = $request->get('file');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('file'))->save(public_path('image/').$name);

            $updateUser->update([
                "name" => $request['name'],
                "prenom" => $request['prenom'],
                "email" => $request['email'],
                "ville" => $request['ville'],
                "pays" => $request['pays'],
                "numero" => $request['phone'],
                "cni" => $request['cni'],
                "profil" => $name,
            ]);
        }
        else{

            $updateUser->update([
                "name" => $request['name'],
                "prenom" => $request['prenom'],
                "email" => $request['email'],
                "ville" => $request['ville'],
                "pays" => $request['pays'],
                "numero" => $request['phone'],
                "cni" => $request['cni'],
            ]);
        }

        return response()->json(['message' => "modifier avec succeé"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = User::find(Auth::user()->id);

        Auth::logout();

        if ($user->delete()) {

            return Redirect::route('site-home')->with('global', 'Your account has been deleted!');
        }
//        $account = User::find($id);
//        $account->delete();
        return response()->json(['messsage' => 'vous venez de supprimer votre compte']);
    }
}
