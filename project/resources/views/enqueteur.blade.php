@extends('Default')

@section('title','Ajouter enqueteurs')

@section('content')

<div class="container">
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
    @endif
   {!! Form::open(['method'=>'POST','url'=>route('add-enqueteur'),'files'=>true]) !!}
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'nom') !!}
                {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'mail') !!}
                {!! Form::text('mail', null,['placeholder'=>'mail', 'class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                {!! Form::label('', 'projets') !!}
                {!! Form::select('projets[]', $projets,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
            </div>
        </div>
    </div>
     
    <br />
    <button  type='submit' class="btn btn-success ">envoyer</button>
    {!!  Form::close() !!}
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
                      @foreach($enqueteurs as $enqueteur)
        <tr>
            <td>{{$enqueteur->nom}}</td> 
            <td>{{$enqueteur->mail}} </td>
            <td>{{$enqueteur->photo}} </td>
            <td>
                @foreach($enqueteur->projets()->get() as $projet)
                    {{$projet->nom}} -
                @endforeach
              </td>
             <td>
                 <a  data-toggle="tooltip" data-placement="top" title="voir les formulaires" href="" class="btn btn-info btn-xs pull-left"><i class="fa fa-eye" aria-hidden="true"></i>
</a>
            <a href="{{route('edit-enqueteur', $enqueteur->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le enqueteur"><i class="fa fa-pencil-square" aria-hidden="true"></i>
</a>
            
            {!! Form::open(['method'=>'POST','url'=>route('delete-enqueteur'), 'class'=>'pull-left'])  !!}
                  
                  {!! Form::hidden('id',$enqueteur->id) !!} 
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