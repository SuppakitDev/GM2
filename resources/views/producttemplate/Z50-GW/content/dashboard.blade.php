 <!-- START WIDGETS -->   
 <link href="https://fonts.googleapis.com/css?family=Chau+Philomene+One|Jua" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Yatra+One" rel="stylesheet">
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script type="text/javascript" src="Z50/js/plugins.js"></script>        
<script type="text/javascript" src="Z50/js/actions.js"></script> 

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&callback=initialize"></script>

<link rel="stylesheet" href="https://unpkg.com/animate.css@3.5.2/animate.css" type="text/css" />
 <!-- <link rel="stylesheet" href="https://unpkg.com/rmodal@1.0.28/dist/rmodal.css" type="text/css" />
 <script type="text/javascript" src="https://unpkg.com/rmodal@1.0.26/dist/rmodal.js"></script> -->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
 <script>

$(document).ready(function() {
    document.getElementById("TitleGraph").innerHTML = "Daily Productivity";
    var x1 = document.getElementById("containerrealtimeDaily");
    var x2 = document.getElementById("containerrealtimeMonthly");
    var x3 = document.getElementById("containerrealtimeYearly");
    var b1 = document.getElementById("select1");
    var b2 = document.getElementById("select2");
    var b3 = document.getElementById("select3");
    
        x1.style.display = "block";
        x2.style.display = "none";
        x3.style.display = "none";

        b1.style.display = "block";
        b2.style.display = "none";
        b3.style.display = "none";
});

function myFunction1() {
    
    document.getElementById("TitleGraph").innerHTML = "Daily Productivity";
    var x1 = document.getElementById("containerrealtimeDaily");
    var x2 = document.getElementById("containerrealtimeMonthly");
    var x3 = document.getElementById("containerrealtimeYearly");
    var b1 = document.getElementById("select1");
    var b2 = document.getElementById("select2");
    var b3 = document.getElementById("select3");
    
    x1.style.display = "block";
        x2.style.display = "none";
        x3.style.display = "none";

        b1.style.display = "block";
        b2.style.display = "none";
        b3.style.display = "none";
    
}   
function myFunction2() {
    monthlydetail();
    document.getElementById("TitleGraph").innerHTML = "Monthly Productivity";
    var x1 = document.getElementById("containerrealtimeDaily");
    var x2 = document.getElementById("containerrealtimeMonthly");
    var x3 = document.getElementById("containerrealtimeYearly");
    var b1 = document.getElementById("select1");
    var b2 = document.getElementById("select2");
    var b3 = document.getElementById("select3");
 
    x1.style.display = "none";
        x2.style.display = "block";
        x3.style.display = "none";

        b1.style.display = "none";
        b2.style.display = "block";
        b3.style.display = "none";
    
}     
function myFunction3() {
    yearlydetail();
    document.getElementById("TitleGraph").innerHTML = "Yearly Productivity";
    var x1 = document.getElementById("containerrealtimeDaily");
    var x2 = document.getElementById("containerrealtimeMonthly");
    var x3 = document.getElementById("containerrealtimeYearly");
    var b1 = document.getElementById("select1");
    var b2 = document.getElementById("select2");
    var b3 = document.getElementById("select3");
 
        x1.style.display = "none";
        x2.style.display = "none";
        x3.style.display = "block";

        b1.style.display = "none";
        b2.style.display = "none";
        b3.style.display = "block";
    
}           
</script> 
 <style>
   .animate
{
	transition: all 0.1s;
	-webkit-transition: all 0.1s;
}

.action-button
{
	position: relative;
	/* padding: 10px 40px; */
  margin: 0px 10px 10px 0px;
  float: left;
	border-radius: 7px;
	font-family: 'Pacifico', cursive;
	font-size: 10px;
	color: #FFF;
	text-decoration: none;
    width:60px;
    height: 30px;	
}

.blue
{
	background-color: #3498DB;
	border-bottom: 5px solid #2980B9;
	text-shadow: 0px -2px #2980B9;
    opacity:0.8;
}

.red
{
	background-color: #E74C3C;
	border-bottom: 5px solid #BD3E31;
	text-shadow: 0px -2px #BD3E31;
    opacity:0.8;
}

.green
{
	background-color: #82BF56;
	border-bottom: 5px solid #669644;
	text-shadow: 0px -2px #669644;
    opacity:0.8;
}

.yellow
{
	background-color: #F2CF66;
	border-bottom: 5px solid #D1B358;
	text-shadow: 0px -2px #D1B358;
}

.action-button:active
{
	transform: translate(0px,5px);
  -webkit-transform: translate(0px,5px);
	border-bottom: 1px solid;
}
   </style>  
<div  class="row">
    <div class="col-md-12" style="margin-bottom:10px;"> 
    @if(Auth::user()->Status == 'MANAGER')
        <div  class="col-md-10"style="background-color:#D1D1D1;opacity: 0.5;border-radius: 5px;"> 
    @elseif(Auth::user()->Status == 'USER')  
        <div  class="col-md-12"style="background-color:#D1D1D1;opacity: 0.5;border-radius: 5px;">
        @endif  
            <!-- <a class="weatherwidget-io" href="https://forecast7.com/en/13d55100d99/bang-pakong-district/" data-label_1="????? ???????" data-label_2="THAI TABUCHI" data-font="Verdana" data-icons="Climacons Animated" data-theme="original" data-basecolor="rgba(20, 20, 20, 0.2)" data-accent="rgba(146, 134, 134, 0)" data-textcolor="#1EAA86" data-highcolor="#ff503e" data-lowcolor="#45d7cf" data-suncolor="#fFB534" data-cloudcolor="#1EAA86" data-cloudfill="#CCCCCC" data-raincolor="#51f3df" >THAILAND WEATHER</a>
            <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
            </script>   -->
            <iframe id="showskill" frameborder="0" height="135px" width="100%" src=""></iframe>
<script>
function initialize() {
    
var geocoder = new google.maps.Geocoder();
var address = "<?=$Z50siteAddress?>" ;

geocoder.geocode( { 'address': address}, function(results, status) 
{

  if (status == google.maps.GeocoderStatus.OK) 
      {
    var latitude = results[0].geometry.location.lat();
    var longitude = results[0].geometry.location.lng();
    document.getElementById("showskill").src =
              "https://forecast.io/embed/#lat="+latitude+"&lon="+longitude+"&name=MCOT Site :%20"+"<?=$SiteName?>"+"&color=#00aaff&font=Georgia&units=ca"
      } 
}); 
}
</script>
        </div>
                              
        @if(Auth::user()->Status == 'MANAGER')
        <div class="col-md-2" style="margin-top:22px;"> 
                               
                            <a style="background-color:#F0675C;border-style: none;" id="showModal" href="#" data-toggle="modal" data-target="#myModal" class="tile tile tile-valign"><span style="font-size:80%;" class="fa fa-laptop"> Export</span></a>
                                                      
                        </div>   
        @endif
                                         
                        
    </div>

    @foreach($DATA as $DATAS) 
    <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3 class="Titlewidget" >Current output power</h3>
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 110px;">
                                        <!-- Content -->
                                        <h3 class="Textvalues" ><span style="font-size:240%;" id="Power" >{{"..."}}</span> kW</h3>

                                        <div id="Currentpower" style="height: 95%; width: 100%;"></div>
                                        <!-- Content -->                                        
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>

                            <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3>Total power generated</h3>
                                        
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 110px;">
                                      <!-- Content -->
                                      <h3 class="Textvalues" ><span style="font-size:240%;" id="Poweraccum" >{{"..."}}</span> kWh</h3>
                                        <div id="CurrentConsumption" style="height: 98%; width: 100%;"></div>
                                        <!-- Content -->   
                                </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3>Total Revenue</h3>
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 110px;">
                                    <?php 
                                        $MONEY = $accum*$FIT;
                                    ?>
                                    <h3 class="Textrevenue" ><span style="font-size:200%;" id="Revenue" ><?php echo number_format($MONEY,2) ?></span> THB</h3>
                                    <img id="revenue" src="Z50/img/revenue.png">
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3>To day's energy</h3>
                                        
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 140px;">
                                       <!-- Content -->
                                       <!-- <h3 class="Textvalues" ><span style="font-size:240%;" >2561</span> kWh</h3> -->
                                        <div id="TodayEnergy" style="height: 110%; width: 100%;"></div>
                                        <!-- Content -->   
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-8">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                           
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <ul class="panel-controls ">
                                            <li><span ><h3 id="TitleGraph"></h3></span></li>
                                            <li><input style="height:22px;margin-left:10px;" id="select1" type="date"></li>
                                            
                                            <li><input style="height:22px;margin-left:10px;" id="select2"  type="month"/></li>
                                          
                                            <li><input style="height:22px;margin-left:10px;" id="select3"  type="number" placeholder="YYYY" min="2017" max="2100"/></li>
                                        </ul>
                                       
                                    
                                                

                                    </div>
                                    <ul class="panel-controls ">
                                        <li><button class="action-button shadow animate blue  "id="button1"  onclick="myFunction1()" >Daily</button></li>
                                        <li><button class="action-button shadow animate red" id="button2" onclick="myFunction2()" >Monthly</button></li>
                                        <li><button class="action-button shadow animate green" id="button2" onclick="myFunction3()" >Yearly</button></li>                                   
                                    </ul>

                                </div>
                                <div class="panel-body padding-0 z50panel">
                                   
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 140px;">
                                    <div id="containerrealtimeDaily" style="height:100%;width:100%" ></div>
                                    <div id="containerrealtimeMonthly" style="height:100%;width:100%" ></div>
                                    <div id="containerrealtimeYearly" style="height:100%;width:100%" ></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3>CO2 avoided</h3>
                                        
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 120px;">
                                    <!-- content -->
                                    <?php 
                                        $CO2 = $accum*$Co2_Criterion;
                                    ?>
                                    <img id="CO2" src="Z50/img/green-energy.svg">
                                    <h3 class="TextCo2" ><span style="font-size:350%;" id="COtwo"><?php echo number_format($CO2,2) ?></span>  kg</h3>
                                    <!-- content -->
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3>System Ratio</h3>
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                              
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                    
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel"  style="height: 120px;">
                                    <!-- content -->
                                    <div id="container-donut" style="height: 95%"></div>
                                    <!-- content -->
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-4">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">
                                <div class="panel-heading ">
                                    <div class="panel-title-box ">
                                        <h3>Location</h3>
                                        
                                    </div>
                                    <ul class="panel-controls ">
                                        <li><a href="#" class="panel-fullscreen "><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh "><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle " data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu ">
                                                <li><a href="#" class="panel-collapse "><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove "><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>
                                </div>

                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 120px;">
                                    <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas" src="https://maps.google.com/maps?q=<?php echo $Z50siteAddress ?>&t=k&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div><a href="https://www.crocothemes.net"></a><style>.mapouter{overflow:hidden;height:100%;width:100%;}.gmap_canvas {background:none!important;height:100%;width:100%;}</style></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        

                        
</div> 
@endforeach   
<style type="text/css">
      .modal .modal-dialog {
        width: 320px;
        text-align:center;
      }
    </style>
<!-- Modal -->
<script type="text/javascript">
        window.onload = function() {
            var modal = new RModal(document.getElementById('myModal'), {
                //content: 'Abracadabra'
                beforeOpen: function(next) {
                    console.log('beforeOpen');
                    next();
                }
                , afterOpen: function() {
                    console.log('opened');
                }

                , beforeClose: function(next) {
                    console.log('beforeClose');
                    next();
                }
                , afterClose: function() {
                    console.log('closed');
                }
                // , bodyClass: 'modal-open'
                // , dialogClass: 'modal-dialog'
                // , dialogOpenClass: 'animated fadeIn'
                // , dialogCloseClass: 'animated fadeOut'

                // , focus: true
                // , focusElements: ['input.form-control', 'textarea', 'button.btn-primary']

                // , escapeClose: true
            });

            document.addEventListener('keydown', function(ev) {
                modal.keydown(ev);
            }, false);

            document.getElementById('showModal').addEventListener("click", function(ev) {
                ev.preventDefault();
                modal.open();
            }, false);

            window.modal = modal;
        }
    </script>
<div class="modal fade" id="myModal" role="dialog">
		  <div class="modal-dialog modal-lg">
			<div class="modal-content">
			  <div class="modal-body">
              <div class="col-md-12">                        
                            <!-- START JUSTIFIED TABS -->
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#tab8" data-toggle="tab">Daily</a></li>
                                    <li><a href="#tab9" data-toggle="tab">Monthly</a></li>
                                    <li><a href="#tab10" data-toggle="tab">Yearly</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab8">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Select Date</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="Date"  id="ZDayExport" class="form-control" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        <br>
                                        <a id="Zexportday" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>
                                        </div>
                                       
                                    </div>
                                    
                                    </div>
                                    <div class="tab-pane" id="tab9">
                                    <div class="input-group">
                <div class="col-md-3" >
                <label class="col-sm-1" >Month</label>
                        <div class="input-group">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <select style="width:150px;" id="ZMonthExport" class="form-control" >
                                <option value="" disabled selected>Choose month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>                                                    
                <label class="col-sm-1">Year</label>
                        <div class="input-group"  >
                            <span class="input-group-addon add-on"><span class="fa fa-calendar-o"></span></span>
                            <select style="width:150px;" id="ZYearExport" class="form-control">
                                <option value="" disabled selected>Choose year</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                            </select>
                                                                          
                        </div>   
                        <br>
                                        <a id="Zexportmonth" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>                                         
                </div>
            </div>
                                    </div>
                                    <div class="tab-pane" id="tab10">
                                        <div class="input-group">
                                            <div class="col-md-3" >
                                                                                        
                                            <label class="col-sm-1">Year</label>
                                                    <div class="input-group"  >
                                                        <span class="input-group-addon add-on"><span class="fa fa-calendar-o"></span></span>
                                                        <select style="width:150px;" id="ZYear2Export" class="form-control">
                                                            <option value="" disabled selected>Choose year</option>
                                                            <option value="2017">2017</option>
                                                            <option value="2018">2018</option>
                                                            <option value="2019">2019</option>
                                                            <option value="2020">2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                        </select>
                                                                                                    
                                                    </div>                                            
                                            </div>
                                        </div>
                                        <br>
                                        <a id="Zexportyear" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>
                                    </div>                        
                                </div>
                            </div>                                         
                            <!-- END JUSTIFIED TABS -->
                        </div>                     
                        
			  </div>
			  <div class="modal-footer">
				
			  </div>
			</div>
		  </div>
		</div>
	  </div>             
<script>
// Current power chart
$(function () {  
 // ajax request first data to power chart
$.getJSON('/z50getlastpowerchart', function(powerdata){
    var powerdata =  powerdata.reverse();
    console.log(powerdata); 
    Highcharts.setOptions({                                           
        global : {
            useUTC : false
        },
        exporting: {
         enabled: false
},
colors: ['#1fd160']
    });  
    var chartpower = new Highcharts.Chart({
        chart:{
            renderTo: 'Currentpower',
            margin:[15, 10, 0, 90],
            backgroundColor:'transparent',
        },
        title:{
            text:''
        },
        credits:{
            enabled:false
        },
        xAxis:{
            labels:{
                enabled:false
            }
        },
        yAxis:{
            maxPadding:0,
            minPadding:0,
            gridLineWidth: 0,
            endOnTick:false,
            labels:{
                enabled:false
            },
            title: {
        text: null
    }
        },
        legend:{
            enabled:false
        },
        tooltip:{
            enabled:false
        },
        plotOptions:{
            series:{
                enableMouseTracking:true,
                lineWidth:1.5,
                shadow:false,
                states:{
                    hover:{
                        lineWidth:1
                    }
                },
                marker:{
                    radius:2,
                    states:{
                        hover:{
                            radius:2
                        }
                    }
                }
            }
        },
        series: [{type:'spline',
            data:  powerdata
        }]
    
    }); 
// Request new power data for chart  
setInterval(function () {
    $.ajax(
            {
                url: '/z50getlastpowerchart',
                type: 'GET',   
            }).done( 
                function(newpowerdata) 
                    {
                        var newpowerdata =  newpowerdata.reverse();
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        chartpower.series[0].setData(newpowerdata);   
                     console.log(newpowerdata);
                    });
}, 300000);    
});
});

// Current Consumption chart
$(function () {
     // ajax request first data to power chart
$.getJSON('/z50getlastpoweraccumchart', function(poweraccumdata){
    var poweraccumdata =  poweraccumdata.reverse();
    console.log(poweraccumdata); 
    Highcharts.setOptions({                                           
        global : {
            useUTC : true
        },
        exporting: {
         enabled: false
},
colors: ['#ea3959']
    });
    
    var chartpoweraccum = new Highcharts.Chart({
        chart:{
            renderTo: 'CurrentConsumption',
            margin:[20, 10, 0, 90],
            backgroundColor:'transparent'
        },
        title:{
            text:''
        },
        credits:{
            enabled:false
        },
        xAxis:{
            labels:{
                enabled:false
            }
        },
        yAxis:{
            maxPadding:0,
            minPadding:0,
            gridLineWidth: 0,
            endOnTick:false,
            labels:{
                enabled:false
            },
            title: {
        text: null
    }
        },
        legend:{
            enabled:false
        },
        tooltip:{
            enabled:false
        },
        plotOptions:{
            series:{
                enableMouseTracking:true,
                lineWidth:1.5,
                shadow:false,
                states:{
                    hover:{
                        lineWidth:1
                    }
                },
                marker:{
                    //enabled:false,
                    radius:2,
                    states:{
                        hover:{
                            radius:2
                        }
                    }
                }
            }
        },
        series: [{type:'spline',
            data: poweraccumdata
        }]
    
    });  
    // Request new power data for chart  
setInterval(function () {
    $.ajax(
            {
                url: '/z50getlastpoweraccumchart',
                type: 'GET',   
            }).done( 
                function(newpoweraccumdata) 
                    {
                        var newpoweraccumdata =  newpoweraccumdata.reverse();
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        chartpoweraccum.series[0].setData(newpoweraccumdata);   
                     console.log(newpoweraccumdata);
                    });
}, 300000);    
});
});

// To day's Energy chart

var gaugeOptions = {

chart: {
    type: 'solidgauge',
    backgroundColor:'transparent',
    
},
exporting: {
                        enabled: false
                    },

title: null,

pane: {
    center: ['50%', '85%'],
    size: '140%',
    startAngle: -90,
    endAngle: 90,
    background: {
        // backgroundColor:'transparent',
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
    }
},

tooltip: {
    enabled: false
},

// the value axis
yAxis: {
    stops: [
        [0.1, '#D81D53'], // red
        [0.5, '#FFFF78'], // yellow
        [0.9, '#09FF99'] // green
    ],
    lineWidth: 0,
    minorTickInterval: null,
    tickAmount: 2,
    title: {
        y: -70
    },
    labels: {
        y: 16
    }
},

plotOptions: {
    solidgauge: {
        dataLabels: {
            y: 5,
            borderWidth: 0,
            useHTML: true
        }
    }
}
};

// The speed gauge
$.getJSON('z50gettodayenergy', function (energytoday1) {

var chartSpeed = Highcharts.chart('TodayEnergy', Highcharts.merge(gaugeOptions, {
yAxis: {
    min: 0,
    max: {{$Capacity}},
    title: {
        text: null
    }
},

credits: {
    enabled: false
},

series: [{
    name: 'Speed',
    data: energytoday1,
    // data: [80],
    dataLabels: {
        format: '<div style="text-align:center"><span style="font-size:20px;color:' +
            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || '#fff') + '">{y}</span><br/>' +
               '<span style="font-size:12px;color:silver">kWh</span></div>'
    },
    tooltip: {
        valueSuffix: ' kWh'
    }
}]

}));



// Bring life to the dials
setInterval(function () {
// Speed
var point,
    newVal,
    inc;

if (chartSpeed) {
    point = chartSpeed.series[0].points[0];
   
    $.getJSON('z50gettodayenergy', function (energytoday) {
                                        console.log("Energy to day :"+energytoday);  
                                        newVal = energytoday;
    point.update(newVal);
})
}

// RPM

}, 300000);
});


</script>
<!-- Request new  data into text display -->
<script>  
//  Request new power data into text display 
     setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastpower",
                type: 'GET',   
                }).done( 
                function(lastpower) 
                    {
                        lastpower.forEach(function(element,index) 
                        {
                        console.log("Power: "+element); 
                        document.getElementById("Power").innerHTML = element ;
                        });      
                    }
                );
    }, 300000);

//  Request new power accum into text display 
         setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastpoweraccum",
                type: 'GET',   
                }).done( 
                function(lastpoweraccum) 
                    {
                        lastpoweraccum.forEach(function(element,index) 
                        {
                        console.log("Poweraccum: "+element); 
                        document.getElementById("Poweraccum").innerHTML = element ;
                        });      
                    }
                );
    }, 300000);

    //  Request new power accum into text display 
    setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastRevenue",
                type: 'GET',   
                }).done( 
                function(lastRevenue) 
                    {
                        lastRevenue.forEach(function(element,index) 
                        {
                        console.log("Total Revenue: "+(element*{{$FIT}}).toFixed(2)); 
                        document.getElementById("Revenue").innerHTML = (element*{{$FIT}}).toFixed(2);
                        });      
                    }
                );
    }, 300000);

    //  Request new CO2 Avoided into text display 
    setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastpoweraccum",
                type: 'GET',   
                }).done( 
                function(lastCO2) 
                    {
                        lastCO2.forEach(function(element,index) 
                        {
                        console.log("CO2: "+(element*{{$Co2_Criterion}}).toFixed(2)); 
                        document.getElementById("COtwo").innerHTML = (element*{{$Co2_Criterion}}).toFixed(2);
                        });      
                    }
                );
    }, 300000);
            
</script>

<script>
 
</script>

<script>
$.getJSON('/z50getinvoverview', function (InvOverview) {   
    Highcharts.setOptions({
        colors: ['#2BFA7F', '#86F09F', '#53DBAE', '#14CC82', '#3D9974','#33CCB5','#E5FF69']
    });
var chartdonut = Highcharts.chart('container-donut', {
    chart: {
        type: 'pie',
        
        backgroundColor:'transparent',
        margin:[20, 0, 5, 0],
        options3d: {
            enabled: true,
            alpha: 45
        }
        
    },
    exporting: {
        enabled: false
    },
    credits: {
        enabled: false
    },
    title: {
        text: null
    },
    subtitle: {
        text: null
    },
    plotOptions: {
        pie: {
            innerSize: 40,
            depth: 40
        }
    },
    series: [{
        data: InvOverview
    }]
});


setInterval(function () {



if (chartdonut) {
    
    $.getJSON('z50getinvoverview', function (newInvOverview) {
        chartdonut.series[0].setData(newInvOverview);                           
})
}

// RPM

}, 300000);
});
</script>

<!-- Export dayly button -->
<script>
$('#Zexportday').click(function() 
    {
        ZDayExport = document.getElementById('ZDayExport').value;
            console.log("ZDate export: "+ZDayExport);
        $.ajaxSetup({
            url: $("#Zexportday").attr("href", "/Z50ZExportday?ZDay="+ZDayExport),
            type: 'GET',
        });
       
    });


$('#Zexportmonth').click(function() 
    {
        ZMonthExport = document.getElementById('ZMonthExport').value;
        ZYearExport = document.getElementById('ZYearExport').value;
            console.log("ZMonth export: "+ZDayExport);
            console.log("ZYear export: "+ZYearExport);
        $.ajaxSetup({
            url: $("#Zexportmonth").attr("href", "/Z50ZExportmonth?ZMonth="+ZMonthExport+"&ZYear="+ZYearExport),
            type: 'GET',
        });
       
    });

$('#Zexportyear').click(function() 
    {
        ZYear2Export = document.getElementById('ZYear2Export').value;
            console.log("ZYear export: "+ZYear2Export);
        $.ajaxSetup({
            url: $("#Zexportyear").attr("href", "/Z50ZExportyear?ZYear="+ZYear2Export),
            type: 'GET',
        });
       
    });
</script>

<script>
setInterval(function () {
    // Console.log("Operated in UpdateSumFunction");

    $.ajax(
            {
                url: '/Updatesumofdata',
                type: 'GET',   
            }).done( 
                );

}, 250000); 
</script>

<script>

$(document).ready(function() {
    // Console.log("Operated in UpdateSumFunction");

    $.ajax(
            {
                url: '/Updatesumofdata',
                type: 'GET',   
            }).done( 
                );

});
       
</script>


<!-- ???????????????????????????????????????????? -->

<script>
// Input day,month,year



// Button



// Highchart

//  Chart Daily
function dailydetail(){
    var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
            } 
        if(mm<10){
            mm='0'+mm;
            } 
        var Daily = yyyy+'-'+mm+'-'+dd;
    // document.getElementById("daily").value = Daily;

console.log(Daily);
var today = new Date();
var ddT = today.getDate();
var mmT = today.getMonth()+1; //January is 0!
var yyyyT = today.getFullYear();

if(ddT<10) {
    ddT = '0'+ddT
} 

if(mmT<10) {
    mmT = '0'+mmT
} 
today = yyyyT + '-' + mmT+ '-' + ddT  ;
// ajax
$.getJSON('/z50getlastdata?date='+today, function(data){
console.log("last data"+data);

//display all time label 
var datestart = new Date(Daily);
    datestart.setHours(05);
    datestart.setMinutes(30);
    datestart.setSeconds(0);
var start = datestart;
  console.log(start);
var datestop = new Date(Daily);
    datestop.setHours(18);
    datestop.setMinutes(59);
    datestop.setSeconds(00);
var stop = datestop;
  console.log(stop);

Highcharts.setOptions({
        colors: ['#44CC9B'],
        global: {
            useUTC: false,
        },
        });
        var Dailydetailchart = new Highcharts.chart('containerrealtimeDaily', {
chart: {
zoomType: 'x',
margin:[50, 0, 40, 10],
backgroundColor:'transparent',
// height:'330px',
},
title: {
text: null
},

xAxis: {
title: {
    text: 'Hours'
},
type: 'datetime',
ordinal: false,
startOnTick: true,
endOnTick: true,
minPadding: 0,
maxPadding: 0,
tickInterval: 60 * 1000,
/* minTickInterval: 60 * 1000 */
},

yAxis: {
min:0, 
title: {
    text: null
}
},
legend: {
enabled: false
},
title: {
                        text: null
                    },
credits: {
                        enabled: false
                    },
                    exporting: {
                        enabled: false
                    },
plotOptions: {
    series: {
            borderColor: 'transparent'
        },
    area: {
    fillColor: {
        linearGradient: {
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1
        },
        stops: [
            [0, Highcharts.getOptions().colors[0]],
            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
        ]
    },
    marker: {
        radius: 2
    },
    lineWidth: 1,
    states: {
        hover: {
            lineWidth: 1
        }
    },
    threshold: null
}
},

series: [{
type: 'column',
name: 'Power',
data: [{"x":start,"y":null},{"x":stop,"y":null}]
},{
type: 'column',
name: 'Power',
data: data 
}]
});
setInterval(function () {
$.ajax(
        {
            url: '/z50getlastdata?date='+today,
            type: 'GET',   
        }).done( 
            function(newdata) 
                {
                    Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                    Dailydetailchart.series[1].setData(newdata);   
                 console.log("new last data "+newdata);
                });
}, 30000);  
});
}


</script>
<!-- When change  -->

<script>
$('#select1').on('change',function(e){
    var Daily = e.target.value;

// ajax
$.getJSON('/z50getlastdata?date='+Daily, function(data){
console.log("last data"+data);

//display all time label 
var datestart = new Date(Daily);
    datestart.setHours(05);
    datestart.setMinutes(30);
    datestart.setSeconds(0);
var start = datestart;
  console.log(start);
var datestop = new Date(Daily);
    datestop.setHours(18);
    datestop.setMinutes(59);
    datestop.setSeconds(00);
var stop = datestop;
  console.log(stop);

Highcharts.setOptions({
        colors: ['#44CC9B'],
        
        global: {
            useUTC: false,
        },
        });
        var OnchangeDailydetailchart = new Highcharts.chart('containerrealtimeDaily', {
chart: {
zoomType: 'x',
margin:[50, 0, 40, 10],
backgroundColor:'transparent',
// height:'330px',
},
title: {
text: null
},

xAxis: {
title: {
    text: 'Hours'
},
type: 'datetime',
ordinal: false,
startOnTick: true,
endOnTick: true,
minPadding: 0,
maxPadding: 0,
tickInterval: 60 * 1000,
/* minTickInterval: 60 * 1000 */
},

yAxis: {
min:0, 
title: {
    text: null
}
},
legend: {
enabled: false
},
title: {
                        text: null
                    },
credits: {
                        enabled: false
                    },
                    exporting: {
                        enabled: false
                    },
plotOptions: {
    series: {
            borderColor: 'transparent'
        },
area: {
    fillColor: {
        linearGradient: {
            x1: 0,
            y1: 0,
            x2: 0,
            y2: 1
        },
        stops: [
            [0, Highcharts.getOptions().colors[0]],
            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
        ]
    },
    marker: {
        radius: 2
    },
    lineWidth: 1,
    states: {
        hover: {
            lineWidth: 1
        }
    },
    threshold: null
}
},

series: [{
type: 'column',
name: 'Power',
data: [{"x":start,"y":null},{"x":stop,"y":null}]
},{
type: 'column',
name: 'Power',
data: data
}]
});
setInterval(function () {
$.ajax(
        {
            url: '/z50getlastdata?date='+Daily,
            type: 'GET',   
        }).done( 
            function(newdata) 
                {
                    OnchangeDailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                    OnchangeDailydetailchart.series[1].setData(newdata);   
                 console.log("new last data "+newdata);
                });
}, 300000);  
});
});
</script>

<!-- Chart Monthly -->

<script>

            $('#select2').on('change',function(e){
                var date = new Date($('#select2').val());
                month = date.getMonth() + 1;
                year = date.getFullYear();

            console.log(month);
            console.log(year);

            // ajax
            $.getJSON('/getMonthlydataZ50?Monthly='+month+'&YY='+year, function(data){
                console.log(data);
                Highcharts.setOptions({
                colors: ['#6CF3C8'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
                
                var OnchangeMonthlydetailchart = new Highcharts.chart('containerrealtimeMonthly', {
                    chart: {
                        zoomType: 'x',
                        // height:'330px',
                        backgroundColor:'transparent',
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        title: {
                            text: null
                        },
                        type: 'datetime',
                        ordinal: false,
                        startOnTick: false,
                        endOnTick: false,
                        minPadding: 0,
                        maxPadding: 0,
                        // tickInterval:  24*3600*1000,
                        categories: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
                        
                    },
                
                    yAxis: {
                        title: {
                            text: 'Energy (kWh)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions:{
                        series: {
            pointWidth: 13,
           
            borderColor:'#ff6161',
            borderWidth: 1.5,
            color: '#6CF3C8',
        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Power',
                        dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                            },
                        data: data,
                        color: 'transparent',
                    },
                    {
                        type: 'column',
                        name: 'Power',
                        data: [[1,null],[31,null]],
                        color: 'transparent',
                        borderColor:'#ff6161',
            borderWidth: 1.5,
                        dataLabels: {
                            enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                                    },
                    }]
                    });
                    setInterval(function () {
            $.ajax(
            {
                url: '/getMonthlydataZ50?Monthly='+month+'&YY='+year,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        OnchangeMonthlydetailchart.series[0].setData([[1,null],[31,null]]);   
                        OnchangeMonthlydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
                });
            });

                </script>
<script>
 function monthlydetail(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
        } 
    if(mm<10){
        mm=mm;
        } 
    var month = mm;
    var year = yyyy;
    // document.getElementById("monthly").value = month-year;
            console.log(month);
            console.log(year);

            // ajax
            $.getJSON('/getMonthlydataZ50?Monthly='+month+'&YY='+year, function(data){
                console.log(data);
                Highcharts.setOptions({
                colors: ['#44CC9B'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
                var Monthlydetailchart = new Highcharts.chart('containerrealtimeMonthly', {
                    chart: {
                        zoomType: 'x',
                        // height:'330px',
                        backgroundColor:'transparent',
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        title: {
                            text: null
                        },
                        type: 'datetime',
                        ordinal: false,
                        startOnTick: false,
                        endOnTick: false,
                        minPadding: 0,
                        maxPadding: 0,
                        // tickInterval:  24*3600*1000,
                        categories: ['1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
                        
                    },
                
                    yAxis: {
                        title: {
                            text: 'Power (kWh)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions:{
                        series: {
            pointWidth: 13,
           
            borderColor:'#ff6161',
            borderWidth: 1.5,
            color: '#6CF3C8',
        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Power',
                        dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                            },
                        data: data,
                        color: 'transparent',
                    },
                    {
                        type: 'column',
                        name: 'Power',
                        data: [[1,null],[31,null]],
                        color: 'transparent',
                        borderColor:'#ff6161',
            borderWidth: 1.5,
                        dataLabels: {
                            enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                                    },
                    }]
                    });
                    setInterval(function () {
            $.ajax(
            {
                url: '/getMonthlydataZ50?Monthly='+month+'&YY='+year,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Monthlydetailchart.series[0].setData([[1,null],[31,null]]);   
                        Monthlydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
                });
            }
</script>

<!-- chart yearly -->

<script>

  $('#select3').on('change',function(e){
        var Yearly = e.target.value;
        console.log(Yearly);
// ajax
$.getJSON('/getYearlydataZ50?Yearly='+Yearly, function(data){
    console.log(data);
    Highcharts.setOptions({
                colors: ['transparent'],
                
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
            var OnchangeYearlydetailchart = new Highcharts.chart('containerrealtimeYearly', {
        chart: {
            zoomType: 'x',
            // height:'330px',
            backgroundColor:'transparent',
        },
        title: {
            text: 'Yearly Power Graph'
        },
  
        xAxis: {
            title: {
                text: null
            },
            type: 'datetime',
            ordinal: false,
            startOnTick: false,
            endOnTick: false,
            minPadding: 0,
            maxPadding: 0,
            // tickInterval: 31 * 24 * 3600 * 1000,
            categories : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        },
    
        yAxis: {
            title: {
                text: 'Energy (kWh)'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions:{
                        series: {
            pointWidth: 13,
           
            borderColor:'#19f07a',
            borderWidth: 1.5,
            color: '#24f050',
        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Power',
                        dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                            },
                        data: data,
                        color: 'transparent',
                    },
                    {
                        type: 'column',
                        name: 'Power',
                        data: [[0,null],[11,null]],
                        color: 'transparent',
                        borderColor:'#19f07a',
            borderWidth: 1.5,
                        dataLabels: {
                            enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                                    },
                    }]
                    });
        setInterval(function () {
            $.ajax(
            {
                url: '/getYearlydataZ50?Yearly='+Yearly,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        OnchangeYearlydetailchart.series[0].setData([[0,null],[11,null]]);   
                        OnchangeYearlydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000);
    });
});

                </script>
<script>
function yearlydetail(){
    var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!

            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd;
                } 
            if(mm<10){
                mm='0'+mm;
                } 
            var Yearly = yyyy;
        document.getElementById("select3").value = Yearly;
        console.log(Yearly);
// ajax
$.getJSON('/getYearlydataZ50?Yearly='+Yearly, function(data){
    console.log(data);
    mb = {{1}};
    inv = {{1}};
    console.log(mb);
    console.log(inv);
    Highcharts.setOptions({
                colors: ['tramsparent'],
                global: {
                    useUTC: false
                },
                lang: {
        thousandsSep: ','
    }
                });
                var Yearlydetailchart = new Highcharts.chart('containerrealtimeYearly', {
        chart: {
            zoomType: 'x',
            // height:'',
            backgroundColor:'transparent',

        },
        title: {
            text: null
        },
  
        xAxis: {
            title: {
                text: null
            },
            type: 'datetime',
            ordinal: false,
            startOnTick: false,
            endOnTick: false,
            minPadding: 0,
            maxPadding: 0,
            // tickInterval: 31 * 24 * 3600 * 1000,
            categories : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        },
    
        yAxis: {
            title: {
                text: 'Energy (kWh)'
            }
        },
        legend: {
            enabled: false
        },
        plotOptions:{
                        series: {
            pointWidth: 13,
           
            borderColor:'#19f07a',
            borderWidth: 1.5,
            color: '#24f050',
        }
                    },
                    series: [{
                        type: 'column',
                        name: 'Power',
                        dataLabels: {
                                enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                            },
                        data: data,
                        color: 'transparent',
                    },
                    {
                        type: 'column',
                        name: 'Power',
                        data: [[0,null],[11,null]],
                        color: 'transparent',
                        borderColor:'#19f07a',
            borderWidth: 1.5,
                        dataLabels: {
                            enabled: true,
                                color: '#FFFFFF',
                                borderColor:null,
                                    },
                    }]
                    });
        setInterval(function () {
            $.ajax(
            {
                url: '/getYearlydataZ50?Yearly='+Yearly,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Yearlydetailchart.series[0].setData([[0,null],[11,null]]);   
                        Yearlydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
    });
}
</script>

<!-- ???????????????????????????????????????????? -->

<script>
$(document).ready(function() {
    dailydetail();

     $.ajax(
                {
                url: "/z50getlastpower",
                type: 'GET',   
                }).done( 
                function(lastpower) 
                    {
                        lastpower.forEach(function(element,index) 
                        {
                        console.log("Power: "+element); 
                        document.getElementById("Power").innerHTML = element ;
                        });      
                    }
                );
    
    $.ajax(
                {
                url: "/z50getlastpoweraccum",
                type: 'GET',   
                }).done( 
                function(lastpoweraccum) 
                    {
                        lastpoweraccum.forEach(function(element,index) 
                        {
                        console.log("Poweraccum: "+element); 
                        document.getElementById("Poweraccum").innerHTML = element ;
                        });      
                    }
                );
});
</script>


