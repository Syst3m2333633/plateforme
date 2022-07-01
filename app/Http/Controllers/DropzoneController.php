<?php

namespace App\Http\Controllers;

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
        return view('devis.create', compact('user'));
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request, $name)
    {

        // $request->validate([
        //     'file' => 'required|mimes:pdf,txt,csv,xls,xlxs,doc,docx,jpeg,png|max:2048',
        // ]);
        $users = User::findByName($name);
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(storage_path('public/'. $users .'/devis'), $imageName);

        return response()->json(['success' => $imageName]);
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropfacturesStore(Request $request)
    {

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

        $imageName = $image;//->getClientOriginalName()
        $image->move(storage_path('public/event'), $imageName);
        $event = new Event();
        $event->titre = $request->titre;
        $event->message = $request->message;
        $event->path = $image;

        $event->save();

        return response()->json(['success' => $imageName]);
    }
}
