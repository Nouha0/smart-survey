<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $title='Ajout utilisateur';
        $roles = array();
        $role = Role::all();
        foreach ($role as $r) {
            $roles[$r->id] = $r->display_name;
        }
        return view('Users.registerUser',['title'=>$title,'roles'=>$roles]);
        
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pass=bcrypt($request->password);
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$pass;
        //dd($user);
        $roles = Role::lists('id');
        $user->save();
        
     
        foreach($roles as $r){
             $user->roles()->attach($r);
        }
       
        

        return redirect('login');

    }
    public function install(){
        if(Role::count() == 0 || User::count() == 0){
        return view('register');
        } else{
            return redirect('login');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register(){
        
        
    }
    
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
