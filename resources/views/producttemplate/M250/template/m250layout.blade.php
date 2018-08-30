<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>m250</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
        <link rel="stylesheet" type="text/css" id="theme" href="m250/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="m250/css/M250css.css"/>
        <script type="text/javascript" src="m250/js/m250js.js"></script>    
        @yield('Stylesheet')        
        

        <script src="https://code.highcharts.com/stock/highstock.js"></script> 
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
          <link rel="stylesheet" href="https://unpkg.com/animate.css@3.5.2/animate.css" type="text/css" />

    <link rel="stylesheet" href="https://unpkg.com/rmodal@1.0.28/dist/rmodal.css" type="text/css" />
    <script type="text/javascript" src="https://unpkg.com/rmodal@1.0.26/dist/rmodal.js"></script>
    
  <link rel="stylesheet" type="text/css" href="css/sweetalert.css">                                  
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">           
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="/userfilter">m250</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="M250\img\siteimage\resize\{{$Site->SiteImg}}" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="M250\img\siteimage\resize\{{$Site->SiteImg}}" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">Site Name</div>
                                <!-- <div class="profile-data-title">Site Name</div> -->
                            </div>
                            
                        </div>                                                                        
                    </li>
                    <!--//////////////////////////////////////////////////////////-->
                    
                    <li>
                    <!-- <a href="#" id="showModal" class="btn btn-success">Show modal</a> -->
                    <a href="#" id="showModal"><span class="fa fa-list-alt" style="color:#33FFBD;" ></span><span class="xn-text">Summary Report</span><span  class="pull-right"> <img id="ReportLoader" style="height:30px;width:30px;display:none;" src="m250\img\22.gif"></span></a>
                    <style type="text/css">
      .modal .modal-dialog {
        width: 320px;
        text-align:center;
      }
    </style>
                    <script type="text/javascript">
        window.onload = function() {
            var modal = new RModal(document.getElementById('modal55'), {
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
                    <div id="modal55" class="modal">
        <div class="modal-dialog animated">
            <div class="modal-content">
                <form class="form-horizontal" method="get">
                    <div class="modal-header">
                        <strong>Summary Report</strong>
                    </div>

                    <div class="modal-body">
                    <div class="input-group">
                <div class="col-md-3" >
                <label class="col-sm-1" >Month</label>
                        <div class="input-group">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <select style="width:150px;" id="Monthreport" class="form-control" >
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
                            <select style="width:150px;" id="Yearreport" class="form-control">
                                <option value="" disabled selected>Choose year</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                            </select>
                                                                          
                        </div>                                            
                </div>
            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" onclick="modal.close();">Cancel</button>
                        <a id="exportexcelmonth" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>
                    </div>
                </form>
            </div>
        </div>
    </div>         
                    </li>
                    
                    <!--//////////////////////////////////////////////////////////-->
                    
                    <li class="xn-title" style="font-size:120%"><span class="fa fa-info-circle"></span>  Site Information</li>
                    <li class="xn">
                        <a href="#"><span class="fa fa-bolt" style="color: #ffff00"></span> <span class="xn-text">Power</span><span id="siteinfo0" class="pull-right badge badge-info"> <img style="height:20px;width:20px;" src="m250\img\pvloaddata.gif"></span> </li></a>                                              
                    </li>                    
                    <li class="xn">
                        <a href="#"><span class="fa fa-tachometer" style="color:#99ffcc" ></span> <span class="xn-text">Today's energy</span><span id="siteinfo1" class="pull-right badge badge-danger"><img style="height:20px;width:20px;" src="m250\img\pvloaddata.gif"></span></a>
                    </li>
                    <li class="xn">
                        <a href="#"><span class="fa fa-sun-o" style="color:#ff9900" ></span> <span class="xn-text">Solar radiaion</span><span id="siteinfo2" class="pull-right badge badge-success"><img style="height:20px;width:20px;" src="m250\img\pvloaddata.gif"></span></a>
                    </li>
                    <li class="xn">
                        <a href="#"><span class="glyphicon glyphicon-cloud" style="color:#66ccff" ></span> <span class="xn-text">Temperature</span><span id="siteinfo3" class="pull-right badge "><img style="height:20px;width:20px;" src="m250\img\pvloaddata.gif"></span></a>
                    </li>
                    <li class="xn-title" style="font-size:120%" ><span class="glyphicon glyphicon-th-list"></span>  Menu</li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-qrcode"></span> <span class="xn-text">Site Detail</span></a>
                        <ul>
                            <li>
                                <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
                                <div class="informer informer-danger">New</div>
                                <ul>
                                    <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
                                    <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
                                    <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
                                    <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
                                </ul> 
                            </li>
                            <li><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
                            <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
                            <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
                            <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
                            <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="tables.html"><span class="fa fa-table"></span> <span class="xn-text">Summary Report</span></a>
                        <ul>                            
                            <li><a href="table-basic.html"><span class="fa fa-align-justify"></span> Basic</a></li>
                            <li><a href="table-datatables.html"><span class="fa fa-sort-alpha-desc"></span> Data Tables</a></li>
                            <li><a href="table-export.html"><span class="fa fa-download"></span> Export Tables</a></li>                            
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-bullhorn"></span> <span class="xn-text">Promote Page</span></a>
                        <ul>                            
                            <li class="xn-openable">
                                <a href="#">Second Level</a>
                                <ul>
                                    <li class="xn-openable">
                                        <a href="#">Third Level</a>
                                        <ul>
                                            <li class="xn-openable">
                                                <a href="#">Fourth Level</a>
                                                <ul>
                                                    <li><a href="#">Fifth Level</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>                            
                        </ul>
                    </li>
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->          
            <!-- PAGE CONTENT -->
            <div class="page-content">               
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>


                     <li class="pull-right">
                        <a href="#"><span class="fa fa-bars" style="color:#33FFBD;"></span></a>
                        <ul class="xn-drop-left">
                            <li><a href="/Profile"><span class="fa fa-user"></span> Profile</a></li>
                            <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                                                    
                        </ul>
                    </li>


                    <!-- Profile setting /////////////////////////////////////////////////////-->
                       
                    <!-- Profile setting /////////////////////////////////////////////////////////-->




                    <li class="pull-right">
                    <a href="#"><span class="fa fa-cogs" style="color:#33FFBD;" ></span>Site setting</a>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging"  >                            
                            <div  style="height: 100%;"  >                                
                            <!-- multistep form -->
                                <!-- multistep form -->
                                <!-- <form id="msform"  > -->
                                {{ Form::open(array('url' => 'site/'.$Site->UserID , 'id' => 'msform','method' => 'PUT','files' => true)) }}
                                <!-- progressbar -->
                               
                                <!-- fieldsets -->
                                <fieldset>
                                    <h2 class="fs-title">PROFILE</h2>
                                    <h3 class="fs-subtitle">Site information</h3>
                                    <img src="M250\img\siteimage\resize\{{$Site->SiteImg}}" style="width=140px;height:140px;margin-bottom:15px; border-radius: 50px;" alt="">                                    
                                    <label for="sitename" class="control-label pull-left">Site Name</label>
                                    <input type="text" name="Sname" id="sitename" value="{{$Site->SiteName}}" placeholder="" />                                     
                                    <label for="img" class="control-label pull-left">Site Image</label>
                                    <input type="file" name="simage" value="Select image" id="img" alt="placeholder image" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">Detail</h2>
                                    <h3 class="fs-subtitle">Site Detail</h3>
                                    <label for="img" class="control-label pull-left">Site Capacity (kW)</label>                                    
                                    <input type="number" name="Capacity" value="{{$Site->Capacity}}" placeholder="" />
                                    <div class="row">
                                    <label for="img" class="control-label pull-left"  >Installation type :</label>                                                                        
                                    <select  name="InstallT" >
                                        <option value="{{ $Site->InstallationType }}" selected="selected">{{ $Site->InstallationType }}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                    </select>
                                    </div>
                                    <div class="row">
                                    <label for="img" class="control-label pull-left">Inverter Model :</label>                                                                                                             
                                    <select  name="Invmodel">
                                        <option value="{{ $Site->INVModel }}" selected="selected">{{ $Site->INVModel }}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                    </select>
                                    </div>
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">External Device</h2>
                                    <h3 class="fs-subtitle">Environment Sensors</h3>
                                    <label for="img"  class="control-label pull-left">Feed-in tariff (THB)</label>                                                                                                                                                 
                                    <input type="number" name="fit" value="{{$Site->FIT}}"  placeholder="" />
                                    <label for="img" class="control-label pull-left">External Device</label>
                                    <div>                                                                                                                                                                                   
                                    <input type="checkbox" id="SolarS" name="SolarS"  >Solar Radiation Sensor<br>
                                    <input type="checkbox" id="TempS" name="TempS" >Temperature Sensor<br>
                                    
                                    <script>
                                            if({{ $Site->SRI_sensor }} == 1){
                                                document.getElementById("SolarS").checked = true;
                                                document.getElementById("SolarS").value = 1;                                                 
                                                
                                            }
                                            else{
                                                document.getElementById("SolarS").checked = false;                                                 
                                                document.getElementById("SolarS").value = 0;                                                 
                                            }

                                            if({{ $Site->Temp_sensor }} == 1){
                                                document.getElementById("TempS").checked = true; 
                                                document.getElementById("TempS").value = 1;                                                 
                                                                                              
                                            }
                                            else{
                                                document.getElementById("TempS").checked = false;
                                                document.getElementById("TempS").value = 0;                                                 
                                                                                                 
                                            }
                                    </script>
                                    
                                    </div>
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="submit" name="submit" class="submit action-button" value="Submit" />
                                </fieldset>
                                <!-- </form> -->
                                {{ Form::close() }}
                            </div>                                                         
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                    <li class=" pull-right">
                        
                        <a href="/Siteinfo"><span class="fa fa-building-o" style="color:#33FFBD;" ></span>Site Detail</a>
                        
                     </li>
                    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                <!-- PAGE CONTENT WRAPPER -->
                <div id="content" class="page-content-wrap">
                @yield('content')
                </div>

               
       
        <script type="text/javascript" src="m250/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="m250/js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="m250/js/plugins/jquery/jquery-ui.min.js"></script>

        <script type="text/javascript" src="m250/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="m250/js/plugins/scrolltotop/scrolltopcontrol.js"></script>        
     
        <script type="text/javascript" src="m250/js/plugins/owl/owl.carousel.min.js"></script>   
        <script src="js/sweetalert.js"></script>                 
        @yield('Script')   
        @include('Alerts::alerts')      
    </body>
</html>


<script>
//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});



</script>

<script>
$(document).ready(function(){
    setInterval(function () 
    {
        $.ajax(
            {
                url: "/getsiteinfo",
                type: 'GET',   
            }).done( 
                function(siteinfo) 
                    {
                        console.log(siteinfo);
                        siteinfo.forEach(function(element,index) {
                            "use strict";
                        // console.log(index+"->"+element); 
                        document.getElementById("siteinfo"+index).innerHTML = element ;
                           
                    });
                    });
    }, 10000);
});
</script>
<script>
$('#exportexcelmonth').click(function() {
  $(document).bind(".mine"); 
  Monthreport = document.getElementById('Monthreport').value;
  Yearreport = document.getElementById('Yearreport').value;
    console.log(Monthreport+"-"+Yearreport);
  $.ajaxSetup({
      url: $("#exportexcelmonth").attr("href", "/Summary?Monthly="+Monthreport+"&YY="+Yearreport+"&simg={{$Site->SiteImg}}"),
      type: 'GET',
  });
  $(document).bind("ajaxStart.mine", function() {
      $('#ReportLoader').show();
  });

  $(document).bind("ajaxStop.mine", function() {
      $('#ReportLoader').hide();
      $(document).unbind(".mine");             

  });

  });
  
</script>


