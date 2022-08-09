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
        // dd($devis);
        // dd($events);
        $client = Client::findOrFail($events);
        $event = Event::where('client_id', $events)->first();
        // dd($devis);
        // $name = Devis::with('client_id', 'id');

        // $path = storage_path('app/bechtelar-bernhard/devis/' . $request->deviName);// valide

        $path = storage_path('app/'.$client->slug.'/event/'.$documentName);

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
        $request->validate([
            // 'client' => 'required',
            'titre' => 'required',
            'message' => 'required',
            'file' => 'required',
        ]);
        $document = $request->file('file');
        $documentName = $document->getClientOriginalName();
        // $client = Client::where('id', $request->client)->first();
        $client = Client::where('user_id', 'LIKE', Auth()->user()->id)->first();
        // dd($client);
        $document->move(storage_path('app/'.$client->slug.'/event'), $documentName);

        $event = new Event();
        $event->name = $documentName;
        $event->titre = $request->titre;
        $event->message = $request->message;
        $event->client_id = $client->id;

        $event->save();

        return Redirect::to('event')
            ->with('success', 'Greate ! event added successfully.');

        // $insert = [
        //     'titre' => $request->titre,
        //     'message' => $request->message,
        //     'path' => $document,
        //     'client_id' => $event->client_id,
        // ];
        // Event::insertGetId($insert);

        // $event = new Event();
        // $event->titre = $request->titre;
        // $event->message = $request->message;
        // $event->path = $document;

        // Event::insetGetId($insert);

        // $event->save();
        // return view('client');//event.create

        // return view('confirm');
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
