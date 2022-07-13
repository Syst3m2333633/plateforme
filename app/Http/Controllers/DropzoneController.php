<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
        // $user = User::all();
        // $clients = Client::all();
    return view('devis.create', compact('user'));
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $clients = Client::all();
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('public/devis'), $imageName);
        return response()->json(['success' => $imageName]);
    }

    public function droplogoStore(Request $request)
    {
        // $clients = Client::all();
        $image = $request->file('avatar');
        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('public.'. $request->raisonSocial .'logo'), $imageName);
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
