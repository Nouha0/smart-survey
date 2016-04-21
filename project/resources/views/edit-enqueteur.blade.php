@extends('Default')

@section('title','Editer')

@section('content')

    <div class="container">
        <div class="form-group">
            {!! Form::model($enqueteurs, ['method'=>'PUT','url'=>route('update-enqueteur',$enqueteurs->id)])  !!}
            <div class="row">
                <div class="col-md-8">
                    
                    {!! Form::label('', 'nom') !!}
                    {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}

                    {!! Form::label('', 'mail') !!}
                    {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
                    
                    {!! Form::label('', 'Projets') !!}
                    {!! Form::select('projets[]',$projets,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

                </div>
                <div class="col-md-4">
                    {!! Form::file('photo',null,['placeholder'=>'browse','class'=>'form-control']) !!}
                </div>
            </div>
                <br/>
                <button class="btn btn-success " type='submit'>modifier</button>            
            {!!  Form::close() !!}
        </div>
    </div>

@stop