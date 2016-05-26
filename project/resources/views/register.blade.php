<!DOCTYPE html>
<html>

<head>
  <title>MYX Dashboard</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- bootstrap -->
    
    {!! Html::style('project/resources/assets/dist/css/bootstrap.css') !!}
    {!! Html::style('project/resources/assets/dist/css/bootstrap-overrides.css') !!}

    <!-- theme -->
      {!! Html::style('project/resources/assets/css/default.css') !!}

    <!-- libraries -->
   
    {!! Html::style('project/resources/assets/dist/css/font-awesome.css') !!}
    
    {!! Html::style('project/resources/assets/dist/css/signin.css') !!}
 

    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
    <![endif]-->

</head>
<body class="onepage">
    <div class="col-md-4 col-md-offset-4 text-center">
     <img src="{{url('project/resources/assets/dist/img/logo.png')}}" class="logo" />
<p>Clean and elegant responsive template suitable for any back-end application. Created using latest Bootstrap Framework</p>
        <p>Create account to see it in action.</p>

                {!! Form::open(['method'=>'POST','url'=>route('add-user')]) !!}
               
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="name" name="name" required="">
                    <input type="email" class="form-control" placeholder="email" name="email" required="">
                    <input type="password" class="form-control" placeholder="password" name="password" required="">
                </div>
               
                <div class="form-group2 text-left">
                <div class="checkbox i-checks"><label> 
                <input type="checkbox"><i></i> Agree the terms and policy</div>
                <button type="submit" class="btn btn-primary block full-width">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                
                {!! Form::close() !!}
            <p class="m-t"> <small>&copy; myxdashboard 2014, Admin Dashboard Base on Bootstrap Framework</small> </p>


</div>



    <!-- scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/theme.js"></script>
 <script src="js/tables/icheck.min.js"></script>

           <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

</body>

</html>