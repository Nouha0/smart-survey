@extends('Default')

@section('title','ajouter administrateur')

@section('content')
    <div class="container">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    {!! Form::open(['method'=>'POST','url'=>route('add-administrateur')]) !!}
                        {!! Form::label('', 'Nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                        
                        {!! Form::label('','Mail') !!}
                        {!! Form::text('mail',null,['placeholder'=>'mail', 'class'=>'form-control']) !!}
                        <br />
                        <button type="submit">envoyer</button>
                    {!! Form::close() !!}
                </div>
            </div>
            <ul>
                @foreach($administrateurs as $administrateur)
                <li>
                    <p> nom : {{$administrateur->nom}}</p>
                    <p> mail : {{$administrateur->mail}}</p>
                    <a href="{{route('edit-administrateur', $administrateur->id)}}" class="btn btn-success">modifier</a>
            
                        {!! Form::open(['method'=>'POST','url'=>route('delete-administrateur')])  !!}
                  
                            {!! Form::hidden('id',$administrateur->id) !!} 
                            <button class='droite' type='submit'>supprimer</button>
                  
                        {!! Form::close() !!}
                </li>
                @endforeach
            </ul>
        </div>
        
    </div>
@endsection