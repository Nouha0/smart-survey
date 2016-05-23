@extends('Default')

@section('title','Modification admin')

@section('content')
<div class="container">
    <div class="col-md-8">
        <div class="row">
            {!! Form::model($administrateur,['method'=>'PUT','url'=>route('update-administrateur',$administrateur->id)]) !!}
                <div class="form-group">

                    {!! Form::label('', 'nom') !!}
                    {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}

                </div>
                <div class="form-group">
                    
                    {!! Form::label('', 'mail') !!}
                    {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}

                </div>
                <div class="form-group">
                    <label class="control-label"> Projets associées</label>
                    {!! Form::select('projets[]',$projets, $administrateur->projets()->lists('projets.id')->toArray(),['class'=>'bg-focus form-control select-2', 'multiple'=>true, 'required'=>true]) !!}
                </div>
                <br />
                <button class ="btn btn-success" type="submit">modifier</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
