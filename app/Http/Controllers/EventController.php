<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Client;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $events = Event::all();

        return view('event.index', compact('events', 'clients'));
    }

    public function downloadEvent(Request $request, $events)
    {
        $client = Client::findOrFail($events);
        $event = Event::where('client_id', $events)->first();
        $path = storage_path('app/' . $client->slug . '/event/' . $event->name);
        return response()->download($path);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        $events = Event::all();
        $users = User::all();

        return view('event.create', compact('clients', 'events', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request/*, $event*/)
    {
        //Required fields
        $request->validate([
            'titre' => 'required',
            'message' => 'required',
        ]);
        //Get cLient with user_id
        $client = Client::where('user_id', 'LIKE', Auth()->user()->id)->first();
        //Document management
        if ($request->file != "") {
            $document = $request->file('file'); //Event file
            $documentName = $document->getClientOriginalName(); //Event name
            //Event directory
            $document->move(storage_path('app/' . $client->slug . '/event'), $documentName);
        }
        //Event Creation
        $event = new Event();
        if ($request->file != "") {
            $event->name = $documentName;
        }
        $event->titre = $request->titre;
        $event->message = $request->message;
        $event->client_id = $client->id;
        //Event save
        $event->save();
        //Redirection with message
        return Redirect::to('event')
            ->with('success', 'Greate ! event added successfully.');
    }
}
