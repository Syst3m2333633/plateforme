<?php

namespace App\Http\Controllers;

use Bouncer;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;

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
        return view('client.index', compact('clients'));
    }

    public function searchClient(Request $request, Client $client)
    {
        $clients = Client::search($client)->get();
        return $clients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        Storage::MakeDirectory($request->raisonSocial . '/logo');
        Storage::MakeDirectory($request->raisonSocial . '/devis');
        Storage::MakeDirectory($request->raisonSocial . '/factures');
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

        $insert = [
            'raisonSocial' => $request->raisonSocial,
            'slug' => Str::slug($request->raisonSocial),/*[SlugService::createSlug(Client::class, 'slug', $request->raisonSocial)]*/
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
        ];

        Client::insertGetId($insert);

        return Redirect::to('client')
       ->with('success','Greate! posts created successfully.');


        // $data = $request->validate();
        // $client = new Client();
        // $clients = Client::all();

        //Creation de stockage individuel
        Storage::MakeDirectory($request->raisonSocial . '/logo');
        Storage::MakeDirectory($request->raisonSocial . '/devis');
        Storage::MakeDirectory($request->raisonSocial . '/factures');

        // $client->raisonSocial = $data['raisonSocial'];
        // $client->slug = Str::slug($data['slug']);
        // $client->adresse = $data['adresse'];
        // $client->complAdresse = $data['complAdresse'];
        // $client->codePostal = $data['codePostal'];
        // $client->ville = $data['ville'];
        // $client->pays = $data['pays'];
        // $client->telephone = $data['telephone'];
        // $client->name = $data['name'];
        // $client->firstname = $data['firstname'];
        // $client->email = $data['email'];

        // //PASSWORD
        // $client->password = Hash::make($request->password);

        // //SAVE
        // $client->save();

        return Redirect::to('client')
        ->with('success', 'Greate ! Client created successfully.');

    }

    public function addClient()
    {
        $client = Client::insert([
            "raisonSocial" => "Airbus",
            "adresse" => "51 rue de la soif",
            "complAdresse" => "3 eme bar à droite",
            "codePostal" => "35000",
            "ville" => "Rennes",
            "pays" => "France",
            "telephone" => "0102030405",
            "name" => "subria",
            "firstname" => "plane",
            "email" => "airbus@boeing.fr",
            "password" => Hash::make("wiklog1234"),
            "path" => "https://via.placeholder.com/640x480.png/00bb66?text=aliquam",

        ]);
        dd($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $clients = Client::all();
        return view('client.show', compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());

            return redirect()->route('client.index')
                ->with('success', 'Client updated Succssfully');


        // DB::table('client')
        //     ->where('id', $id)
        //     ->update([
        //         'raisonSocial' => $request->raisonSocial,
        //         'adresse' => $request->adresse,
        //         'complAdresse' => $request->complAdresse,
        //         'codePostal' => $request->codePostal,
        //         'ville' => $request->ville,
        //         'pays' => $request->pays,
        //         'telephone' => $request->telephone,
        //         'name' => $request->name,
        //         'firstname' => $request->firstname,
        //         'email' => $request->email,
        //         'password' => $request->password,
        //     ], ['raisonSocial', 'adresse', 'complAdresse', 'codePostal',
        //         'ville', 'pays', 'telephone', 'name', 'firstname', 'email', 'password']);

            // $request->validate([
            //     'raisonSocial' => 'required',
            //     'adresse' => 'required',
            //     'complAdresse' => 'required',
            //     'codePostal' => 'required',
            //     'ville' => 'required',
            //     'pays' => 'required',
            //     'telephone' => 'required',
            //     'name' => 'required',
            //     'firstname' => 'required',
            //     'email' => 'required',
            // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }

     /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function restore(Client $client)
    {
        $toto = $client->restore();

        if ($toto != Null && $toto )
        {
        return redirect()->route('client.index')
            ->with('success', 'Client restored successfully');
        }else {
            return redirect()->route('client.index')
            ->with('error', 'Client not restored');
         }
    }
}
