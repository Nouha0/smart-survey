@extends('Default')

@section('title','Editer')

@section('content')
<div class='form-group'>
    
    <div class="row">
        <div class="col-md-12">
    {!! Form::model($projet, ['method'=>'PUT','url'=>route('update-projet',$projet->id)])  !!}      
       <div class="form-group">
          
                        {!! Form::label('', 'Projet Nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom du projet', 'class'=>'form-control'] ) !!}
            </div>
             <div class="form-group">

                        {!! Form::label('', 'Clients') !!}
                        {!! Form::select('clients[]',$clients,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

            </div>
            <div class="form-group">

                        {!! Form::label('', 'Enqueteurs') !!}
                        {!! Form::select('enqueteurs[]',$enqueteurs,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

            </div>
            <div class="form-group">

                        {!! Form::label('', 'Administrateurs') !!}
                        {!! Form::select('administrateur[]',$administrateurs,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

            </div>
            <div class="form-group">
                        {!! Form::label('','Nombre d\'envoie max') !!}
                        {!! Form::text('nombre_max', null,['placeholder'=>'nombre max', 'class'=>'form-control']) !!}
            <br/>
            <button class='btn btn-success pull-right' type='submit'>modifier</button>
            </div>
    </div>
        
    {!! Form::close() !!}
</div>
@endsection