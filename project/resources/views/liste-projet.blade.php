@extends('Default')

@section('title','Selectionner un projet')

@section('content')
<div class="form-group">
    <ul>
    @foreach($projet as $p)
        {!! Form::open(['method'=>'GET','url'=>route('html',[$enqueteur->id,$p->id])])  !!}
        <div class="row">
            <div class="col-md-1">
            <li>{{$p->nom}}</li>
            </div>
            <div class="col-md-2">
            <button type="submit">Voir</button>
            </div>
        </div>
        {!! Form::close()  !!}
    @endforeach
    </ul>
</div>
@endsection