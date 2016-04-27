@extends('Default')

@section('title','Tous les enqueteurs')

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
                                
                                    <a  data-toggle="tooltip" data-placement="top" title="voir le formulaire" href="{{route('liste-projet',$enqueteur->id)}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-database" aria-hidden="true"></i></a>            
                               
                                <a href="{{route('edit-enqueteur', $enqueteur->id)}}" class="btn btn-success btn-xs pull-left"  data-toggle="tooltip" data-placement="top" title="Modifier le projet"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
            
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
@endsection