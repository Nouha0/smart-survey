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
        <label class="control-label"> Clients associées</label>
            {!! Form::select('clients[]',$clients, $projet->clients()->lists('clients.id')->toArray(),['class'=>'bg-focus form-control select-2', 'multiple'=>true, 'required'=>true]) !!}
        </div>
        <div class="form-group">
        <label class="control-label"> Enqueteurs associées</label>
            {!! Form::select('enqueteurs[]',$enqueteurs, $projet->enqueteurs()->lists('enqueteurs.id')->toArray(),['class'=>'bg-focus form-control select-2', 'multiple'=>true, 'required'=>true]) !!}
        </div>
        <div class="form-group">
        <label class="control-label"> Administrateurs associées</label>
            {!! Form::select('administrateurs[]',$administrateurs, $projet->administrateurs()->lists('administrateurs.id')->toArray(),['class'=>'bg-focus form-control select-2', 'multiple'=>true, 'required'=>true]) !!}
        </div>
        @if(!empty($liste_champs) && !empty($liste_champs))
       <div class="form-group">
           <label >Valeurs statistiques sélélectionnés</label><br />
                @if(isset($liste_champs)&& !empty($liste_champs) || isset($diff)&& !empty($diff))
                    @foreach($liste_champs as $l)
                        
                            <input type="checkbox" name="list_champs[{{$l}}]"checked="true" > {{$l}}
                       
                    @endforeach
                    @foreach($diff as $k => $v)
                        
                            <input type="checkbox" name="list_champs[{{$k}}]" > {{$v}}
                        
                    @endforeach
                @endif
        </div>
        @endif
        <div class="form-group">
            {!! Form::label('','Nombre d\'envoie max') !!}
            {!! Form::text('nombre_max', null,['placeholder'=>'nombre max', 'class'=>'form-control']) !!}
            <br/>
            <button class='btn btn-success pull-right' type='submit'>modifier</button>
            <a href="{{route('all-projet')}}" class="btn btn-info">Retour</a>
        </div>
    </div>
        
    {!! Form::close() !!}
</div>
@endsection
