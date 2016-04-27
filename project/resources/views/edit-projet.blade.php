@extends('Default')

@section('title','Editer')

@section('content')
<div class='form-group'>
    
    <div class="row">
        <div class="col-md-12">
    {!! Form::model($projets, ['method'=>'PUT','url'=>route('update-projet',$projets->id)])  !!}      
       <div class="form-group">
          
                        {!! Form::label('', 'Projet Nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom du projet', 'class'=>'form-control'] ) !!}
            </div>
             <div class="form-group">
                 {!! Form::label('','Clients selectionnés') !!}
                 <ul>
                        @foreach($clients as $key => $client)
                            @if(in_array($client,$proj_client))
                                <li>{{$client}}   <button data-id="{{$key}}" class="btn btn-danger btn-xs supp-utilisateur">X</button></li>
                            @else
                                <div class="hidden"> 
                                    {{$tableau[$key]=$client}}

                                </div>    
                            @endif
                        @endforeach
                 </ul>
            </div>
            @if(!empty($tableau))
                <div class="form-group">

                           {!! Form::label('', 'Clients') !!}
                           {!! Form::select('clients[]',$tableau,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

               </div>
            @endif
            <div class="form-group">
                 {!! Form::label('','Enqueteurs selectionnés') !!}
                 <ul>
                    
                        @foreach($enqueteurs as $key => $enqueteur)
                            @if(in_array($enqueteur,$proj_enq))
                                <li>{{$enqueteur}}   <button data-id="{{$key}}" class="btn btn-danger btn-xs supp-utilisateur">X</button></li>
                            @else
                                <div class="hidden"> 
                                    {{$tableau1[$key]=$enqueteur}}

                                </div>    
                            @endif
                        @endforeach
                         
                 </ul>
            </div>
           
            @if(!empty($tableau1))
                <div class="form-group">
                             {!! Form::label('', 'Nouveaux Enqueteurs') !!}
                            {!! Form::select('enqueteurs[]',$tableau1,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

                </div>
            @endif
            <div class="form-group">
                 {!! Form::label('','Administrateurs selectionnés') !!}
                 <ul>
                        @foreach($administrateurs as $key => $administrateur)
                            @if(in_array($administrateur,$proj_admin))
                                <li>{{$administrateur}}   <button data-id="{{$key}}" class="btn btn-danger btn-xs supp-utilisateur">X</button></li>
                            @else
                                <div class="hidden"> 
                                    {{$tableau2[$key]=$administrateur}}

                                </div>    
                            @endif
                        @endforeach
                 </ul>
            </div>
            @if(!empty($tableau2))
                <div class="form-group">

                            {!! Form::label('', 'Administrateurs') !!}
                            {!! Form::select('administrateur[]',$tableau2,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

                </div>
            @endif
            <div class="form-group">
                        {!! Form::label('','Nombre d\'envoie max') !!}
                        {!! Form::text('nombre_max', null,['placeholder'=>'nombre max', 'class'=>'form-control']) !!}
            <br/>
            <button class='btn btn-success pull-right' type='submit'>modifier</button>
            </div>
    </div>
        
    {!! Form::close() !!}
</div>
@endsection
@section('js')
<script>
    var supp_projetRoute="{{route('delete-liaisonP',array($projets->id,0))}}";
    supp_projetRoute = supp_projetRoute.slice(0, - 1);
    
    $('.supp-utilisateur').on('click',function (e){
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