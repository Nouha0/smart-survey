@extends('Default')

@section('title','reponses')

@section('content')


<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body no-padding">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-users">
                    
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
                                <td>{{$l->$name}}</td>
                                @endforeach
                            </tr> 
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 @foreach($options as $k => $v)
<div class="col-md-6" >
    <div class="panel panel-default">
        <div class="panel-body">
           
                <canvas id="myChart{{$k}}" width="400" height="100"></canvas>
           
            </div>
    </div>
</div>
  @endforeach
  @foreach($options as $k => $v)
<div class="col-md-6" >
    <div class="panel panel-default">
        <div class="panel-body">
    
    
        <canvas id="pie{{$k}}" width="400" height="100"></canvas>
    
            </div>
    </div>
</div>

@endforeach


@endsection
@section('js')
<script>
  
    var couleurs = {};
    couleurs = [
        '69fd73',
        '38c2c0',
        
        '32807b',
        '157e7d',
        'dd5fa9',
        'aba629',
        '6f6f76',
        '8953b3',
        '5f6cea',
        '757aa5',
        'd6a366',
        'b52f25',
        '005ebf',
        '6a1a4b',
        'eee96e',
        '272727',
        'd1d1d1',
        '017244',
        'f411b7',
        'f9126e',
        'ddd'
    ];
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
                    label: '{{$k}}',
                    data: [{{implode(',',$option)}}],
                    backgroundColor: [
                        @foreach($option as $opt)
                        <?php $i++;?>
                            "#"+couleurs[{{$i%20}}],                    
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
                        <?php $i++;?>
                            "#"+couleurs[{{$i%20}}],                    
                        @endforeach   
                        ],
                }]
            }
    });
    
    @endforeach
  
    /*$('#bar').on('click',function(){
        if($('.bar').hasClass('hidden')){
            $('.bar').hide();
        }else{
            $('.pie').show();
            $('.pie').removeClass('hidden');
        }
            
    });*/
    
    function validate(){
    if ($('#bar').prop('checked',true)){
         $('.bar').hide();
    }else{
          $('.bar').show();
    }
}
    
    
      
    
   
   
</script>
@endsection