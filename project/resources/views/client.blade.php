@extends('Default')

@section('title','Ajouter clients')

@section('content')

<div class="container">
    {!! Form::open(['method'=>'POST','url'=>route('add-client'),'files'=>true]) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'Nom') !!}
                {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                
            </div>
            <div class="col-md-4 ">
                    {!! Form::file('photo',null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'Mail') !!}
                {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control'] ) !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'Projets') !!}
                {!! Form::select('projets[]', $projets,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
            </div>
        </div>
        <br />
        <button  type='submit' class="btn btn-success">envoyer</button>
    </div>
    {!! Form::close()!!}
    <br />
    <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Clients</strong> <a href="#" class="pull-right">View all</a></div>
                <div class="panel-body no-padding">

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-users">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>mail</th>
                        <th class="purchased">photo</th>
                        <th>projet</th>
                    </tr>
                    </thead>

                <tbody>    
                      @foreach($clients as $client)
        <tr>
            <td>{{$client->nom}}</td> 
            <td>{{$client->mail}} </td>
            <td>{{$client->photo}} </td>
            <td>
                @foreach($client->projets()->get() as $projet)
                    {{$projet->nom}} -
                @endforeach
              </td>
             <td>
                 <a  data-toggle="tooltip" data-placement="top" title="voir les resultats" href="" class="btn btn-info btn-xs pull-left"><i class="fa fa-eye" aria-hidden="true"></i>
</a>
            <a href="{{route('edit-client', $client->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le client"><i class="fa fa-pencil-square" aria-hidden="true"></i>
</a>
            
            {!! Form::open(['method'=>'POST','url'=>route('delete-client'), 'class'=>'pull-left'])  !!}
                  
                  {!! Form::hidden('id',$client->id) !!} 
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
@stop