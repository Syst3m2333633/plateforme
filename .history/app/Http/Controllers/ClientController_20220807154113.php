<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(15);
        $user = Auth::user();

        if ($user = 'is_admin') {
            return view('client.index', compact('clients'));
        }
    }

    public function profil()
    {
        // $user = User::all();
        $client = Client::where('user_id', 'LIKE', Auth()->user()->id)->first();
        // dd($clients);

        return view('client.edit', compact('client'));
    }

    public function search(Request $request)
    {
        $search_text = $_GET['searchClient'];
        $clients = Client::where('raisonSocial', 'LIKE', '%'.$search_text.'%')
            ->orWhere('name', 'LIKE', '%'.$search_text.'%')
            ->get();

        return view('client.search', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $key = trim($request->get('term'));
        return view('client.create');
    }

    public function trash()
    {
        $clients = Client::onlyTrashed()->get();
        $client = Client::paginate(15);

        return view('client.trash', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $request->validate([
            'raisonSocial' => 'required',
            'adresse' => 'required',
            'complAdresse' => 'required',
            'codePostal' => 'required',
            'ville' => 'required',
            'pays' => 'required',
            'telephone' => 'required',
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $logo = $request->file('avatar');
        $logoName = $logo->getClientOriginalName();
        $logo->move(storage_path('app/'.Str::slug($request->raisonSocial).'/logo'), $logoName);
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        User::insertGetId($user);
        $insert = [
            'raisonSocial' => $request->raisonSocial,
            'slug' => Str::slug($request->raisonSocial),
            'adresse' => $request->adresse,
            'complAdresse' => $request->complAdresse,
            'codePostal' => $request->codePostal,
            'ville' => $request->ville,
            'pays' => $request->pays,
            'telephone' => $request->telephone,
            'name' => $request->name,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar' => $request->avatar->getClientOriginalName(),
            'user_id' => $user()->id->last(),
        ];
        Client::insertGetId($insert);
        //Creation de stockage individuel
        Storage::MakeDirectory(Str::slug($request->raisonSocial).'/logo');
        Storage::MakeDirectory(Str::slug($request->raisonSocial).'/devis');
        Storage::MakeDirectory(Str::slug($request->raisonSocial).'/factures');
        Storage::MakeDirectory(Str::slug($request->raisonSocial).'/event');
        return Redirect::to('client')
            ->with('success', 'Greate ! Client Created Successfully.');
    }

    public function image(Client $client)
    {
        $image = Image::make($client->image);

        return $image->response();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('client.update');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $request->validate([
            'raisonSocial' => 'required',
            'adresse' => 'required',
            'complAdresse' => 'required',
            'codePostal' => 'required',
            'ville' => 'required',
            'pays' => 'required',
            'telephone' => 'required',
            'name' => 'required',
            'firstname' => 'required',
            'email' => 'required',
        ]);

        $client->update(
            $request->all(),
            [
                $client->update(['slug' => Str::slug($request->raisonSocial)]),
            ]
        );

        // $logo = $request->file('avatar');
        // $logoName = $logo->getClientOriginalName();
        // $logo->move(storage_path('app/' . $request->raisonSocial . '/logo'), $logoName);

        return redirect()->route('client.index')
            ->with('success', 'Client Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Client Deleted Successfully');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     *
     * @return \Illuminate\Http\Response
     */
    public function restore(Client $client)
    {
        $toto = $client->restore();

        if ($toto !== null && $toto) {
            return redirect()->route('client.index')
                ->with('success', 'Client Restored Successfully');
        }

        return redirect()->route('client.index')
            ->with('error', 'Client not restored');
    }
}
