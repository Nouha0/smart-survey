@extends('Default')

@section('title','Selectionner un projet')

@section('content')
<div class="form-group">
    <ul>
    @foreach($projet as $p)
        <div class="row">
            <div class="col-md-1">
            <li>{{$p->nom}}</li>
            </div>
            <div class="col-md-2">
            <a href="{{route('html',[$enqueteur->id,$p->id])}}">voir</a>
            </div>
        </div>
    @endforeach
    </ul>
</div>
@endsection