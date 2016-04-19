@extends('Default')

@section('title','Editer')

@section('content')
<div class='container'>
    {!! Form::model($project, ['method'=>'PUT','url'=>route('update-project',$project->id)])  !!}
            
        {!! Form::label('', 'Project Name') !!}
        {!! Form::text('nom', null,['placeholder'=>'nom du projet', 'class'=>'form-control'] ) !!}
        <br/>
        <button class='droite' type='submit'>modifier</button>

    {!! Form::close() !!} 
</div>
@endsection