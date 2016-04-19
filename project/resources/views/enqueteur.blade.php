@extends('Default')

@section('title','Ajouter enqueteur')

@section('content')
<div class="container">
    {!! Form::open(['method'=>'POST','url'=>route('add-enqueteur'),'files'=>true]) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'nom') !!}
                {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control']) !!}
            </div>
         
            <div class="col-md-4">
                {!! Form::file('photo', null,['placeholder'=>'browse', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'mail') !!}
                {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <br />
    <button  type='submit'>envoyer</button>
    {!!  Form::close() !!}
    
    <ul>
        @foreach($enqueteurs as $enqueteur)
        <li>
            <p>nom :{{$enqueteur->nom}}</p>
            <p>mail :{{$enqueteur->mail}}</p>
            <p>photo :{{$enqueteur->photo}}</p>
            <a href="{{route('edit-enqueteur', $enqueteur->id)}}" class="btn btn-success">modifier</a>
            
            {!! Form::open(['method'=>'POST','url'=>route('delete-enqueteur')])  !!}
                  
                  {!! Form::hidden('id',$enqueteur->id) !!} 
                  <button class='droite' type='submit'>supprimer</button>
                  
            {!! Form::close() !!}
        </li>
        @endforeach
    </ul>
</div>
@stop