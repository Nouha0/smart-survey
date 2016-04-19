@extends('Default')

@section('title','Modification admin')

@section('content')
<div class="container">
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::model($administrateur,['method'=>'PUT','url'=>route('update-administrateur',$administrateur->id)]) !!}
                    
                        {!! Form::label('', 'nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                        
                        {!! Form::label('', 'mail') !!}
                        {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
                        <br />
                        <button type="submit">modifier</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection