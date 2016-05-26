@extends('Default')

@section('title','Editer')

@section('content')
<div class='form-group'>
    
    <div class="row">
        <div class="col-md-12">
            {!! Form::model($enqueteur, ['method'=>'PUT','url'=>route('update-enqueteur',$enqueteur->id)])  !!}
                <div class="form-group">
                
                {!! Form::image($photo,'photo',['class'=>'img-circle']) !!}
                </div>
               <div class="form-group">

                    {!! Form::label('', 'Nom') !!}
                    {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                    
                </div>
                <div class="form-group">

                    {!! Form::label('', 'Mail') !!}
                    {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}

                </div>
                <div class="form-group">
                    <label class="control-label"> Projets associées</label>
                    {!! Form::select('projets[]',$projets, $enqueteur->projets()->lists('projets.id')->toArray(),['class'=>'bg-focus form-control select-2', 'multiple'=>true, 'required'=>true]) !!}
                
                </div>
                 
                <br/>
                <button class='btn btn-success pull-right' type='submit'>modifier</button>
                <a href="{{route('all-enqueteur')}}" class="btn btn-info">Retour</a>
            </div>
           
            
    </div>
        
    {!! Form::close() !!}
</div>
@endsection
