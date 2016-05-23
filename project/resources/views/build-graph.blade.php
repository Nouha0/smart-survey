@extends('Default')

@section('title','création de formulaire')

@section('css')
    {!! Html::style('project/resources/assets/plugins/formbuilder/vendor/css/vendor.css') !!}
    {!! Html::style('project/resources/assets/plugins/formbuilder/dist/formbuilder.css') !!}
@endsection

@section('content')
   
        <div class="fb-main">
           
        </div>
        
         {!! Form::model($projet,['method'=>'PUT','url'=>route('graph-put-formulaire')]) !!} 
                
            @foreach($champs as $k=>$v)
             <div class="form-group">
                 <div class="checkbox i-checks"><label> 
                         <input type="checkbox" name="names[{{$k}}]"><i></i> {{$v}}
                 </div>
                 
                 
             </div>
            @endforeach
            {!! Form::hidden('id',$projet->id,[]) !!}
            <br />
            <button class="btn btn-success" type="submit">créer le type des graphes</button>
        {!! Form::close() !!}
    
@endsection
@section('js')

@endsection
