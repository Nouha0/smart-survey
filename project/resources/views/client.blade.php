@extends('Default')

@section('title','Ajouter clients')

@section('content')

<div class="container">
    {!! Form::open(['method'=>'POST','url'=>route('add-client'),'files'=>true]) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'Nom') !!}
                {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                
            </div>
            <div class="col-md-4 ">
                    {!! Form::file('photo',null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'Mail') !!}
                {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
            </div>
        </div>
        <br />
        <button  type='submit'>envoyer</button>
    </div>
    {!! Form::close()!!}
    
    <ul>
        @foreach($clients as $client)
        <li>
            <p> nom : {{$client->nom}} </p>
            <p> mail : {{$client->mail}} </p>
            <p>logo : {{$client->photo}} </p>
            <a href="{{route('edit-client', $client->id)}}" class="btn btn-success">modifier</a>
            
                {!! Form::open(['method'=>'POST','url'=>route('delete-client')])  !!}
                  
                    {!! Form::hidden('id',$client->id) !!} 
                    <button  type='submit'>supprimer</button>
                {!! Form::close() !!}
        </li>
        @endforeach
    </ul>
</div>
@stop