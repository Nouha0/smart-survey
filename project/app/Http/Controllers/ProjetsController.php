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
        $projet = Projet::findOrFail($id);
        
        $clients = Client::lists('nom', 'id');
        $enqueteurs = Enqueteur::lists('nom','id');
        $administrateurs = Administrateur::lists('nom','id');
        
        return view('edit-projet', compact(['projet','clients','enqueteurs','administrateurs']));
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
        
        //Projet::find($id)->enqueteurs()->updateExistingPivot($enqueteurs->id, ['nom'=>$request->enqueteur]);
        //Projet::find($id)->clients()->updateExistingPivot($clients->id, ['nom'=>$request->client]);
        //Projet::find($id)->administrateurs()->updateExistingPivot($administrateurs->id, ['nom'=>$request->administrateur]);
        
        return redirect(route('all-projet'));
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
        
        return redirect(route('affiche-projet'));
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
