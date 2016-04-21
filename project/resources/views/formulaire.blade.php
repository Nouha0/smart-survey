@extends('Default')

@section('title','création de formulaire')

@section('css')
    {!! Html::style('project/resources/assets/plugins/formbuilder/dist/formbuilder.css') !!}
    {!! Html::style('project/resources/assets/plugins/formbuilder/vendor/css/vendor.css') !!}
@endsection

@section('content')
    <div class="container">
        <div class="fb-main">
           
        </div>
        
         {!! Form::model($projet,['method'=>'PUT','url'=>route('put-formulaire')]) !!} 
                {!! Form::hidden('projet_html',null,[ 'class'=>'form-json']) !!}
                {!! Form::hidden('id',$projet->id,[]) !!}
                    
                <br />
                <button type="submit">créer le formulaire</button>
            {!! Form::close() !!}
    </div>
@endsection
@section('js')
    <script src="{{url('project/resources/assets/plugins/formbuilder/vendor/js/vendor.js')}}"></script>

    <script src="{{url('project/resources/assets/plugins/formbuilder/dist/formbuilder.js')}}"></script>
    <script>
        $(function(){
          fb = new Formbuilder({
            selector: '.fb-main',
            @if(isset($projet->projet_html) && !empty($projet->projet_html))
            bootstrapData:{!! $projet->projet_html !!}.fields
                    
            @endif
          });

          fb.on('save', function(payload){
            console.log(payload);
            $('.form-json').val(payload);
          })
        });
        
      </script>
@endsection
