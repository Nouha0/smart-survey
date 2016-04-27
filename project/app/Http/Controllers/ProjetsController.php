<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Schema as Schema;

use App\Projet;
use App\Client;
use App\Enqueteur;
use App\Administrateur;

class ProjetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = Projet::all();
        $clients = Client::lists('nom', 'id');
        $enqueteurs = Enqueteur::lists('nom','id');
        $administrateurs = Administrateur::lists('nom','id');
        return view('projet', compact(['projets', 'clients','enqueteurs','administrateurs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projet = new Projet();
        
        $projet->nom = $request->nom;
        $projet->projet_start = $request->projet_start;
        $projet->projet_end = $request->projet_end;
        $projet->nombre_max = $request->nombre_max;
        //$projet->reponses_table = $request->reponses_table;
        
        return $projet;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $projet = $this->create($request);
       
        $projet->save();
        $projet->clients()->attach($request->clients);
        $projet->enqueteurs()->attach($request->enqueteurs);
        $projet->administrateurs()->attach($request->administrateurs);
        //$projet = $this->createTable($project->name,$request->reponses_table);
        
        return view('formulaire', compact('projet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet = Projet::findOrFail($id);
        
        return view('formulaire', compact(['projet']));
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
        $tableau1=array();
        $tableau2=array();
        $x = Client::all();
        $y = Enqueteur::all();
        $z = Administrateur::all();
        $projets = Projet::findOrFail($id);
        //clients
        foreach ($projets->clients()->get() as $c)
        {
            $tab[$c->id]=$c->nom;              
        }
        
        $proj_client = $tab;
        
        foreach ($x as $cl)
        {
            $tabl[$cl->id]=$cl->nom;
                      
        }
       
        $clients=$tabl;
        //enqueteur
        foreach ($projets->enqueteurs()->get() as $e)
        {
            $tab[$e->id]=$e->nom;              
        }
        
        $proj_enq = $tab;
        
        foreach ($y as $enq)
        {
            $tabl[$enq->id]=$enq->nom;
                      
        }
       
        $enqueteurs=$tabl;
        //administrateur
        foreach ($projets->administrateurs()->get() as $a)
        {
            $tab[$a->id]=$a->nom;              
        }
        
        $proj_admin = $tab;
        
        foreach ($z as $admin)
        {
            $tabl[$admin->id]=$admin->nom;
                      
        }
       
        $administrateurs=$tabl;
        return view('edit-projet', compact(['projets','clients','proj_client','tableau','proj_enq','enqueteurs','tableau1','proj_admin','administrateurs','tableau2']));
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
        
        Projet::where('id',$id)->update(['nom'=> $request->nom,'nombre_max'=>$request->nombre_max]);
        
        if(isset($request->clients))
         {  
             foreach($request->clients as $client){
              
                  Projet::find($id)->clients()->attach([$client]);
             }
            
         }
         elseif(isset($request->administrateur))
         {  
             foreach($request->administrateur as $administrateur){
              
                  Projet::find($id)->administrateurs()->attach([$administrateur]);
             }
            
         }
         else
         {  
             foreach($request->enqueteurs as $enqueteur){
              
                  Projet::find($id)->enqueteurs()->attach([$enqueteur]);
             }
            
         }
         
        return redirect(route('all-projet'));
    }
    
    public function deleteLiaison($id,$id2){
         
       
       Projet::find($id)->clients()->detach([$id2]);
     
       Projet::find($id)->enqueteurs()->detach([$id2]);

       Projet::find($id)->administrateurs()->detach([$id2]);
        
        
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
        
        $projets = Projet::findOrFail($id);
        
        $projets->delete();
        
        return redirect(route('all-projet'));
    }
    
    public function put (Request $request)
    {
        $id = $request->id;
        //dd($id);
        $projet= Projet::find($id);
        
        $projet->projet_html = $request->projet_html;
        $projet->update();
        
        return redirect()->back();
    }
    



    public function createTable($table_nom,$champs=array() ){
        
        Schema::create($table_nom, function ($table) {
            $table->increments('id');
            foreach($champs as $ch){
                $table->text($ch)->nullable();  
            }
            $table->timestamps();
        });
    }
    
    public function affiche(){
        
        $projets = Projet::all();
        $clients = Client::lists('nom', 'id');
        $enqueteurs = Enqueteur::lists('nom','id');
        $administrateurs = Administrateur::lists('nom','id');
        return view('all-projet', compact(['projets', 'clients','enqueteurs','administrateurs']));
        
    }
    
    

}
