<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Enqueteur;
use App\Projet;
use Illuminate\Support\Facades\Schema as Schema;

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
        
        $enqueteur = Enqueteur::findOrFail($id);
        
        $projets = Projet::lists('nom','id');
        
       
        
        return view('edit-enqueteur', compact(['enqueteur','projets']));
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
        
        $enqueteur = Enqueteur::findOrFail($id);
       
        $enqueteur->nom = $request->nom;
        
        $enqueteur->mail = $request->mail;
        
        $enqueteur->projets()->sync($request->projets);
        
        $enqueteur->update();
        
        return redirect(route('all-enqueteur'));
        
    }
    
    public function deleteLiaison($id,$id2){
         
       
        Enqueteur::findOrFail($id)->projets()->detach([$id2]);
         
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
    
    public function html($id,$id2){
        
        $cond = Controller::InProjet($id2,$id,'enq');
        if($cond){
            $projet = Projet::findOrFail($id2);
            $enqueteur = Enqueteur::findOrFail($id);
            return view('html',  compact('projet', 'enqueteur'));
        } else{
            return abort(503);
        }    
    }
    
    public function affiche(){
        
        $projets = Projet::lists('nom','id');
        $enqueteurs = Enqueteur::all();
        return view('all-enqueteur', compact(['projets','enqueteurs']));
        
    }
    
    public function liste_projet($id){
        $projet = Enqueteur::find($id)->projets()->get();
        $enqueteur = Enqueteur::find($id);
        return view('liste-projet',  compact(['projet','enqueteur']));
    }
    
    public function add_reponse(Request $request, $id, $id2){
        $champs = array();
        
        $projet = Projet::findOrFail($id2);
        
        $html = json_decode($projet->projet_html);
        
        foreach($html as $ch){
            foreach($ch as $c){
               array_push($champs, $c->field_options->description);
            }
        }
        if(Schema::hasTable($projet->reponses_table)){
            $nb_reponses = DB::table($projet->reponses_table)->count();
        
            $nombre_max = $projet->nombre_max;

            if($nb_reponses <= $nombre_max){
                $this->submitAll($request, $projet->reponses_table, $champs );
            }
        }
        return redirect()->back();
    }
    
    public function submitAll($req,  $table, $champs){
        $values = array();
       
        foreach ($champs as $ch){
           $values[$ch] = $req->$ch; 
        }
        
        unset($values['_token']);
        unset($values['json']);
       
        DB::table($table)->insert($values);
        
            
    }
    
}
