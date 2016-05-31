<!DOCTYPE html>
<html>
<!-- Mirrored from juanproject.org/myxdashboard/forms.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 05 Apr 2016 21:58:55 GMT -->
<head>
  <title>MYX Dashboard</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap 
    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap-overrides.css" type="text/css" rel="stylesheet" />-->
    {!! Html::style('project/resources/assets/dist/css/bootstrap.css') !!}
    {!! Html::style('project/resources/assets/dist/css/bootstrap-overrides.css') !!}
    <!-- theme 
    <link rel="stylesheet" type="text/css" href="/css/default.css" />-->
    {!! Html::style('project/resources/assets/css/default.css') !!}
    <!-- libraries 
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/elements/form.css" />
    <link rel="stylesheet" type="text/css" href="css/elements/bootstrap-wysihtml5.css" />-->
    {!! Html::style('project/resources/assets/css/font-awesome/css/font-awesome.min.css') !!}
    {!! Html::style('project/resources/assets/dist/css/form.css') !!}
    {!! Html::style('project/resources/assets/dist/css/bootstrap-wysihtml5.css') !!}
    {!! Html::style('project/resources/assets/plugins/formbuilder/vendor/css/vendor.css') !!}
    {!! Html::style('project/resources/assets/plugins/formbuilder/dist/formbuilder.css') !!}
    
     {!! Html::style('project/resources/assets/dist/css/dataTables.bootstrap.css') !!}
     {!! Html::style('project/resources/assets/dist/css/tables.css') !!}
     
    
    


    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!--[if lt IE 9]>
      <script src="js/html5.js"></script>
    <![endif]-->

</head>
<body>

    <!-- navbar -->
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" id="menu-toggler">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index-2.html"><img src="{{url('project/resources/assets/dist/img/logo.png')}}"  /></a>
        </div>

        <ul class="nav navbar-nav pull-right hidden-xs">
            <li class="hidden-xs">
                <input class="search" type="text" placeholder="Enter keywords" />
            </li>
            <li class="notification-dropdown hidden-xs">
                <a href="#" class="trigger">
                    <i class="glyphicon glyphicon-bell"></i>
                    <span class="count">5</span>
                </a>
                <div class="pop-dialog">
                    <div class="pointer right">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <a href="#" class="close-icon"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        <div class="notifications">
                            <h3>You have 5 new notifications</h3>
                            <a href="#" class="item">
                                <i class="fa fa-bug"></i> Server Error Reports
                                <span class="time"><i class="fa fa-clock-o"></i> 13 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="fa fa-cloud-download"></i> Backup Completed
                                <span class="time"><i class="fa fa-clock-o"></i> 18 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="fa fa-cogs"></i> <strong>System Updated</strong>
                                <span class="time"><i class="fa fa-clock-o"></i> 20 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="fa fa-code"></i> Code Error on Line 101
                                <span class="time"><i class="fa fa-clock-o"></i> 49 min.</span>
                            </a>
                            <a href="#" class="item">
                                <i class="fa fa-refresh fa-spin"></i> Spinner Icon
                                <span class="time"><i class="fa fa-clock-o"></i> 1 day.</span>
                            </a>
                            <div class="footer">
                                <a href="#" class="logout">View all notifications</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="notification-dropdown hidden-xs">
                <a href="#" class="trigger">
                    <i class="fa fa-envelope"></i>
                </a>
                <div class="pop-dialog">
                    <div class="pointer right">
                        <div class="arrow"></div>
                        <div class="arrow_border"></div>
                    </div>
                    <div class="body">
                        <a href="#" class="close-icon"><i class="glyphicon glyphicon-remove-circle"></i></a>
                        <div class="messages">
                            <a href="#" class="item">
                                <img src="{{url('project/resources/assets/dist/img/user_2.png')}}" class="display" alt="user" />
                                <div class="name">Jhane Doe</div>
                                <div class="msg">
                                Quisque commodo massa sed ipsum porttitor facilisis.
                                </div>
                                <span class="time"><i class="fa fa-clock-o"></i> 5 sec.</span>
                            </a>
                            <a href="#" class="item">
                                <img src="{{url('project/resources/assets/dist/img/user_3.png')}}" class="display" alt="user" />
                                <div class="name">Jack Daniel</div>
                                <div class="msg">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                </div>
                                <span class="time"><i class="fa fa-clock-o"></i> 37 mins.</span>
                            </a>
                            <a href="#" class="item last">
                                <img src="{{url('project/resources/assets/dist/img/user_4.png')}}" class="display" alt="user" />
                                <div class="name">Warm Sleepy</div>
                                <div class="msg">
                                Hello, how are you? i just though you were here, i'll see you tomorrow.
                                </div>
                                <span class="time"><i class="fa fa-clock-o"></i> 2 days.</span>
                            </a>
                            <div class="footer">
                                <a href="#" class="logout">View all messages</a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-xs" data-toggle="dropdown"> 
                <img class="img-circle" src="{{url('project/resources/assets/dist/img/user_1.jpg')}}" alt="avatar"> Erwin Agpasa <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="#">Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="">Sign Out</a></li>
                    </ul>
            </li>
        </ul>
    </header>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <div class="profile-hidder">
        <ul class="nav">
                    <li class="nav-profile">
                        <div class="image">
                            <a href=""><img src="{{url('project/resources/assets/dist/img/user_1.jpg')}}" alt=""></a>
                        </div>
                        <div class="info">
                            <a href="profile.html">Erwin Agpasa <b class="caret"></b></a>
                            <small>UX-UI Designer</small>
                        </div>
                    </li>
                </ul>
            </div>

        <ul id="dashboard-menu">
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a class="dropdown-toggle" href="#">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Ajout utilisateur</span><b class="caret"></b>
                </a>
                 <ul class="submenu">
                    <li><a href="{{route('affiche-client')}}">Clients</a></li>
                    <li><a href="{{route('affiche-enqueteur')}}">Enqueteurs</a></li>
                    <li><a href="{{route('affiche-administrateur')}}">Administrateurs</a></li>
                </ul>
            </li>    

            <li>
                <a href='{{route('affiche-projet')}}'>
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <span>Ajouter un projet</span>
                </a>
            </li>

            <li>
                <a  href="{{route('all-projet')}}">              
                   <i class="fa fa-eye" aria-hidden="true"></i>
                    <span>Tous les projets</span>
                </a>
            </li>



            <li>
               <a class="dropdown-toggle" href="#">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    <span>utilisateurs</span><b class="caret"></b>
                </a>
                 <ul class="submenu">
                    <li><a href="{{route('all-admin')}}">Administrateurs</a></li>
                    <li><a href="{{route('all-client')}}">Clients</a></li>
                    <li><a href="{{route('all-enqueteur')}}">Enqueteurs</a></li>

                </ul>
            </li>

            <li>
                <a href="forms.html">
                    <i class="fa fa-pencil-square-o"></i>
                    <span>Forms</span>
                </a>
            </li>

            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Other Pages</span> <b class="caret"></b>
                </a>
                <ul class="submenu">
                     <li><a href="profile.html">Profile Page</a></li>
                    <li><a href="signin.html">Sign in</a></li>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </li>

            <li>
                <a href="invoice.html">
                    <i class="fa fa-file-text-o"></i>
                    <span>Invoice</span>
                </a>
            </li>


        </ul>
    </div>
    <!-- end sidebar -->


    <!-- main container -->
    <div class="content">
        <div id="pad-wrapper">
            <h4>@yield('title')</h4>
            @yield('content')
        </div>
    </div>

<!-- scripts -->
    
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <!--<script src="{{url('project/resources/assets/js/jquery.min.js')}}"></script>-->
    <script src="{{url('project/resources/assets/js/bootstrap.js')}}"></script>
    <script src="{{url('project/resources/assets/js/theme.js')}}"></script>

    <script src="{{url('project/resources/assets/js/form/app.js')}}"></script>
    <script src="{{url('project/resources/assets/js/form/app.plugin.js')}}"></script>
    <script src="{{url('project/resources/assets/js/form/datepicker/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('project/resources/assets/js/form/slider/bootstrap-slider.js')}}"></script>
    <script src="{{url('project/resources/assets/js/form/bootstrap.file-input.js')}}"></script>    
    <script src="{{url('project/resources/assets/js/form/combodate/moment.min.js')}}"></script>
    <script src="{{url('project/resources/assets/js/form/combodate/combodate.js')}}"></script>
    <script src="{{url('project/resources/assets/js/form/parsley/parsley.min.js')}}"></script>



    <script src="{{url('project/resources/assets/js/tables/jquery.peity.min.js')}}"></script>
   <script src="{{url('project/resources/assets/js/tables/peity-demo.js')}}"></script>
    <script src="{{url('project/resources/assets/js/tables/icheck.min.js')}}"></script>

    <!--wysiwyg editor -->
    <script src="{{url('project/resources/assets/js/editor/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{url('project/resources/assets/js/editor/bootstrap3-wysihtml5.js')}}"></script>
    

    <!--<script src="{{url('project/resources/assets/js/index.js')}}"></script>-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/0.8.1/mustache.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.3/Chart.min.js"></script>
     
    
    
     
    

    <script src="{{url('project/resources/assets/js/tables/jquery.jeditable.js')}}"></script>
    <script src="{{url('project/resources/assets/js/tables/jquery.dataTables.js')}}"></script>
    <script src="{{url('project/resources/assets/js/tables/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript">
        //wysihtml5
       $('.textarea').wysihtml5({
        "font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": true, //Button to insert a link. Default true
        "image": true, //Button to insert an image. Default true,
        "color": false, //Button to change color of font
        "size": 'sm' //Button size like sm, xs etc.
    });


            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>
@yield('js')
    </body>
</html>


