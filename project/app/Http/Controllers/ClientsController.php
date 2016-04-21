<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Client;
use App\Projet;

class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $projets = Projet::Lists('nom','id');
        
        return view('client', compact(['clients','projets']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $client = new Client();
        
        $client->nom = $request->nom;
        $client->mail = $request->mail;
        $client->photo = Controller::storeUpload('photo');
        //$client->created_by = $request->created_by;
        
        return $client;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $client = $this->create($request);
        
        $client->save();
        
        $client->projets()->attach($request->projets);
       
        //$client->firstOrCreate(['mail'=> $request->mail]);
       
        
        return redirect(route('affiche-client'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listes = Client::all();
        
        return redirect(route('affiche-client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clients = Client::findOrFail($id);
        
        return view('edit-client', compact(['clients']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        client::where('id',$id)->update(['nom'=> $request->nom,'mail'=> $request->mail]);
        
        return redirect(route('affiche-client')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        
        $clients = Client::findOrFail($id);
        
        $clients->delete();
        
        return redirect(route('affiche-client'));
    }
}
