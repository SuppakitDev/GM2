<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

	<title>GM2</title>
	<link rel="stylesheet" href="/pinfo/css/font-awesome/css/font-awesome.min.css" />
	<link rel="shortcut icon" href="/img/favi.ico"/>
	<link rel="stylesheet" href="/pinfo/css/bootstrap/bootstrap.min.css" />

	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">

	<link rel="stylesheet" href="/pinfo/css/style.css" />
	<link rel="stylesheet" href="/pinfo/css/style.less" />
	<link rel="stylesheet" href="/pinfo/css/responsive.css" />
	<!-- <link href="scss/style.scss" rel="stylesheet/scss" type="text/css"> -->
</head>
<body>
	<div class='preloader'><div class='loaded'>&nbsp;</div></div>
	<header id="home" class="header">
		<div class="main_menu_bg navbar-fixed-top">
			<div class="container">
				<div class="row">
				
				</div><!--End of row -->			
			</div><!--End of container -->	
		</div>
	</header> <!--End of header -->

	<section id="banner" class="banner">
		<div class="container">
			<div class="row">
				<div class="main_banner_area">
					<div class="col-md-6 col-sm-6">
						<div class="single_banner wow fadeIn">
                        <h1 id="PN">{{$productinfo->P_Name}}</h1>
							<img id="imgproductinfo"  src="/img/imgproduct/resize/{{$productinfo->P_Img}}" alt="" />
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="single_banner_text wow zoomIn" data-wow-duration="1s">           
                             <h5 id="model">Model: {{$productinfo->P_Model}}</h5><br>
                            <img id="imgspec"  src="/img/productspec/resize/{{$productinfo->spec}}"  >                         
							<p >Effective catalysts for change. Seamlessly optimize team driven catalysts for change through web services. </p>
							<div class="apps_downlod">
								<a href="/"><button id="button55" type="submit"  >Back to home page.</button></a>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</section>
	
	
	
	
	
	

	<script type="text/javascript" src="/pinfo/js/jquery/jquery.js"></script>
	
	<script type="text/javascript" src="/pinfo/js/script.js"></script>
	
	<script type="text/javascript" src="/pinfo/js/bootstrap/bootstrap.min.js"></script>
	

</body>
</html>