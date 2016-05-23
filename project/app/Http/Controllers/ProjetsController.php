<?php

namespace App\Http\Controllers;

use App\Administrateur;
use App\Client;
use App\Enqueteur;
use App\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema as Schema;

use DB ;

class ProjetsController extends Controller
{
    public $colonnes;
    
    public function getColonnes()
    {
        return $this->colonnes;
    }
    public function  setColonnes($c)
    {
        $this->colonnes=$c;
    }  

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
       
        //$projet =$this->createTable('reponse',$request->reponses_table);
        
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
        
        
        $enqueteurs = Enqueteur::lists('nom', 'id');        
        
        $administrateurs = Administrateur::lists('nom', 'id');
        
        $liste_champs = json_decode($projet->list_champs);
        
        $json   = json_decode($projet->projet_html);
        $diff = array();
        $champs =array();
       if(!empty($json)){
            foreach ($json->fields as $j){
                if($j->field_type == "checkboxes" || $j->field_type == "radio" || $j->field_type == "select" ){
                    $champs[$j->field_options->description] = $j->label;
                }
           }
        
        $diff =array_diff($champs,$liste_champs);
        }
        return view('edit-projet', compact(['projet','clients','enqueteurs','administrateurs','liste_champs', 'diff']));
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
        $projet = Projet::findOrFail($id);
        
        $elements = $request->list_champs;
        
        $table= array();
        
        foreach ($elements as $k => $v){
            array_push($table,$k);
        }
        
        $projet->nom = $request->nom;
        
        $projet->nombre_max = $request->nombre_max;
        
        $projet->list_champs = json_encode($table);
        
        $projet->clients()->sync($request->clients);
        
        $projet->enqueteurs()->sync($request->enqueteurs);
        
        $projet->administrateurs()->sync($request->administrateurs);
        
        $projet->update();
         
        return redirect()->back();
    }
    
    public function deleteLiaison($id,$id2){
         
       $projet = Projet::find($id); 
       
       $projet->clients()->detach([$id2]);
     
       $projet->enqueteurs()->detach([$id2]);

       $projet->administrateurs()->detach([$id2]);
        
        
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
 
        $projet= Projet::find($id);
        
        $projet->projet_html = $request->projet_html;
        
        $data = json_decode($request->projet_html);
        //dd($data);
        $description=array();
        
        foreach($data as $d){
            foreach ($d as $des){
                
                if(isset($des->field_options->description) && !empty($des->field_options->description)){
                    array_push($description,$des->field_options->description);
                    
                }else {
                    array_push($description,str_replace(' ','_',$des->label));
                    $des->field_options->description = str_replace(' ','_',$des->label);
                }
            }
            
        }
        $projet->projet_html = json_encode($data);
        
        $this->setColonnes($description);
        
        $reponse = $this->createTable("reponse_".$projet->id);
        
        $projet->reponses_table = $reponse;
        
        $projet->update();
       
        return redirect(route('build-graph',$projet->id));
    }
    
    public function buildGraph($id){
        $projet = Projet::findOrFail($id);
        $json   = json_decode($projet->projet_html);
        $id = $projet->id;
        $champs =array();
        
        foreach ($json->fields as $j){
            if($j->field_type == "checkboxes" || $j->field_type == "radio" || $j->field_type == "select" ){
                $champs[$j->field_options->description] = $j->label;
            }
        }
        return view('build-graph', compact(['projet', 'champs']));
    }
    
    public function buildGraphPut(Request $request){
        $projet = Projet::findOrFail($request->id);
        $elements = $request->names;
        
        $champs = array();
        foreach ($elements as $k=>$v){
            array_push($champs, $k);
        }
        
        $projet->list_champs = json_encode($champs);
        
        $projet->update();
        
        return redirect(route('all-projet'));
        
    }

        public function createTable($table_nom){
        
       
        if (Schema::hasTable($table_nom)) 
        {
            Schema::drop($table_nom);
            
        }
       else {
           Schema::create($table_nom,function ($table) {
            $table->increments('id');
            
            foreach ($this->getColonnes() as $c ){
                $table->text($c)->nullable();  
            }
            $table->timestamps();
        });
        }
        return $table_nom;
    }
    
    public function affiche(){
        $projets = Projet::all();
        $clients = Client::lists('nom', 'id');
        $enqueteurs = Enqueteur::lists('nom','id');
        $administrateurs = Administrateur::lists('nom','id');
        foreach($projets as $projet){
            
            if(!empty($projet->reponses_table) && Schema::hasTable($projet->reponses_table)){
                $projet->reponses = DB::table($projet->reponses_table)->count();
            }
        }
        //dd($projets);
        return view('all-projet', compact(['projets', 'clients','enqueteurs','administrateurs','nb_reponses']));
        
    }
    
    public function VoirReponse($id){
        
        $projet = Projet::findOrFail($id);
        
        $reponse = $projet->reponses_table;
        $json = json_decode($projet->projet_html);
        
        $champs = $names= $options =array();
        $list_champs = json_decode($projet->list_champs);
        
        $r = DB::table($reponse)->select()->get();
        
        foreach ($json->fields as $j){
            
            array_push($champs,$j->label);
            array_push($names, $j->field_options->description);   
        }
       
       foreach($list_champs as $ch){
            foreach ($json->fields as $j){
                $o = [];
                
                if($j->field_options->description == $ch){
                    
                    foreach($j->field_options->options as $opt){
                        $o[$opt->label] = 0;
                    }
                    $options[$ch] = array();
                    $options[$ch]= $o;
                }
            }
        }
        
        foreach($list_champs as $op){
            foreach($r as $obj){
               $options[$op][$obj->$op] = intval($options[$op][$obj->$op])+1;
            }
        }
        
        
         
        return view('reponse',  compact(['r', 'champs', 'names','options']));
    }
    
    
    
    

}
