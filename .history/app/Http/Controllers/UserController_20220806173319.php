<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = User::all();

        return view('user.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = User::all();
        //$user = new User();

        return view('user.create', compact('clients')); //, compact('clients')
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clients = User::all();
        $user = new User();
        Storage::MakeDirectory($request->name.'/devis');
        Storage::MakeDirectory($request->name.'/factures');

        $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->email = $request->email;
        $user->email_verified_at = timestamps();
        $user->raisonSocial = $request->raisonSocial;
        $user->adresse = $request->adresse;
        $user->complAdresse = $request->complAdresse;
        $user->codePostal = $request->codePostal;
        $user->ville = $request->ville;
        $user->pays = $request->pays;
        $user->telephone = $request->telephone;

        $user->password = Hash::make($request->password);
        $user->save();

        return view('user.create', compact('clients')); //, compact('clients')

        // User::makeDirectory('public/' . $user->name => $request->name);
        // $repo = $request->file('file');
        // $repoName = $repo;
        // $repo->move(storage_path('public/' .$user->name = $request->name), $repoName);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = User::all();

        return view('user.create', compact('clients')); //, compact('clients
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('users')
            ->where('id', $id)
            ->update([
                'raisonSocial' => $request->raisonSocial,
                'adresse' => $request->adresse,
                'codePostal' => $request->codePostal,
                'ville' => $request->ville,
                'pays' => $request->pays,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'name' => $request->name,
                'firstname' => $request->firstname,
            ], ['email', 'password', 'raisonSocial', 'adresse', 'codePostal', 'ville', 'pays', 'telephone', 'name', 'firstname']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
