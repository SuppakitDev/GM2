<!doctype html>
<html lang="{{ app()->getLocale() }}" >
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favi.ico"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <title>GM2</title>
<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/style.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- npprogress -->
    <script type="text/javascript" src="/pinfo/js/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/pinfo/js/script.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>


  <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Kalam:900" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=BenchNine" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/csshake.min.css">
</head>

<style>

            html,body
            {
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100%;
                margin: 0;
                padding: 0;
                background-image: url(img/bg/BG05.jpg);
                background-repeat: no-repeat;
                background-position: center center;
                background-attachment: fixed;
                -o-background-size: 100% 100%, auto;
                -moz-background-size: 100% 100%, auto;
                -webkit-background-size: 100% 100%, auto;
                background-size: 100% 100%, auto;
            }       
            .full-height 
            {
                height: 100%;;
            }
            .flex-center
            {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref 
            {
                position: relative;
            }
            .top-left 
            {
                position: absolute;
                left: 10px;
                top: 18px;
            }
            .top-right 
            {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content 
            {
                text-align: center;
            }
            .title 
            {
                font-size: 84px;
            }

            .links > a 
            {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md 
            {
                margin-bottom: 30px;
            }
            #header 
            {
                background-color: black;
                -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
                filter: alpha(opacity=80);
                -moz-opacity: 0.80;
                -khtml-opacity: 0.8;
                opacity: 0.8;
                color: white;
                top: 0;
                left: 0;
                width: 100%;
                height: 10%;
                padding: 0;
                margin: 0;
                }
            #navtext,#logout-form,#test
            {
                font-family: 'Righteous', cursive;
            }

            .preloader {
                /* position: fixed; */
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #fefefe;
                z-index: 99999;
                height: 100%;
                width: 100%;
                overflow: hidden !important;
            }
            .loaded {
                width: 70%;
                height: 70%;
                /* height: 60px; */
                position: absolute;
                left: 15%;
                top: 15%;
                background-image: url(img/load2.gif);
                background-repeat: no-repeat;
                background-position: center;
                -moz-background-size: cover;
                background-size: cover;
                margin: -20px 0 0 -20px;
            }

 
</style>

<body>
<div class='preloader'><div class='loaded'>&nbsp;</div></div>
<!-- Head laravel -->
<div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="header" style="
    margin-bottom: 0px;" >
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" id="navtext" href="{{ url('/') }}" style="color:white;" >
                        {{ 'THAI-TABUCHI ELECTRIC' }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse"  >
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right"  >
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <!-- <li  ><a style="color:white;" href="{{ route('login') }}">oldLogin</a></li>
                            <li><a style="color:white;" href="{{ route('register') }}">Register</a></li> -->
                            
                            <li><a id="test" style="color:white;" class="btn btn-link-1 launch-modal" href="#" data-modal-id="modal-register">Login</a></li>
                        @else
                            <li class="dropdown">
                            <li>
                                <a style="color:white;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->username }} 
                                </a>
</li>
                                <!-- <ul class="dropdown-menu" role="menu"> -->
                                <li><a style="color:white;" href="/userfilter">Dashboard</a></li>
                                    <li>
                                        <a  id="navtext"  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                <!-- </ul> -->
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
 <!-- MODAL -->
 <div class="modal fade" id="modal-register" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
        	<div class="modal-dialog modal-md" style="margin-top: 140px;">
        		<div class="modal-content">
        			
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal">
        					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        				</button>
        				<h3 class="modal-title" id="modal-register-label">Login</h3>
        				<p>GM2PA00604 PROJECT [Global and Local network communication]</p>
        			</div>
        			
        			<div class="modal-body">
        				
	                    <form role="form" action="{{ route('login') }}" method="post" class="registration-form">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
	                        	<input type="text" name="username" placeholder="username" class="form-first-name form-control" id="username" value="{{ old('username') }}" required autofocus >
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
	                        </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	                        	<input type="password" name="password" placeholder="Password" class="form-last-name form-control" id="password" required >
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
	                        </div>
	                        
                            <div class="form-group">
                            <div class="col-md-6 col-md-offset-4" style="margin-left: 0%;margin-bottom: 2%;" >
                            
                            <div class="g-recaptcha" data-theme="dark" data-sitekey="6LebVmsUAAAAAF6-PNwOgUu-bBhnBUP_jNvPs24e"></div>
                            
                            </div>
                        </div>

	                        <button type="submit" class="btn">Login</button>
                            <!-- <a style="color:#fd625e;" class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> -->
                        </form>
	                    
        			</div>
        			
        		</div>
        	</div>
        </div>
        
        @if ($errors->all())
        <script>
        $(document).ready(function(){
        $("#modal-register").modal();
            });
</script>
        @endif
        <!-- @yield('content') -->
    </div>
  <div class="slider-container">
  <div class="slider-control left inactive"></div>
  <div class="slider-control right"></div>
  <ul class="slider-pagi"></ul>
  <div class="slider">
  @foreach( $productdata as $product )
  @if($loop->first)
  <div class="slide slide-{{ $loop->index }} active">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 1920 768" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,520 1920,520 1920,768 0,786" />
        </svg>
        <div align="center" class="Homecontent"  >
        <div class="floating-box">
            <img class="shake shake-vertical-slow shake"  id="homeicon" src="img\Homeicon\Monitoring.png" >
            <h3 id="Texthome">Monitoring</h3> 
        </div>
        <div class="floating-box">
            <img class="shake shake-vertical-slow shake"  id="homeicon" src="img\Homeicon\Convineint.png" >
            <h3 id="Texthome" >Convenient</h3>             
        </div>
        <div class="floating-box">
            <img class="shake shake-vertical-slow shake" id="homeicon" src="img\Homeicon\Responsive.png" >
            <h3 id="Texthome">Responsive</h3>             
        </div>
        <div class="floating-box">
            <img class="shake shake-vertical-slow shake" id="homeicon" src="img\Homeicon\Protected.png">
            <h3 id="Texthome">Protected</h3>            
        </div>
        </div>
      </div>
    </div>
  @else
    <div class="slide slide-{{ $loop->index }} active">
      <div class="slide__bg"></div>
      <div class="slide__content">
        <svg class="slide__overlay" viewBox="0 0 720 405" preserveAspectRatio="xMaxYMax slice">
          <path class="slide__overlay-path" d="M0,0 150,0 500,405 0,405" />
        </svg>
        <div class="slide__text">
          <h2  class="slide__text-heading">
                {{ $product->P_Name }}
          </h2>
          <p id="model">{{$product->P_Model}}</p>
          <img id="imgprodct" width="370px" src="img\imgproduct\resize\{{$product->P_Img}}" alt="">
          <?= Form::open(array('url' => 'productinfo/'.$product->id,'method'=>'GET')) ?>
                <button class="button55" type="submit"  >Read more</button>
         {!! Form::close() !!}
        </div>
      </div>
    </div>
    @endif
    @endforeach
    
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script  src="/js/index.js"></script>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>
        
</body>
</html>