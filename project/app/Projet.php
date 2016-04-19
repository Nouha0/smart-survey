<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $fillable = ['name','project_start','reponses_table'];
     
    public function clients(){
        return $this->belongsToMany('App\Client');
    }
    
    public function enqueteurs(){
        return $this->belongsToMany('App\Enqueteur');
    }
    
    public function administrateurs(){
        return $this->belongsToMany('App\Administrateur');
    }
}
