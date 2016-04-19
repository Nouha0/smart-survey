<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nom','mail','photo','creer_par'];
    
    public function projets(){
        return $this->belongsToMany('App\Projet');
    }
}
