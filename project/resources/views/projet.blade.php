@extends('Default')

@section('title','Ajouter un projet')

@section('content')
<div class=''>
    <div class="row">
        <div class="col-md-6">
    {!! Form::open(['method'=>'POST','url'=>route('add-projet')])  !!}
    <div class="form-group">
                {!! Form::label('', 'Projet Nom') !!}
                {!! Form::text('nom', null,['placeholder'=>'nom du projet', 'class'=>'form-control'] ) !!}
    </div>
     <div class="form-group">
       
                {!! Form::label('', 'Clients') !!}
                {!! Form::select('clients[]', $clients,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
           
    </div>
    <div class="form-group">
        
                {!! Form::label('', 'Enqueteurs') !!}
                {!! Form::select('enqueteurs[]', $enqueteurs,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
          
    </div>
    <div class="form-group">
       
                {!! Form::label('', 'Administrateurs') !!}
                {!! Form::select('administrateurs[]', $administrateurs,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
        
    </div>
    <div class='form-group'>
        <div class='row'>
            <div class='col-md-4'>

                    {!! Form::label('', 'Date de début') !!}
                    {!! Form::text('projet_start','',['class'=>'datepicker form-control']) !!}

            </div>
            <div class="col-md-4">

                {!! Form::label('', 'Date de fin') !!}
                {!! Form::text('projet_end','',['class'=>'datepicker form-control']) !!}

            </div>
        </div>
    </div>
    <br />
    <button  type='submit'>envoyer</button>
    
   {!! Form::close() !!} 
    </div>
<div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>New Orders</strong> <a href="#" class="pull-right">View all</a></div>
                <div class="panel-body no-padding">

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-users">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Full name</th>
                        <th class="purchased">Purchased</th>
                        <th>Status</th>
                        <th class="text-right"></th>
                    </tr>
                    </thead>

                <tbody>    
                      @foreach($projets as $projet)
        <tr>
            <td>{{$projet->nom}}</td> 
            <td>{{$projet->projet_start}} </td>
            <td>{{$projet->projet_end}} </td>
            <td>
                @foreach($projet->clients()->get() as $client)
                    {{$client->nom}} -
                @endforeach
              </td>
             <td>
                @foreach($projet->enqueteurs()->get() as $enqueteur)
                    {{$enqueteur->nom}} -
                @endforeach 
             </td>
             <td>
                @foreach($projet->administrateurs()->get() as $administrateur)
                    {{$administrateur->nom}} -
                @endforeach
              </td>
             <td>
                 <a  data-toggle="tooltip" data-placement="top" title="modifier le formulaire" href="{{route('formulaire',$projet->id )}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-database" aria-hidden="true"></i>
</a>
            <a href="{{route('edit-projet', $projet->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le projet"><i class="fa fa-pencil-square" aria-hidden="true"></i>
</a>
            
            {!! Form::open(['method'=>'POST','url'=>route('delete-projet'), 'class'=>'pull-left'])  !!}
                  
                  {!! Form::hidden('id',$projet->id) !!} 
                  <button class='btn btn-danger btn-xs'  data-toggle="tooltip" data-placement="top" title="Supprimer" type='submit'>
                      <i class="fa fa-times-circle" aria-hidden="true"></i>
                  </button>
                  
            {!! Form::close() !!}
             </td>
        </tr>
      @endforeach
                
                </tbody>

            </table>
            </div>


            </div>
            </div>
            </div>
    
</div>
</div>
@endsection
@section('css')
    {!! Html::style('project/resources/assets/plugins/datePicker/css/datepicker.css') !!}

@endsection
@section('js')
    
<script src="{{ url('project/resources/assets/plugins/datePicker/js/bootstrap-datepicker.js') }}"></script>
<script> 
    if($('.datepicker').length>0){
        $('.datepicker').datepicker({
            format : 'yyyy-mm-dd'
        });
    }
</script>  
@stop

