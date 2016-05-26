@extends('Default')

@section('title','Selectionner un projet')

@section('content')
<div class="form-group">
    <ul>
    @foreach($projet as $p)
       @if($p->reponses == 0)
        <div class="row">
            <div class="col-md-5">
            <li>{{$p->nom}}</li>
            </div>
            <div class="col-md-2">
                <a href="{{route('formulaire', $p->id)}}">voir</a>
            </div>
        </div>
        @endif
    @endforeach
    </ul>
     <a href="{{route('all-admin')}}" class="btn btn-info">Retour</a>
</div>
@endsection