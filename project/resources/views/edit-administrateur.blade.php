@extends('Default')

@section('title','Modification admin')

@section('content')
<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
    @endif
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
                <button class ="btn btn-success pull-right" type="submit">modifier</button>
                <a href="{{route('all-admin')}}" class="btn btn-info">Retour</a>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
