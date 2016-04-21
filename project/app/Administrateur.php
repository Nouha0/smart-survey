<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    protected $fillable = ['nom','mail','creer_par'];
    
    public function projets(){
        return $this->belongsToMany('App\Projet');
    }
}
