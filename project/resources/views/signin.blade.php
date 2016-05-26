<!DOCTYPE html>
<html>

<!-- Mirrored from juanproject.org/myxdashboard/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Apr 2016 21:59:05 GMT -->
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

        <div>
            <p>Clean and elegant responsive template suitable for any back-end 
                application. Created using latest Bootstrap Framework</p>

            <p>Login in. To see it in action.</p>
            
             {!! Form::open(['method'=>'POST','url'=>route('affiche-projet')]) !!}
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Username" required="">
                    <input type="password" class="form-control" placeholder="Password" required="">
                </div>
                
                <button type="submit" class="btn btn-primary block full-width signin-btn">Sign In</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{route('register')}}">Create an account</a>
            {!! Form::close() !!}
            <p class="m-t"> <small>&copy; myxdashboard 2014, Admin Dashboard Base on Bootstrap Framework</small> </p>
        </div>
    </div>




    <!-- scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/theme.js"></script>


</body>

<!-- Mirrored from juanproject.org/myxdashboard/signin.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Apr 2016 21:59:05 GMT -->
</html>