@extends('Default')

@section('title','Modification clients')

@section('content')
{!! Form::model($clients,['method'=>'PUT','url'=>route('update-client',$clients->id)]) !!}
    <div class="col-md-8"> 
        <div class="row">
            <div class="form-group">
                
                 {!! Form::label('', 'nom') !!}
                 {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                               
            </div>
            <div class="form-goup ">
                
                 {!! Form::label('', 'mail') !!}
                 {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
                 
            </div>
            <div class="form-group">
                 {!! Form::label('','projets selectionnés') !!}
                 <ul>
                        @foreach($projets as $key => $projet)
                            @if(in_array($projet,$client_proj))
                                <li>{{$projet}}   <button data-id="{{$key}}" class="btn btn-danger btn-xs supp-projet">X</button></li>
                            @else
                                <div class="hidden"> 
                                    {{$tableau[$key]=$projet}}

                                </div>    
                            @endif
                        @endforeach
                 </ul>
            </div>
            @if(!empty($tableau))
                <div class="form-group">
                    {!! Form::label('', 'Projets') !!}
                    {!! Form::select('projets[]',$tableau,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
                </div>
            @endif
            
        </div>
        <br />
        <button class="btn btn-success" type="submit">modifier</button>    
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="form-group">
                {!! Form::file('logo',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>    
    
{!! Form::close() !!}

@endsection
@section('js')
<script>
    var supp_projetRoute="{{route('delete-liaisonC',array($clients->id,0))}}";
    supp_projetRoute = supp_projetRoute.slice(0, - 1);
    
    $('.supp-projet').on('click',function (e){
    e.preventDefault();
     
    var id=$(this).attr('data-id');
    console.log(id);
    var Route=supp_projetRoute+id;
    var res= $(this).parent();
   
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
           console.log('oui');
           res.remove();                  
       
        },
        fail: function(response) {
            console.log('non')
        }
    });
});
</script>
@endsection