<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Enqueteur;

class EnqueteursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enqueteurs = Enqueteur::all();
        
        return view('enqueteur',compact(['enqueteurs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $enqueteur = new Enqueteur();
        
        $enqueteur->nom = $request->nom;
        $enqueteur->mail = $request->mail;
        $enqueteur->photo = Controller::storeUpload('photo');
        //$enqueteurs->created_by = $request->created_by;
        
        return $enqueteur;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $enqueteurs = $this->create($request);
        
        $enqueteurs->save();
     
        
        return redirect(route('affiche-enqueteur')) ; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listes = Enqueteur::all();
        
        return redirect(route('affiche-project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enqueteurs = Enqueteur::findOrFail($id);
        
        return view('edit-enqueteur', compact(['enqueteurs']));
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
        Enqueteur::where('id',$id)->update(['nom'=> $request->nom,'mail'=> $request->mail]);
        
        return redirect(route('affiche-enqueteur'));
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
        
        $enqueteurs = Enqueteur::findOrFail($id);
        
        $enqueteurs->delete();
        
        return redirect(route('affiche-enqueteur'));
    }
}
