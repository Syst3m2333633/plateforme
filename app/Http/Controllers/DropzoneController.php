<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Devis;
use App\Models\Event;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

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

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        // dd($request);
        $request->validate([
            'client' => 'required',
        ]);

        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        $client = Client::where('id', $request->client)->first();
        $document->move(storage_path('app/' . $client->slug . '/devis'), $documentName);

        $devis = new Devis();
        $devis->name = $documentName;
        $devis->client_id = $request->client;

        $devis->save();

        return Redirect::to('devis')
        ->with('success', 'Greate ! Devis Added Successfully.');
    }

    public function droplogoStore(Request $request)
    {
        // $clients = Client::all();
        $image = $request->file('avatar');
        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('app/.'. $request->raisonSocial .'/logo'), $imageName);
        return response()->json(['success' => $imageName]);
    }



    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropfacturesStore(Request $request)
    {
        $clients = Client::all();

        $image = $request->file('file');

        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('public/factures'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropeventStore(Request $request)
    {

        $image = $request->file('file');

        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('public/event'), $imageName);
        $event = new Event();
        $event->titre = $request->titre;
        $event->message = $request->message;
        $event->path = $image;

        $event->save();

        return response()->json(['success' => $imageName]);
    }
}
