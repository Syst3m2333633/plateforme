<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Devis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DevisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::where('user_id', 'LIKE', Auth()->user()->id)->first();
        $clients = Client::paginate(15);
        $devis = Devis::all();

        return view('devis.index', compact('clients', 'devis', 'client'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexe()
    {
        $clients = Client::where('user_id', 'LIKE', Auth()->user()->id)->first();
        // $clients = Client::paginate(15);
        // dd($clients);
        $devis = Devis::where('client_id', 'LIKE', Client::where('user_id', 'LIKE', Auth()->user()->id)->first())->first();
        dd($devis);
        return view('devis.indexe', compact('devis', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devi = Devis::all();
        $users = User::all();
        $clients = Client::all();

        return view('devis.create', compact('users', 'clients', 'devi'));
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
        $request->validate([
            'client' => 'required',
        ]);
        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        $client = Client::where('id', $request->client)->first();
        $document->move(storage_path('app/'.$client->slug.'/devis'), $documentName);

        $devis = new Devis();
        $devis->name = $documentName;
        $devis->client_id = $request->client;

        $devis->save();

        return Redirect::to('devis')
            ->with('success', 'Greate ! devis added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devis  $devis
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // $path = storage_path('app/' . $request->user . '/devis/phppwkwkW');
        // return response()->download($path);

        $devis = Devis::where('id', $request->devis)->first();
        // $devis = Devis::findOrFail($devis);
        return view('devis.show', compact('devis'));
    }

    public function downloadDevis(Request $request, $devis)
    {
        // dd($devis);
        $client = Client::findOrFail($devis);
        $devis = Devis::where('client_id', $devis)->first();
        // dd($devis);
        // $name = Devis::with('client_id', 'id');

        // $path = storage_path('app/bechtelar-bernhard/devis/' . $request->deviName);// valide
        $path = storage_path('app/'.$client->slug.'/devis/'.$devis->name);

        return response()->download($path);
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
