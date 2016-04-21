@extends('Default')

@section('title','Tous les projets')

@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body no-padding">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-users">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Date de création</th>
                            <th class="purchased">date de fin</th>
                            <th>Nb d'envoie</th>
                            <th>Clients</th>
                            <th class="">enqueteurs</th>
                            <th>Administrateurs</th>
                        </tr>
                    </thead>

                    <tbody>    
                        @foreach($projets as $projet)
                        <tr>
                            <td>{{$projet->nom}}</td> 
                            <td>{{$projet->projet_start}} </td>
                            <td>{{$projet->projet_end}} </td>
                            <td>{{$projet->nombre_max}} </td>
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
                                <a  data-toggle="tooltip" data-placement="top" title="modifier le formulaire" href="{{route('formulaire',$projet->id )}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-database" aria-hidden="true"></i></a>            
                                <a href="{{route('edit-projet', $projet->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le projet"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
            
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
@endsection