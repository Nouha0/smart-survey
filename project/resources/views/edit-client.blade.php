@extends('Default')

@section('title','Modification clients')

@section('content')
<div class="container">
    <div class="form-group">
        {!! Form::model($clients,['method'=>'PUT','url'=>route('update-client',$clients->id)]) !!}
        <div class="row">
            <div class="col-md-8">
                
                        {!! Form::label('', 'nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                        
                        {!! Form::label('', 'mail') !!}
                        {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
                                
            </div>
            <div class="col-md-4 ">
                {!! Form::file('logo',null,['class'=>'form-control']) !!}
            </div>
        </div>
            <br />
            <button type="submit">modifier</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection