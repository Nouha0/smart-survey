<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Administrateur;

use App\Projet;

class AdministrateursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrateurs = Administrateur::all();
        
        $projets = Projet::Lists('nom','id');
        
        return view('administrateur',  compact(['administrateurs','projets']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $administrateur = new Administrateur();
        
        $administrateur->nom = $request->nom;
        $administrateur->mail = $request->mail;
        //$administrateurs->created_by = $request->created_by;
        
        return $administrateur;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $administrateurs = $this->create($request);
        
        $administrateurs->save();
        
        $administrateurs->projets()->attach($request->projets);
        
        //$administrateurs->firstOrCreate(['mail'=> $request->mail]);
        
        
        return redirect(route('affiche-administrateur'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listes = Administrateur::all();
        
        return redirect(route('affiche-administrateur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $administrateur = Administrateur::findOrFail($id);
        
        $projets = Projet::lists('nom','id');
        
        return view('edit-administrateur', compact(['administrateur','projets']));
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
       $administrateur =  Administrateur::findOrFail($id);
       
       $administrateur->nom = $request->nom;
       
       $administrateur->mail = $request->mail;
       
       $administrateur->projets()->sync($request->projets);
       
       $administrateur->update();
       
       return redirect(route('all-admin'));
    }
    
    public function deleteLiaison($id,$id2){
         
       
        Administrateur::find($id)->projets()->detach([$id2]);
         
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
        
       $administrateurs = Administrateur::findOrFail($id);
       
       $administrateurs->delete();
       
       return redirect(route('all-admin'));
    }
    
    public function affiche(){
        
        $administrateurs = Administrateur::all();
        $projets = Projet::lists('nom', 'id');
        
        return view('all-admin', compact(['administrateurs', 'projets']));
        
    }
    
    public function list_form($id){
        $projet = Administrateur::find($id)->projets()->get();
        $enqueteur = Administrateur::find($id);
        return view('list_form',  compact(['projet','Administrateur']));
    }
}
