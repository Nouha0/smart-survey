<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

use App\Enqueteur;
use App\Client;
use App\Administrateur;
use App\Projet;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected function user(){
        $user = \Auth::user();
        return $user;
    }
    
    protected function datebase($date){
        $e = explode('/', $date);
        return $e[2].'-'.$e[1].'-'.$e[0];
    }
    protected function datenormal(){
        $e = explode('-', $date);
        return $e[2].'/'.$e[1].'/'.$e[0];
    }
    static function storeUpload($imgs) {

        $path = base_path('uploads');
        
        //dd($path);
        
        $image = Input::file($imgs);
        
        if (is_array($image)) {

            $names = array();
            $i = 0;
            foreach ($image as $img) {

                $i++;
                if (is_object($img)) {
                    $name = str_replace([' ', 'é', 'è', 'à', '@', 'ù', '&'], ['-'], $img->getClientOriginalName());
                    $filename = time() . controller::generateRandomString(10) . '-' . $i . $name;
                    $img->move($path, $filename);
                    $names[$i] = $filename;
                }
            }
            if (!empty($names)) {
                return json_encode($names);
            } else {
                return null;
            }
        } else {
            if (is_object($image)) {
                $name = str_replace([' ', 'é', 'è', 'à', '@', 'ù', '&'], ['-'], $image->getClientOriginalName());
                $filename = time() . controller::generateRandomString(10) . $name;
                $image->move($path, $filename);
                if (!empty($filename)) {
                    return $filename;
                } else {
                    return null;
                }
            }
        }
    }

    static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function getImages($dir){
        $dir = public_path($dir);
        $list = array();
        if (is_dir($dir)){
          if ($dh = opendir($dir)){
            while (($file = readdir($dh)) !== false){
              array_push($list, $file);
            }
            closedir($dh);
          }
        }
        return $list;
    }
    
    static function getextention($file){
        $e = explode(".", $file);
        return $e[count($e)-1];
    }
    
    static function validateExtention($file, $ext=array()){
        $e = explode(".", $file);
        if(in_array($e[count($e)-1], $ext)){
            return true;
        }
        else {
            return false;
        }
    }
    
    /*
     * $id : l'ID du projet 
     * $id2 : l'ID de la personne reliée
     * $nature : admin / enq / client
     */
    static function InProjet($id,$id2,$nature){
        $projet = Projet::FindOrFail($id);
        
        $list = array();
        
        if($nature == 'admin'){
            $list = $projet->Administrateurs()->get()->lists('id');
        }else if ($nature == 'enq'){
            $list = $projet->Enqueteurs()->get()->lists('id');
        }else if($nature == 'client'){
            $list = $projet->Clients()->get()->lists('id');
        }else{
            dd('erreur');
        }
        
        
        if(in_array($id2,  json_decode(json_encode($list)) )){
                return true;
        }else {
             return false;   
        }
    }
    
}
