@extends('Default')

@section('title','Modification clients')

@section('content')
{!! Form::model($client,['method'=>'PUT','url'=>route('update-client',$client->id)]) !!}
    <div class="col-md-8"> 
        <div class="row">
            <div class="form-group">
                
                 {!! Form::label('', 'nom') !!}
                 {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                               
            </div>
            <div class="form-goup ">
                
                 {!! Form::label('', 'mail') !!}
                 {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
                 
            </div>
             <div class="form-group">
                <label class="control-label"> Projets associées</label>
                {!! Form::select('projets[]',$projets, $client->projets()->lists('projets.id')->toArray(),['class'=>'bg-focus form-control select-2', 'multiple'=>true, 'required'=>true]) !!}
            </div>
        </div>
        <br />
        <button class="btn btn-success" type="submit">modifier</button>    
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="form-group">
                {!! Form::file('logo',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>    
    
{!! Form::close() !!}

@endsection
