<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Facture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(15);
        $factures = Facture::all();

        return view('facture.index', compact('clients', 'factures'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexe()
    {
        // $clients = Client::paginate(15);
        $clients = Client::where('user_id', 'LIKE', Auth()->user()->id)->first();

        $factures = Facture::where('client_id', 'LIKE',DB::Client->id)->first();
        // dd($factures);
        return view('facture.indexe', compact('factures', 'clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facture = Facture::all();
        $users = User::all();
        $clients = Client::all();

        return view('facture.create', compact('users', 'clients', 'facture'));
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
        $document->move(storage_path('app/'.$client->slug.'/factures'), $documentName);

        $facture = new Facture();
        $facture->name = $documentName;
        $facture->client_id = $request->client;
        $facture->save();

        return Redirect::to('facture')
            ->with('success', 'Facture Created Successfully !');
    }

    public function downloadFacture(Request $request, $facture)
    {
        // dd($devis);
        $client = Client::findOrFail($facture);
        $facture = Facture::where('client_id', $facture)->first();
        // dd($devis);
        // $name = Devis::with('client_id', 'id');

        // $path = storage_path('app/bechtelar-bernhard/devis/' . $request->deviName);// valide
        $path = storage_path('app/'.$client->slug.'/factures/'.$facture->name);

        return response()->download($path);
    }
}
