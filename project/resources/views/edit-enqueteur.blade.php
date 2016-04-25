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
                    
                    <li>{{$projet->nom}}   <a href="{{route('delete-liaison',projet->id)}}" data-id="{{projet->id}}" class="btn btn-danger btn-xs">X</a></li>
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
    $('a').on('click','.suppOp',function (e){
    e.preventDefault();
     
    var id=$(this).attr('data-id');
    var Route=suppOpRoute+id;
    var res= $(this).parent();
   
    $.ajax({
        url: Route,
        type: 'GET',
        data: '',
        dataType: 'text',
        success: function(response) {
           res.parent().remove();                  
       
        },
        fail: function(response) {
        }
    });
});
</script>
@endsection