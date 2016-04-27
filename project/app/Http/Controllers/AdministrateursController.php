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
         $tab=array();
        $tabl = array();
        $tableau=array();
        $x=Projet::all();
        $administrateurs = Administrateur::findOrFail($id);
        
        foreach ($administrateurs->projets()->get() as $p)
        {
            $tab[$p->id]=$p->nom;              
        }
        
        $adm_proj = $tab;
        
        foreach ($x as $pr)
        {
            $tabl[$pr->id]=$pr->nom;
                      
        }
       
        $projets=$tabl;
        
        return view('edit-administrateur', compact(['administrateurs','projets','adm_proj','tableau']));
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
        Administrateur::where('id',$id)->update(['nom'=> $request->nom,'mail'=> $request->mail]);
        
        if(isset($request->projets))
         {  
             foreach($request->projets as $projet){
              
                  Administrateur::find($id)->projets()->attach([$projet]);
             }
            
         }
        
        return redirect(route('all-administrateur'));
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
       
       return redirect(route('all-administrateur'));
    }
    
    public function affiche(){
        
        $administrateurs = Administrateur::all();
        $projets = Projet::lists('nom', 'id');
        
        return view('all-admin', compact(['administrateurs', 'projets']));
        
    }
}
