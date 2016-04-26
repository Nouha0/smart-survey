<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Enqueteur;
use App\Projet;

class EnqueteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enqueteurs = Enqueteur::all();
        $projets = Projet::Lists('nom','id');
        
        return view('enqueteur',compact(['enqueteurs','projets']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $enqueteur = new Enqueteur();
        
        $enqueteur->nom = $request->nom;
        $enqueteur->mail = $request->mail;
        $enqueteur->photo = Controller::storeUpload('photo');
        //$enqueteurs->created_by = $request->created_by;
        
        return $enqueteur;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $enqueteurs = $this->create($request);
        
        $enqueteurs->save();
        
        $enqueteurs->projets()->attach($request->projets);
        
        return redirect(route('affiche-enqueteur')) ; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listes = Enqueteur::all();
        
        return redirect(route('affiche-project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enqueteurs = Enqueteur::findOrFail($id);
        
        $projets = Projet::Lists('nom','id');
        
        return view('edit-enqueteur', compact(['enqueteurs','projets']));
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
      
        Enqueteur::where('id',$id)->update(['nom'=> $request->nom,'mail'=> $request->mail]);
       
        
         
        Enqueteur::find($id)->projets()->attach([$request->projets]);
        
       
        
       
        return redirect(route('affiche-enqueteur'));
        
    }
    
    public function deleteLiaison($id,$id2){
         
       
        Enqueteur::find($id)->projets()->detach([$id2]);
         
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
        
        $enqueteurs = Enqueteur::findOrFail($id);
        
        $enqueteurs->delete();
        
        return redirect(route('affiche-enqueteur'));
    }
    
    public function html($id){
        
        $enqueteur = Enqueteur::findOrFail($id)->get();
        
        
        $projet = $enqueteur->projet();
        dd($projet);
        $html = $projet[0]->projet_html;
        
       
        $json = json_decode($html);
        
        
        
        return view('html',$json);
                 
    }
}
