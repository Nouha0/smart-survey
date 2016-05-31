<?php
namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'email', 'password',
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function roles(){
        return $this->hasOne('App\Role');
    }
    
    public function client(){
        return $this->hasOne('App\Client');
    }
    
    public function administrateur(){
        return $this->hasOne('App\Administrateur');
    }
    
    public function enqueteur(){
        return $this->hasOne('App\Enqueteur');
    }
}