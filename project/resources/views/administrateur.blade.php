@extends('Default')

@section('title','ajouter administrateur')

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
        
            <div class="row">
                <div class="col-md-8">
                    {!! Form::open(['method'=>'POST','url'=>route('add-administrateur')]) !!}
                       <div class="form-group">
                        {!! Form::label('', 'Nom') !!}
                        {!! Form::text('nom', null,['placeholder'=>'nom', 'class'=>'form-control'] ) !!}
                        </div>
                     <div class="form-group">
                        {!! Form::label('','Mail') !!}
                        {!! Form::text('email',null,['placeholder'=>'Mail', 'class'=>'form-control']) !!}
                     </div>
                     <div class="form-group">
                        {!! Form::label('', 'Projets') !!}
                        {!! Form::select('projets[]', $projets,null,['multiple'=>true ,'class'=>'form-control'] ) !!}
                     </div>
                    <div class="form-group">
                        {!! Form::label('', 'Role') !!}
                        <select name="roles">
                            <option value="2">Administrateur</option>
                            <option value="1">Administrateur / Superviseur</option>
                        </select>
                    </div>
                        <br />
                        <button type="submit" class="btn btn-success">envoyer</button>
                    {!! Form::close() !!}
                
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Clients</strong> <a href="" class="pull-right">tous voir</a></div>
                <div class="panel-body no-padding">

                    <div class="table-responsive">
                    <table class="table table-striped table-hover table-users">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>mail</th>
                        <th>projet</th>
                    </tr>
                    </thead>

                <tbody>    
                      @foreach($administrateurs as $administrateur)
                    <tr>
                        <td>{{$administrateur->nom}}</td> 
                        <td>{{$administrateur->mail}} </td>
                        <td>
                            @foreach($administrateur->projets()->get() as $projet)
                                {{$projet->nom}} -
                            @endforeach
                        </td>
                        <td>
                            <a  data-toggle="tooltip" data-placement="top" title="modifier le formulaire" href="{{route('formulaire',$administrateur->id )}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{route('edit-administrateur', $administrateur->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le client"><i class="fa fa-pencil-square" aria-hidden="true"></i>
                            </a>
            
                            {!! Form::open(['method'=>'POST','url'=>route('delete-administrateur'), 'class'=>'pull-left'])  !!}
                  
                                {!! Form::hidden('id',$administrateur->id) !!} 
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
@endsection