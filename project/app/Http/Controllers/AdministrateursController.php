<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Administrateur;

class AdministrateursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrateurs = Administrateur::all();
        
        return view('administrateur',  compact('administrateurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $administrateur = new Administrateur();
        
        $administrateur->nom = $request->nom;
        $administrateur->mail = $request->mail;
        //$administrateurs->created_by = $request->created_by;
        
        return $administrateur;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $administrateurs = $this->create($request);
        
        //$administrateurs->firstOrCreate(['mail'=> $request->mail]);
        $administrateurs->save();
        
        return redirect(route('affiche-administrateur'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listes = Administrateur::all();
        
        return redirect(route('affiche-administrateur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $administrateur = Administrateur::findOrFail($id);
    
        return view('edit-administrateur', compact(['administrateur']));
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
        Administrateur::where('id',$id)->update(['name'=> $request->name,'mail'=> $request->mail]);
        
        return redirect(route('affiche-administrateur'));
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
        
       $administrateurs = Administrateur::findOrFail($id);
       
       $administrateurs->delete();
       
       return redirect(route('affiche-administrateur'));
    }
}
