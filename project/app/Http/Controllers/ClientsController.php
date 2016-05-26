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
        $client->photo = url('https://gravatar.com/avatar/');
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
        
        
       
        //$client->firstOrCreate(['mail'=> $request->mail]);
        $validateur = \Validator::make($request->all(),[
                       'nom'=>'required',
                       'mail'=> 'required|email|max:255'
         ]);
         if($validateur->fails()){
             return redirect()->back()->withErrors($validateur->errors());
         }else{
             $client->save();
        
             $client->projets()->attach($request->projets);
            return redirect(route('affiche-client'));
         }
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
       
        $client = Client::findOrFail($id);
        
        $projets = Projet::lists('nom', 'id');
        
        $photo = Controller::getImages($client->photo);
        
        return view('edit-client', compact(['client','projets','photo']));
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
        $client = Client::findOrFail($id);
        
        $client->nom = $request->nom;
        
        $client->mail = $request->mail;
        
        $client->photo = Controller::storeUpload('photo');
        
        $client->projets()->sync($request->projets);
        
         $validateur = \Validator::make($request->all(),[
                       'nom'=>'required',
                       'mail'=> 'required|email|max:255'
         ]);
         if($validateur->fails()){
             return redirect()->back()->withErrors($validateur->errors());
         }else{
        
                $client->update();
        
                return redirect(route('all-client')); 
         }
    }
    
    public function deleteLiaison($id,$id2){
         
       
        Client::find($id)->projets()->detach([$id2]);
         
        return 'true';
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
        
        return redirect(route('all-client'));
    }
    
    public function affiche(){
        
       
        $clients = Client::all();
        $projets = Projet::Lists('nom','id');
        
        return view('all-client', compact(['clients','projets']));
    }
    
    public function list_p($id){
        $client = Client::findOrFail($id);
        $projets = $client->projets()->get();
        
        return view('list_p',  compact(['client','projets']));
    }
}
