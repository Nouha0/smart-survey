@extends('Default')

@section('title','remplir le formulaire')

@section('css')
    {!! Html::style('project/resources/assets/plugins/mustache/extras/highlight.css') !!}
@endsection

@section('content')
<div class="col-md-12">
    {!! Form::open(['method'=>'POST']) !!}
        <div class="form-group">
           {!! Form::hidden('json',$html) !!}
        </div>
        <br />
        <button class="btn btn-success">soumettre</button>
    {!! Form::close() !!}
</div>
@endsection
@section('js')
<script src="{{ url('project/resources/assets/plugins/mustache/extras/mustache.js') }}"></script>
<script src="{{ url('project/resources/assets/plugins/mustache/extras/highlight.js') }}"></script>
<script>
    var jdata = $json;
</script>
@endsection