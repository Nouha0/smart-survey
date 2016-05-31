<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enqueteur extends Model
{
    protected $fillable = ['nom','mail','logo','creer_par'];
    
    public function projets(){
        return $this->belongsToMany('App\Projet');
    }
    
    public function role(){
        return $this->hasOne('App\Role');
    }
    
    public function user(){
        return $this->hasOne('App\User');
    }
}
