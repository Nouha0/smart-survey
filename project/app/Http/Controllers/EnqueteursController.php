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
        $tab=array();
        $tabl = array();
        $tableau=array();
        $x=Projet::all();
        $enqueteurs = Enqueteur::findOrFail($id);
        
        foreach ($enqueteurs->projets()->get() as $p)
        {
            $tab[$p->id]=$p->nom;              
        }
        
        $enq_proj = $tab;
        
        foreach ($x as $pr)
        {
            $tabl[$pr->id]=$pr->nom;
                      
        }
       
        $projets=$tabl;
        
        return view('edit-enqueteur', compact(['enqueteurs','projets','enq_proj','tableau']));
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
        
        $en=Enqueteur::where('id',$id)->update(['nom'=> $request->nom,'mail'=> $request->mail]);
       
        
        
         if(isset($request->projets))
         {  
             foreach($request->projets as $projet){
              
                  Enqueteur::find($id)->projets()->attach([$projet]);
             }
            
         }
        
       
        return redirect(route('all-enqueteur'));
        
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
        
        return redirect(route('all-enqueteur'));
    }
    
    public function html($id){
        
        $projet = Projet::findOrFail($id);
        
        
        
        
        $html = $projet->projet_html;
        
       
        $json = json_decode($html);
       
       
        
        return view('html',  compact('json','html'));
                 
    }
    
    public function affiche(){
        
        $projets = Projet::lists('nom','id');
        $enqueteurs = Enqueteur::all();
        return view('all-enqueteur', compact(['projets','enqueteurs']));
        
    }
    
    public function liste_projet($id){
        $projet = Enqueteur::find($id)->projets()->get();
        
        return view('liste-projet',  compact(['projet']));
    }
}
