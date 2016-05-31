<?php
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name','display_name','description'];
    
    public function user(){
        return $this->belongsToMany('App\User');
    }
    
    public function client(){
        return $this->hasOne('App\Client');
    }
    
    public function enqueteur(){
        return $this->hasOne('App\Enqueteur');
    }
    
    public function administrateur(){
        return $this->hasOne('App\Administrateur');
    }
}
?>