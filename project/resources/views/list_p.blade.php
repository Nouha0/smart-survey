@extends('Default')

@section('title','Selectionner un projet')

@section('content')
<div class="form-group">
    <ul>
    @foreach($projets as $p)
        @if(!empty($p->list_champs))
        <div class="row">
            <div class="col-md-5">
            <li>{{$p->nom}}</li>
            </div>
            <div class="col-md-2">
                
                <a href="{{route('reponse', $p->id)}}">voir</a>
               
            </div>
        </div>
         @endif
    @endforeach
    </ul>
     <a href="{{route('all-client')}}" class="btn btn-info">Retour</a>
</div>
@endsection