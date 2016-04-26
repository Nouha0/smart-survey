@extends('Default')

@section('title','Editer')

@section('content')
<div class='form-group'>
    
    <div class="row">
        <div class="col-md-12">
    {!! Form::model($enqueteurs, ['method'=>'PUT','url'=>route('update-enqueteur',$enqueteurs->id)])  !!}      
       <div class="form-group">
          
                        {!! Form::label('', 'Nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                        
                    
                        {!! Form::file('photo',null,['class'=>'form-control']) !!}
            </div>
             <div class="form-group">

                        {!! Form::label('', 'Mail') !!}
                        {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}

            </div>
            <div class="form-group">
                    {!! Form::label('', 'Projets selectionnés') !!}
                    <ul>
                    @foreach($enqueteurs->projets()->get() as $projet)
                    
                    <li>{{$projet->nom}}   <button data-id="{{$projet->id}}" class="btn btn-danger btn-xs supp-projet">X</button></li>
                    @endforeach
                    </ul>
            </div>
            <div class="form-group">
                         {!! Form::label('', 'Projets') !!}
                        {!! Form::select('projets[]',$projets,null,['multiple'=>true ,'class'=>'form-control'] ) !!}

            </div>
            
            <br/>
            <button class='btn btn-success pull-right' type='submit'>modifier</button>
            </div>
    </div>
        
    {!! Form::close() !!}
</div>
@endsection
@section('js')
<script>
    var supp_projetRoute="{{route('delete-liaison',array(11,0))}}";
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