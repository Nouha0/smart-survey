@extends('Default')

@section('title','Tous les clients')

@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body no-padding">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-users">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Mail</th>
                            <th class="purchased">Logo</th>
                            <th>Projets</th>
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
                                <a  data-toggle="tooltip" data-placement="top" title="voir le formulaire" href="" class="btn btn-info btn-xs pull-left"><i class="fa fa-database" aria-hidden="true"></i></a>            
                                <a href="{{route('edit-client', $client->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le projet"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
            
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
@endsection