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

            <div class="input-croise">
                
            </div> 


            <label>Champs croisés</label>
            <div class="row">
                <div class="col-md-2">
                 <div class="form-group">
                    <select id="croise-1" class="form-control">
                        @foreach($champs as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                         @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-2">
                 <div class="form-group">
                    <select id="croise-2" class="form-control">
                        @foreach($champs as $k=>$v)
                            <option value="{{$k}}">{{$v}}</option>
                         @endforeach
                    </select>
                    </div>
                </div>
                <div class="col-md-3">
                <a href="" class="btn btn-info" id="add-compare">ajouter une comparaison</a>
                </div>
                
            
            
                
            </div>
            <label></label>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <select id="croise-2" class="form-control">

                                <option value=""></option>

                        </select>
                    </div>
                </div>
            </div> 
            
            
            {!! Form::hidden('id',$projet->id,[]) !!}
            <br />
            <button class="btn btn-success" type="submit">créer le type des graphes</button>
        {!! Form::close() !!}
    
@endsection
@section('js')
<script type="text/javascript">
   
   $('#add-compare').on('click', function(e){
      e.preventDefault();
      var val = {};
      
      val[$('#croise-1').val()] = $('#croise-2').val();
      $('.input-croise').append('<p>'+$('#croise-1').val() + ' compare avec ' +$('#croise-2').val()+'</p>');
      $('.input-croise').append('<input name="champs_croises[]" type="hidden" value='+JSON.stringify(val)+'>');
      console.log(val);
    
   }); 
</script>
@endsection
