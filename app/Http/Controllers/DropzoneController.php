<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DropzoneController extends Controller
{
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        return view('devis.create', compact('user'));
    }

    // /**
    //  * Image Upload Code
    //  *
    //  * @return void
    //  */
    // public function dropzoneStore(Request $request)
    // {
    //     $request->validate([
    //         'client' => 'required',
    //     ]);
    //     $document = $request->file('file');
    //     $documentName = $document->getClientOriginalName();
    //     $client = Client::where('id', $request->client)->first();
    //     $document->move(storage_path('app/' . $client->slug . '/devis'), $documentName);

    //     $devis = new Devis();
    //     $devis->name = $documentName;
    //     $devis->client_id = $request->client;

    //     $devis->save();

    //     return Redirect::to('devis')
    //     ->with('success', 'Greate ! devis added successfully.');
    // }

    public function droplogoStore(Request $request)
    {
        // $clients = Client::all();
        $image = $request->file('avatar');
        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('app/.'.$request->raisonSocial.'/logo'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    // /**
    //  * Image Upload Code
    //  *
    //  * @return void
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'client' => 'required',
    //     ]);
    //     $document = $request->file('file');
    //     $documentName = $document->getClientOriginalName();
    //     $client = Client::where('id', $request->client)->first();
    //     $document->move(storage_path('app/' . $client->slug . '/factures'), $documentName);

    //     $facture = new Facture();
    //     $facture->name = $documentName;
    //     $facture->client_id = $request->client;
    //     $facture->save();

    //     return Redirect::to('facture')
    //     ->with('success', 'Facture Cread Successfully !');
    // }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropeventStore(Request $request)
    {
        // $clients = Client::all();
        $request->validate([
            'titre' => 'required',
            'message' => 'required',
            'client_id' => 'required',
        ]);

        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        $client = Client::where('id', $request->client)->first();
        dd($client);
        $document->move(storage_path('app/'.$client->slug.'/event'), $documentName);
        $event = new Event();
        $event->name = $documentName;
        $event->client_id = $request->client;

        $event->save();

        return Redirect::to('event')
            ->with('success', 'Greate ! Ev3nt Added Successfully.');
        // $client = Client::finOrFail($event);
        // $request->validate([
        //     'titre' => 'required',
        //     'message' => 'required',
        //     'client_id' => 'required',
        // ]);
        // $document = $request->file('file');
        // $documentName = $document->getClientOriginalName();
        // $document->move(storage_path('app/event', $documentName));

        // $insert = [
        //     'titre' => $request->titre,
        //     'message' => $request->message,
        //     'client_id' => $request->client_id,
        // ];
        // Event::insertGetId($insert);
        // dd($client);
        // $image = $request->file('file');

        // $imageName = $image->getClientOriginalName();
        // $image->move(storage_path('public/event'), $imageName);
        // $event = new Event();
        // $event->titre = $request->titre;
        // $event->message = $request->message;
        // $event->path = $image;
        // $event->client_id = Auth()->user()->client;

        // $event->save();

        // return response()->json(['success' => $documentName]);
    }
}
