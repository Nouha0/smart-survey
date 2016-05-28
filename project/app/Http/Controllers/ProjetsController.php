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
       
        
       
        $validateur = \Validator::make($request->all(),[
                       'nom'=>'required',
                       'nombre_max'=> 'required|integer',
         ]);
         if($validateur->fails()){
             return redirect()->back()->withErrors($validateur->errors());
         }else{
            $projet->save();
            $projet->clients()->attach($request->clients);
            $projet->enqueteurs()->attach($request->enqueteurs);
            $projet->administrateurs()->attach($request->administrateurs);
            return view('formulaire', compact('projet'));
         }
    }

    /*
     *Dupliquer un projet 
     */
    public function dupliquer($id) {
        $projet = new Projet();
        
        $old = Projet::findOrFail($id);
        
        $projet->nom = $old->nom;
        $projet->projet_start = $old->projet_start;
        $projet->projet_end = $old->projet_end;
        $projet->nombre_max = $old->nombre_max;
        $projet->projet_html = $old->projet_html;
        $projet->list_champs = $old->list_champs;
        $projet->libelles = $old->libelles;
        $projet->champs_croises = $old->champs_croises;

        $projet->reponses_table ="";
        
        
        $projet->save();
        
        $projet->clients()->attach($old->clients()->get());
        $projet->enqueteurs()->attach($old->enqueteurs()->get());
        $projet->administrateurs()->attach($old->administrateurs()->get());
        
        return redirect(route('edit-projet', $projet->id));
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd($id);
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
        $liste_champs = array();
        
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
        if(!empty($liste_champs)){
            $diff =array_diff($champs,$liste_champs);
        }
        }
        return view('edit-projet', compact(['projet','clients','enqueteurs','administrateurs','liste_champs', 'diff','champs']));
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
        if(!empty($elements)){
            foreach ($elements as $k => $v){
                array_push($table,$k);
            }
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
        $libelles = array();
        $i = 0;
        foreach ($json->fields as $j){
            
            if($j->field_type == "checkboxes" || $j->field_type == "radio" || $j->field_type == "select" ){
                $libelles[$j->field_options->description] = array();
                $champs[$j->field_options->description] = $j->label;
                foreach($j->field_options->options as $opt){
                    //dd($opt);
                   
                 //$libelles[$j->field_options->description] = $opt->label;
                 $libelles[$j->field_options->description][$i] = $opt->label;
                 $i++;
                }
                
            }
           /* 
            }*/
        }
        //dd($libelles);
        //dd();
        return view('build-graph', compact(['projet', 'champs','libelles']));
    }
    
    public function buildGraphPut(Request $request){
        $projet = Projet::findOrFail($request->id);
        //dd($request);
        $elements = $request->names;
        
        $champs = array();
        if(!empty($elements )){
            foreach ($elements as $k=>$v){
                array_push($champs, $k);
            }
        }

        $projet->list_champs = json_encode($champs);
        $projet->champs_croises =$this->requestJson($request->champs_croises);
        $projet->libelles = $this->requestJson($request->libelles);
        
        $projet->update();
        
        return redirect(route('all-projet'));
        
    }
    public function requestJson($json){
        $l = array();
        if(!empty($json)){
            foreach ($json as $key => $value) {
                $l[] = json_decode($value);
            }
        }
        return json_encode($l);
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
        
        $champs = $names= $options =$comparer=array();
        $list_champs = json_decode($projet->list_champs);
        $r = DB::table($reponse)->select()->get();
        $list_compare = json_decode($projet->champs_croises);
        
        //dd($r);

        foreach ($json->fields as $j){
            
            array_push($champs,$j->label);
            array_push($names, $j->field_options->description);   
        }
        
      
        $compare = $this->setValues($this->getKeysCompare($list_compare), $json);
        $options = $this->setValues($list_champs, $json);
        
      
        if(!empty($list_champs)){
        foreach($list_champs as $op){
            foreach($r as $obj){
                if(!empty($obj) && !empty($obj->$op)){
                    $key = $this->phr($obj->$op);
                    
                    if(is_array(json_decode($key, true))){

                        foreach(json_decode($key) as $v){
                            $options[$op][$v] = intval($options[$op][$v])+1;
                        }
                    }
                    else{
                       $options[$op][$key] = intval($options[$op][$key])+1;
                    }
                }
            }
        }
        }
      
      
      /*
      *champs croisés
      */

    //dd($compare);
   
     foreach($list_compare as $comparaison){
          foreach($comparaison as $obj_1 => $obj_2){
            echo ($obj_1 .' '. $obj_2.'<br>');
            foreach($compare[$obj_1] as $k=>$v){
                $comparer[$obj_1.'-'.$obj_2][$k]= $compare[$obj_2]; 
            }
          }
     }
     
     //dd($comparer);
   
     foreach($r as $l){
        foreach($list_compare as $comparaison){
            foreach($comparaison as $obj_1 => $obj_2){
                if(!empty($l->$obj_1) && !empty($l->$obj_2)){
                     if(is_array(json_decode($this->phr($l->$obj_1, true)))){
                         foreach (json_decode($this->phr($l->$obj_1), true) as $table){
                            if(isset($comparer[$obj_1.'-'.$obj_2][$table][$this->phr($l->$obj_2)])){
                                 $comparer[$obj_1.'-'.$obj_2][$table][$this->phr($l->$obj_2)] = intval($comparer[$obj_1.'-'.$obj_2][$table][$this->phr($l->$obj_2)])+1;
                            }
                         }
                     }
                     else{
                        if(isset($comparer[$obj_1.'-'.$obj_2][$this->phr($l->$obj_1)][$this->phr($l->$obj_2)])){
                            $comparer[$obj_1.'-'.$obj_2][$this->phr($l->$obj_1)][$this->phr($l->$obj_2)] = intval($comparer[$obj_1.'-'.$obj_2][$this->phr($l->$obj_1)][$this->phr($l->$obj_2)])+1;
                        }
                     }
                }     
            }
            
        }
     }
     

     /*
     *Libélé sous la forme [0=>['genre'=>Homme, 'chocolat'=>jaime, 'ville'=>Tunis, 'travail'=>oui]]
     * $r $l =                 [genre=>femme, chocolat=>jaime, ville=>tunis, travail=>non]
     */
   
      //$keys = [['nom','genre', 'chocolat'], ['genre', 'chocolat']];
     
      $keys = array();
      $libeles = json_decode($projet->libelles,true);
      $i = $j = 0;
       //dd($libeles);
      if(!empty($libeles)){
        foreach($libeles as $l => $li){
              $keys[] = array_keys($li);
        }
        
        
        $j=1;
        $res_libel = array();
        /*
        //dd($r);
        foreach($r as $l){
            dd($l);
          foreach ($libeles as $index=>$libele) {
              
              foreach ($keys[$index] as $val) {
                  $res_libel = $libele[$val];
                  //dd($res_libel);
                   echo $l->$val.'-'.$libele[$val].' '.$j.' '.count($keys[$index]).'<br>';
                  if($l->$val == $libele[$val] ){ 
                      $j++;
                    if($j == count($keys[$index])){
                            echo $index;
                          if(isset($res_libel[$index]) && !empty( $res_libel[$index])){

                               $res_libel[$index]=intval($res_libel[$index])+1;
                               $j=0;
                          }
                          else {
                              $res_libel[$index]=1;
                              $j=0;
                          }
                          
                      }
                  }
                  elseif(is_array(json_decode($libele[$val], true))){
                      if(in_array($l->$val,json_decode($libele[$val] ))){
                          $j++;
                            if($j == count($keys[$index])){
                                echo $index;
                              if(isset($res_libel[$index]) && !empty( $res_libel[$index])){
                                   $res_libel[$index]=intval($res_libel[$index])+1;
                                   $j=0;
                              }
                              else {
                                  $res_libel[$index]=1;
                                  $j=0;
                              }
                              
                          }
                      }
                  }
              }
              $j=0;
          }


      }
    }
    dd($res_libel);
      * 
      */
        dd($libeles);
        $m = 0;
     foreach ($r as $l ){
         foreach($keys as $k){
             foreach($libeles as $index => $v){
                 foreach($v as $cle => $val){
                     foreach ($k as $c){
                        if($l->$c == $val){
                            $m++;
                        }elseif (is_array($l->$c)) {
                            foreach($l->$c as $value){
                                dd($value);
                            }
                        }
                     }
                 }
             }
         }
     }
     dd($m);
            return view('reponse',  compact(['projet', 'r', 'champs', 'names','options', 'comparer', 'res_libel']));
    
        }
    
    }
    
    
    public function libeles($res_libel, $j, $index, $keys) {
        
        if($j == count($keys[$index])){
              echo $index;
            if(isset($res_libel[$index]) && !empty( $res_libel[$index])){

                 $res_libel[$index]=intval($res_libel[$index])+1;
            }
            else {
                $res_libel[$index]=1;
            }
            $j=0;
        }
        return $res_libel;
    }
    
    
    public function phr($obj){
        return str_replace(" ", "-", $obj);
    }

    public function inverseTab($tab){
        $inverse = array();
        foreach($tab as $k=>$v){
            $inverse[$this->phr($v)] = 0;
        }
        return $inverse;
    }
    
    public function setValues($liste, $json){
       $options = array();
       if(!empty($liste)){ 
            foreach($liste as $ch){
                 foreach ($json->fields as $j){
                     $o = [];

                     if($j->field_options->description == $ch){

                         foreach($j->field_options->options as $opt){
                             $o[$this->phr($opt->label)] = 0;
                         }
                         $options[$ch] = array();
                         $options[$ch]= $o;

                     }
                 }
             }
         }
         return $options;
    }
    
    public function getKeys($objs){
        $cle = array();
        foreach ($objs as $obj){
            foreach ($obj as $v=>$vl){
                $cle[] = $v;
            }
        }
        return $cle ;
    }
    
    public function getKeysCompare($objs){
        $cle = array();
        foreach ($objs as $obj){
            foreach ($obj as $v=>$vl){
                if(!in_array($v, $cle)){
                    $cle[] = $v;
                }
                if(!in_array($vl, $cle)){
                    $cle[] = $vl;
                }
            }
        }
        return $cle ;
    }
}
