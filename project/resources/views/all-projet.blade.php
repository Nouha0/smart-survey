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
                        
                        @if(!isset($projet->reponses))
                        <tr class='projet danger'>
                        @else
                        <tr class='projet'>
                        @endif
                            <td>{{$projet->nom}}</td> 
                            <td>{{$projet->projet_start}} </td>
                            <td>{{$projet->projet_end}} </td>
                            <td class='barre_progression'>{{$projet->reponses }}/{{$projet->nombre_max}} - {{$projet->reponses / $projet->nombre_max *100}}%
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$projet->reponses / $projet->nombre_max*100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$projet->reponses / $projet->nombre_max*100}}%">
                                  <span class="sr-only">{{$projet->reponses / $projet->nombre_max *100}}% Complete (success)</span>
                                </div>
                              </div>
                            </td>
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
                                <a  data-toggle="tooltip" data-placement="top" title="Dupliquer le projet" href="{{route('dupliquer-projet',$projet->id )}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-clone" aria-hidden="true"></i></a>
                                <a  data-toggle="tooltip" data-placement="top" title="Modifier le type de graphe" class="btn btn-info btn-xs pull-left" href="{{route('build-graph',$projet->id )}}"><i class=" fa fa-line-chart" aria-hidden="true"> </i></a>
                                @if(!empty($projet->projet_html) && $projet->reponses != 0)
                                    <a  data-toggle="tooltip" data-placement="top" title="voir les reponses" href="{{route('reponse',$projet->id )}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                @endif
                                @if($projet->reponses == 0)
                                <a  data-toggle="tooltip" data-placement="top" title="modifier le formulaire" href="{{route('formulaire',$projet->id )}}" class="btn btn-info btn-xs pull-left"><i class="fa fa-database" aria-hidden="true"></i></a>            
                                @endif
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
@section('js')
<script>

</script>
@endsection