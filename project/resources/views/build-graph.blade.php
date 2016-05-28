@extends('Default')

@section('title','Création de graphe')

@section('css')
    {!! Html::style('project/resources/assets/plugins/formbuilder/vendor/css/vendor.css') !!}
    {!! Html::style('project/resources/assets/plugins/formbuilder/dist/formbuilder.css') !!}
@endsection

@section('content')
   
        <div class="fb-main">
           
        </div>
             
            <div class="panel panel-default">
               
               

                <div class="panel-body">
        
         {!! Form::model($projet,['method'=>'PUT','url'=>route('graph-put-formulaire')]) !!} 
         <label>Voir dans les statistiques</label>
            @foreach($champs as $k=>$v)
             <div class="form-group">
                 <div class="checkbox i-checks"><label> 
                         <input type="checkbox" name="names[{{$k}}]"><i></i> {{$v}}
                 </div>
                 
             </div>
            @endforeach
            <hr>
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
                <div class="col-md-12">
                <a href="" class="btn btn-info btn-sm" id="add-compare">Ajouter une comparaison</a>
                </div>
                
            
            
                
            </div>
            <hr>
            
            <div class="input-libelles">
                
            </div> 
            
            <h5>libellés</h5>
            <div class="affiche-libelles"></div>
            <div class="row">
                @foreach($libelles as $l => $vl)
                <div class="col-md-2 col-sm-6">
                    
                    <div class="form-group">
                        <select class="form-control libelles" name="{{$l}}">
                            <option value="">{{$l}}</option>
 
                            @foreach($vl as $value)
                                <option value="{{$value}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                </div>
                @endforeach
                <div class="col-md-12">
                    <a href="" class="btn btn-info btn-sm get-libelles">Ajouter un libellé</a>
                </div>
            </div> 
            
            <hr>
            {!! Form::hidden('id',$projet->id,[]) !!}
            <br />
            <button class="btn btn-success" type="submit">Créer le type des graphes</button>
        {!! Form::close() !!}
                </div></div>
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
   
   $('.get-libelles').on('click',function(e){
       e.preventDefault();
       
       var libelles = {};
       var name="";
       var i =0;
       var el ="";
       
       $('select.libelles').each(function(){
           if(($(this).val())!= ""){
                name = $(this).attr('name');
                libelles[name] = $(this).val();
                el = el +' '+ name +':'+$(this).val();
                i++;
            }
        });
        if($('.affiche-libelles p').length==0){
            insertLibeles(el, libelles, i);
        }else{
        $('.affiche-libelles p').each(function(){
            console.log($(this).text()+'-'+el)
            if($(this).text() == ('Libellés séléctionné :'+el)){
                alert('Le choix a été fait déjà !');
               // return false;
            }
            else {
                insertLibeles(el, libelles, i);
            }
        });
    }
   });
   
   function insertLibeles(el, libelles, i){
       if(i != 0){
            $('.affiche-libelles').append('<p>Libellés séléctionné :'+el+'</p>');
            $('.input-libelles').append('<input name="libelles[]" type="hidden" value='+JSON.stringify(libelles)+'>');
        }else{
            alert('erreur vous devez séléctionner au moins un libellé ! ');
        }
   }
</script>
@endsection
