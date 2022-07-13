<?php

namespace App\Http\Controllers;

use Bouncer;
use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

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

    public function search(Request $request)
    {
        $search_text = $_GET['searchClient'];
        $clients = Client::where('raisonSocial', 'LIKE', '%' . $search_text. '%')
                        ->orWhere('name', 'LIKE', '%' . $search_text. '%')
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
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        // Storage::MakeDirectory($request->raisonSocial . '/logo');
        // Storage::MakeDirectory($request->raisonSocial . '/devis');
        // Storage::MakeDirectory($request->raisonSocial . '/factures');
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
            // 'avatar' => 'required',//|mimes:jpeg,png,jpg,gif,svg|max:1024
        ]);
        $logo = $request->file('avatar');
        $logoName = $logo->getClientOriginalName();
        $logo->move(storage_path('app/' . $request->raisonSocial . '/logo'), $logoName);

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
        ];

        Client::insertGetId($insert);

        return Redirect::to('client')
       ->with('success','Greate! posts created successfully.');

       //Creation de stockage individuel
        Storage::MakeDirectory($request->raisonSocial . '/logo');
        Storage::MakeDirectory($request->raisonSocial . '/devis');
        Storage::MakeDirectory($request->raisonSocial . '/factures');

        return Redirect::to('client')
        ->with('success', 'Greate ! Client created successfully.');

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
        // $rS = 'raisonSocial';
        // $data = $request->input();
        // $slug = Str::slug($client->raisonSocial);
        $request->validate([
            'raisonSocial' => 'required',
            // $data ['slug'] = str_replace(' ', '-', strtolower($data['raisonSocial'])),
            // 'slug' => Str::slug($request->raisonSocial), //====== 'slug' => str::slug($data['raisonSocial']),
            // 'slug' => Str::slug('raisonSocial'),
            // 'slug' => 'required',
            // 'slug' => $slug,
            'slug' => Str::slug($request->raisonSocial),
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

        $client->update($request->all());

            return redirect()->route('client.index')
                ->with('success', 'Client updated Succssfully');
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
