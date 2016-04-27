@extends('Default')

@section('title','Modification admin')

@section('content')
<div class="container">
    <div class="col-md-8">
        <div class="row">
            {!! Form::model($administrateurs,['method'=>'PUT','url'=>route('update-administrateur',$administrateurs->id)]) !!}
                <div class="form-group">

                    {!! Form::label('', 'nom') !!}
                    {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}

                </div>
                <div class="form-group">
                    
                    {!! Form::label('', 'mail') !!}
                    {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}

                </div>
                <div class="">
                    {!! Form::label('','Projets sélectionnés') !!}
                    <ul>
                        @foreach($projets as $key => $projet)
                            @if(in_array($projet,$adm_proj))
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
                <br />
                <button class ="btn btn-success" type="submit">modifier</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var supp_projetRoute="{{route('delete-liaisonA',array($administrateurs->id,0))}}";
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