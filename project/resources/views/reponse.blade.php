@extends('Default')

@section('title','Réponses')

@section('content')
 @foreach($libeles as $lib)
<div class="col-md-4">
    <div class="panel panel-default">
        <div class="panel-body no-padding libeles">
        @foreach($res_libel as $res)
        <h5>{{$res}}  <span>{{$res / $nb_rep *100}} %</span></h5>
        @endforeach
        <p>{{implode(' - ',$lib)}}</p>
        </div>
    </div>
</div>
 @endforeach
<div class="clearfix"></div>
<div class="col-md-12">
            
            <div class="panel panel-default">
               
                <div class="panel-heading">
               
                    <h5>Table des réponses</h5>
    
                </div>

                <div class="panel-body">

                 <table class="table table-striped table-bordered table-hover dataTables-example" >
                     <thead>
                        <tr>
                            <th>ID</th>
                            @foreach($champs as $ch)
                             <th>{{$ch}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($r as $l)
                            <tr>
                                <td>{{$l->id}}</td>
                                @foreach($names as $name) 
                                @if(is_array(json_decode($l->$name, true)))
                                <td>{{implode(' , ' ,json_decode($l->$name, true))}}</td>
                                @else
                                <td>{{$l->$name}}</td>
                                @endif
                                @endforeach
                            </tr> 
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                            <th>ID</th>
                            @foreach($champs as $ch)
                             <th>{{$ch}}</th>
                            @endforeach
                        </tr>
                    </tfoot>
                    </table>
        </div>
    </div>
</div>

 @foreach($options as $k => $v)
<div class="col-md-6" >
    <div class="panel panel-default">
        <div class="panel-heading"><h5>{{$k}} - Bar</h5> </div>
        <div class="panel-body">
           
                <canvas id="myChart{{$k}}" width="400" height="100"></canvas>
           
            </div>
    </div>
</div>

<div class="col-md-6" >
    <div class="panel panel-default">
        <div class="panel-heading"><h5>{{$k}} - Pie</h5> </div>
        <div class="panel-body">
    
    
        <canvas id="pie{{$k}}" width="400" height="100"></canvas>
    
            </div>
    </div>
</div>

@endforeach
<?php $i=0;

?>
<h4>Comparaisons</h4>
@foreach($comparer as $k=>$com)
<div class="col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5><strong>{{explode('-',$k)[0]}}</strong> par rapport à/au <strong>{{explode('-',$k)[1]}}</strong>
                    </h5> </div>
        <div class="panel-body">
    
    
        <canvas id="compare{{$k}}" width="400" height="200"></canvas>
    
            </div>
    </div>
</div>
<?php $i++ ; ?>
@endforeach



@endsection
@section('js')
    <script type="text/javascript">
        var couleur = [
            'rgba(127, 138, 138, 0.3)',
            'rgba(248, 138, 138, 0.3)',
            'rgba(48, 187, 138, 0.3)',
            'rgba(48, 164, 18, 0.3)',
            'rgba(28, 164, 18, 0.3)',
            'rgba(43, 164, 171, 0.3)',
            'rgba(109, 164, 171, 0.3)',
            'rgba(109, 10, 171, 0.3)',
            'rgba(109, 60, 171, 0.3)',
            'rgba(109, 234, 171, 0.3)',
            'rgba(186, 234, 171, 0.3)',
            'rgba(47, 234, 171, 0.3)',
            'rgba(11, 151, 193, 0.2)',
            'rgba(27, 9, 193, 0.3)',
            'rgba(208, 172, 193, 0.3)',
            'rgba(135, 135, 29, 0.3)',
            'rgba(177, 184, 29, 0.3)',
            'rgba(211, 204, 29, 0.3)',
            'rgba(16, 204, 250, 0.1)',
            'rgba(151, 204, 250, 0.1)',
            'rgba(16, 204, 29, 0.3)',
            'rgba(251, 158, 250, 0.2)'


        ];
        function getColorR(){
            return ('rgba(' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) + ',' + (Math.floor(Math.random() * 256)) +',0.3)');
        }
        $('.dataTables-example').dataTable();
        function getColor(){
            var x = Math.floor(Math.random() * 20); 
            return couleur[x];
        }
        //statistiques
        @foreach($options as $k=>$option)

           <?php  
           $i=0;
           $keys = "";
           foreach($option as $key=>$v){
             $keys .= '"'.$key.'",';
            }
            $keys = substr($keys, 0, -1);
            
            

            ?>

            var ctx = $("#myChart{{$k}}");
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                    labels: [{!! $keys!!}],
                    datasets: [{
                        label: "{{str_replace('_',' ',$k)}}",
                        data: [{{implode(',',$option)}}],
                        backgroundColor: [
                            @foreach($option as $opt)
                           getColor(),
                        @endforeach            
                        ],
                    }]
                },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        var ctx = $("#pie{{$k}}");
            var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                    labels: [{!! $keys!!}],
                    datasets: [{
                        label: '{{$k}}',
                        data: [{{implode(',',$option)}}],
                        backgroundColor: [
                            @foreach($option as $opt)
                               getColor(),
                            @endforeach   
                            ],
                    }]
                }
        });

        @endforeach
        //comparaison
        
        @foreach($comparer as $nom => $courbe)
        
         <?php  
           $i=$j=0;
           $keys = "";
           
           foreach($courbe as $key=>$v){
               $j++;
               if($j==1){
                foreach ($v as $obj=>$obj2){
                   $keys .= '"'.$obj.'",'; 
                }
               }
            }
            $j=0;
            $keys = substr($keys, 0, -1); 
            ?>
             
            var ctx = $("#compare{{$nom}}");
            var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                    labels: [{!! $keys!!}],
                    datasets: [
                    @foreach($courbe as $key=>$v)
                    {
                        fill: true,
                        lineTension: 0.1,
                        backgroundColor:getColor(),
                        //borderColor: '#333',
                        borderCapStyle: 'butt',
                        borderDash: [],
                        borderDashOffset: 0.0,
                        borderJoinStyle: 'miter',
                        pointBorderColor: getColor(),
                        pointBackgroundColor: "#fff",
                        pointBorderWidth: 0.5,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor:getColor(),
                        pointHoverBorderColor:getColor(),
                        pointHoverBorderWidth: 2,
                        pointRadius: 1,
                        pointHitRadius: 10,
                        label: "{{str_replace('_',' ',$key)}}",
                        data: [{{implode(',',$v)}}],
                       
                    },
                    @endforeach
                    ]
                },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });

        @endforeach
        
    </script>
@endsection