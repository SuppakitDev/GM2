<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>Z50</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
        <link rel="stylesheet" type="text/css" id="theme" href="Z50/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="Z50/css/Z50css.css"/>
        <script type="text/javascript" src="Z50/js/Z50js.js"></script>    
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

 <style>
    .breathing {
    
    -webkit-animation: breathing 1s ease-out infinite normal;
    animation: breathing 1s ease-out infinite normal;
    -webkit-font-smoothing: antialiased;
       
    }


@-webkit-keyframes breathing {
  0% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }

  25% {
    -webkit-transform: scale(1);
    transform: scale(1);
  }

  60% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }

  100% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
}

@keyframes breathing {
  0% {
    -webkit-transform: scale(0.9);
    -ms-transform: scale(0.9);
    transform: scale(0.9);
  }

  25% {
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
  }

  60% {
    -webkit-transform: scale(0.9);
    -ms-transform: scale(0.9);
    transform: scale(0.9);
  }

  100% {
    -webkit-transform: scale(0.9);
    -ms-transform: scale(0.9);
    transform: scale(0.9);
  }
}
    </style>

    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">           
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="/userfilter">OVERVIEW</a>
                        <a href="#" class="x-navigation-control" ></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="Z50\img\siteimage\resize\{{$Site->Site_img}}" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="Z50\img\siteimage\resize\{{$Site->Site_img}}" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">{{$Site->SiteName}}</div>
                                <!-- <div class="profile-data-title">Site Name</div> -->
                            </div>
                            
                        </div>                                                                        
                    </li>
                    <!--//////////////////////////////////////////////////////////-->
                    <!-- ????????? Manager level -->
                    @if(Auth::user()->Status == 'MANAGER')
                    <li>
                    <a href="#" id="showModalSUM"><span class="fa fa-list-alt" style="color:#33FFBD;" ></span><span class="xn-text">MCOT Report</span><span  class="pull-right"> <img id="ReportLoader" style="height:30px;width:30px;display:none;" src="m250\img\22.gif"></span></a>
                    @endif
                                <!-- ????????? Manager level -->
                    <style type="text/css">
      .modal .modal-dialog {
        width: 320px;
        text-align:center;
      }
    </style>
     <!-- ????????? Manager level -->
     @if(Auth::user()->Status == 'MANAGER')
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
     <script type="text/javascript">
        window.onload = function() {
            var SUMmodal = new RModal(document.getElementById('modal55'), {
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
                SUMmodal.keydown(ev);
            }, false);

            document.getElementById('showModalSUM').addEventListener("click", function(ev) {
                ev.preventDefault();
                SUMmodal.open();
            }, false);

            window.modal = SUMmodal;
        }
    </script>
        @endif
                                <!-- ????????? Manager level -->
                  
                    </li>
                    <div id="modal55" class="modal">
        <div class="modal-dialog animated">
            <div class="modal-content">
                <form class="form-horizontal" method="get">
                    <div class="modal-header">
                        <strong>MCOT Report</strong>
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
                                <option value="2020">2021</option>
                                <option value="2020">2022</option>
                            </select>
                                                                  
                        </div>                                            
                </div>
            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default" type="button" onclick="modal.close();">Cancel</button>
                        <a id="MCOTmonthly" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>
                    </div>
                </form>
            </div>
        </div>
    </div>                  
                    <!--//////////////////////////////////////////////////////////-->
                    
                    <li class="xn-title" style="font-size:120%"><span class="fa fa-info-circle" style="color:#EA574B;"></span>     Site Information</li>
                  
                    <div id="test"  >
                    
                    </div>
                    
                    
                    
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
                        <a href="#"><span class="fa fa-bars" style="color:#EA574B;"></span></a>
                        <ul class="xn-drop-left">
                            <li><a href="/Z50Profile"><span class="fa fa-user"></span> Profile</a></li>
                                <!-- ????????? Manager level -->
                                @if(Auth::user()->Status == 'MANAGER')
                            <li><a href="/Z50Managementuser"><span class="fa fa-group"></span> Management User</a></li>
                            <li><a href="/TestNotify"><span class="glyphicon glyphicon-send"></span> LineNotify test</a></li>
                                @endif
                                <!-- ????????? Manager level -->
                            <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                                                    
                        </ul>
                    </li>


                    <!-- Profile setting /////////////////////////////////////////////////////-->
                       
                    <!-- Profile setting /////////////////////////////////////////////////////////-->



                <!-- ????????? Manager level -->
                @if(Auth::user()->Status == 'MANAGER')
                    <li class="pull-right">
                    <a href="#"><span class="fa fa-cogs" style="color:#EA574B;" ></span>Site setting</a>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging"  >                            
                            <div  style="height: 100%;"  >                                
                            <!-- multistep form -->
                                <!-- multistep form -->
                                <!-- <form id="msform"  > -->
                                {{ Form::open(array('url' => 'Sitez50/'.$Site->Site_ID , 'id' => 'msform','method' => 'PUT','files' => true)) }}
                                <!-- progressbar -->
                               
                                <!-- fieldsets -->
                                <fieldset>
                                    <h2 class="fs-title">PROFILE</h2>
                                    <h3 class="fs-subtitle">Site information</h3>
                                    <img src="Z50\img\siteimage\resize\{{$Site->Site_img}}" style="width=140px;height:140px;margin-bottom:15px; border-radius: 50px;" alt="">                                    
                                    <label for="sitename" class="control-label pull-left">Site Name</label>
                                    <input type="text" name="Sname" id="sitename" value="{{$Site->SiteName}}" placeholder="" />                                     
                                    <label for="img" class="control-label pull-left">Site Image</label>
                                    <input type="file" name="simage" value="Select image" id="img" alt="placeholder image" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <h2 class="fs-title">Detail</h2>
                                    <h3 class="fs-subtitle">Site Detail</h3>
                                    <label for="FIT" class="control-label pull-left">Feed-in tariff (THB)</label>                                    
                                    <input type="FIT" name="FIT" value="{{$Site->FIT}}" placeholder="" />
                                    <label for="CO2" class="control-label pull-left">Co2_Criterion</label>                                    
                                    <input type="CO2" name="CO2" value="{{$Site->Co2_Criterion}}" placeholder="" />
                                    <label for="Capacity" class="control-label pull-left">Site Capacity</label>                                    
                                    <input type="CO2" name="Capacity" value="{{$Site->Capacity}}" placeholder="" />
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="button" name="next" class="next action-button" value="Next" />
                                </fieldset>
                                <fieldset>
                                    <label class="control-label pull-left" for="Invmodel">Inv Model</label>
                                    <select class="form-control" name="Invmodel" id="Invmodel">
                                        <option value="{{$Site->INVModel}}" selected >{{$Site->INVModel}}</option>
                                        <option value="m250">m250</option>                                                  
                                        <option value="Z50">Z50</option>                                                  
                                    </select> 
                                    <label for="Tel"  class="control-label pull-left">Tal</label>   
                                    <input id="Tel" type="Tel" class="form-control" name="Tel" value="{{$Site->Tal}}" required> 
                                    <label for="LineToken"  class="control-label pull-left">LineToken</label>   
                                    <input id="LineToken" type="text" class="form-control" name="LineToken" value="{{$Site->Notifytoken}}" required>                            
                                    <label for="address"  class="control-label pull-left">Address</label>                                                                                                                                                 
                                    <textarea rows="2" cols="50" name="Address" class="form-control"  >{{$Site->Address}}</textarea>
                                    <input type="hidden"name="SerialNo" value="{{$Site->SerialNolist}}" >
                                    <input type="hidden"name="Tel" value="{{$Site->Tal}}" >
                                    <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <input type="submit" name="submit" class="submit action-button" value="Submit" />
                                </fieldset>
                                <!-- </form> -->
                                {{ Form::close() }}
                            </div>                                                         
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                    @endif
                <!-- ????????? Manager level -->
                    <li class=" pull-right">
                        
                        <a href="/GotothisSite"><span class="fa fa-building-o" style="color:#EA574B;" ></span>My site</a>
                        
                     </li>
                    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                <!-- PAGE CONTENT WRAPPER -->
                <div id="content" class="page-content-wrap">
                @yield('content')
                </div>

               
       
        <script type="text/javascript" src="Z50/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="Z50/js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="Z50/js/plugins/jquery/jquery-ui.min.js"></script>

        <script type="text/javascript" src="Z50/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="Z50/js/plugins/scrolltotop/scrolltopcontrol.js"></script>        
    
        <script type="text/javascript" src="Z50/js/plugins/owl/owl.carousel.min.js"></script>   
       
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
$(document).ready(function() {

    
        $.ajax(
            {
                url: "/getserialnolist",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        // console.log(pvarray);
                        var container = document.getElementById("test");
                        SerialNoitem.forEach(function(serial,index) {
                        
                            container.innerHTML += "<li class='xn'><a href='Z50detail?SerialNo="+serial+"'><span id='Pcsstatus"+index+"' class='fa fa-bolt' style='color: #ffff00'></span> <span class='xn-text'>INV :"+serial+"</span><span class=''><span id='INV"+index+"'class='fa fa-circle text'></span><img id='Z1"+index+"'src='/img/Zeroexport3.png' height='33px' width='30px'  > </span></a></li>" 
                    });       
            });     
    

         $.ajax(
            {
                url: "/getstatustranfer",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        console.log(SerialNoitem);
                        
                        SerialNoitem.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "C":         
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "gray";                                                                                                                                                 
                                                            } 

                    });       
            });     
// }); 


        $.ajax(
            {
                url: "/getstatusInverter",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        // console.log(pvarray);
                        
                        SerialNoitem.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FFFF47";
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#03EBA6";                                                             
                                                                    break;
                                                                case "C":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#E4523B";
                                                                    break;
                                                                case "D":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#A6A5A1";
                                                                    break;
                                                                case "E":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#50EBC6";
                                                                    break;
                                                                case "F":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#680016";
                                                                    break;
                                                                case "G":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FF0000";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FFFFFF";                                                                                                                                                 
                                                            } 

                    });       
            });

            $.ajax(
            {
                url: "/getstatuszeroexport",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        console.log(SerialNoitem);
                        
                        SerialNoitem.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "Z1":
                                                                    document.getElementById("Z1"+index).setAttribute("style", "display: inline;");
                                                                    document.getElementById("Z1"+index).setAttribute("class", "breathing");
                                                                    // document.getElementById("Z1"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "Z0":
                                                                    document.getElementById("Z1"+index).setAttribute("style", "-webkit-filter: grayscale(100%);filter: grayscale(100%);display: inline;");
                                                                    document.getElementById("Z1"+index).setAttribute("class", "");
                                                                    // document.getElementById("Z1"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "00":         
                                                                    document.getElementById("Z1"+index).setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("Z1"+index).setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "gray";                                                                                                                                                 
                                                            }

                    });       
            });          
}); 

// });

setInterval(function () {
    $.ajax(
            {
                url: "/getstatustranfer",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        console.log(SerialNoitem);
                        
                        SerialNoitem.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "C":         
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "gray";                                                                                                                                                 
                                                            } 

                    });       
            });     
}, 300000); 

setInterval(function () {
    $.ajax(
            {
                url: "/getstatusInverter",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        // console.log(pvarray);
                        
                        SerialNoitem.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FFFF47";
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#03EBA6";                                                             
                                                                    break;
                                                                case "C":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#E4523B";
                                                                    break;
                                                                case "D":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#A6A5A1";
                                                                    break;
                                                                case "E":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#50EBC6";
                                                                    break;
                                                                case "F":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#680016";
                                                                    break;
                                                                case "G":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FF0000";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FFFFFF";                                                                                                                                                 
                                                            } 

                    });       
            }); 

                     $.ajax(
            {
                url: "/getstatuszeroexport",
                type: 'GET',   
            }).done( 
                function(SerialNoitem) 
                    {
                        console.log(SerialNoitem);
                        
                        SerialNoitem.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "Z1":
                                                                    document.getElementById("Z1"+index).setAttribute("style", "display: inline;");
                                                                    document.getElementById("Z1"+index).setAttribute("class", "breathing");
                                                                    // document.getElementById("Z1"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "Z0":
                                                                    document.getElementById("Z1"+index).setAttribute("style", "-webkit-filter: grayscale(100%);filter: grayscale(100%);display: inline;");
                                                                    document.getElementById("Z1"+index).setAttribute("class", "");
                                                                    // document.getElementById("Z1"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "00":         
                                                                    document.getElementById("Z1"+index).setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("Z1"+index).setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "gray";                                                                                                                                                 
                                                            } 

                    });       
            });     
}, 300000); 
</script>

<script>
$('#MCOTmonthly').click(function() {
  $(document).bind(".mine"); 
  Monthreport = document.getElementById('Monthreport').value;
  Yearreport = document.getElementById('Yearreport').value;
    console.log(Monthreport+"-"+Yearreport);
  $.ajaxSetup({
      url: $("#MCOTmonthly").attr("href", "/MCOTmonthly?Monthly="+Monthreport+"&YY="+Yearreport+"&SiteID={{$Site->Site_ID}}&SerialNO={{$Site->SerialNolist}}"),
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