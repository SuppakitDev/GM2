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
    
    <link rel="stylesheet" type="text/css" href="css/csshake.min.css">
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
                        <a href="/userfilter" id="Serial2" ></a>
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
                    
                    <li>
                    
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
                    
                    </li>
                    
                    <!--//////////////////////////////////////////////////////////-->
                    
                    <li class="xn-title" style="font-size:120%"><span class="fa fa-info-circle" style="color:#EA574B;"></span>     Site Information</li>
                    <li class="xn">
                        <a href="#"><span class="fa fa-bolt" style="color: #ffff00"></span> <span class="xn-text">Power</span><span id="power" class="pull-right badge badge-info"> <img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span> </li></a>                                              
                    </li>                    
                    <li class="xn">
                        <a href="#"><span class="fa fa-tachometer" style="color:#99ffcc" ></span> <span class="xn-text">Today's energy</span><span id="todayenergy" class="pull-right badge badge-danger"><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span></a>
                    </li>
                    <!-- <li class="xn">
                        <a href="#"><span class="fa fa-sun-o" style="color:#ff9900" ></span> <span class="xn-text">Solar radiaion</span><span id="siteinfo2" class="pull-right badge badge-success"><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span></a>
                    </li>
                    <li class="xn">
                        <a href="#"><span class="glyphicon glyphicon-cloud" style="color:#66ccff" ></span> <span class="xn-text">Temperature</span><span id="siteinfo3" class="pull-right badge "><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span></a>
                    </li> -->


                    <li class="xn-title" style="font-size:120%"><span class="fa fa-info-circle" style="color:#EA574B;"></span>  Inverter Infomation</li>
                    <li class="xn">
                        <a href="#"><span class="fa fa-tablet" style="color: #8DF58B"></span> <span class="xn-text">Inv Model</span></li></a><span style="margin-left:20%;"  class="badge badge-info xn-text" id="model"> <img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span>                                               
                    </li>                    
                    <li class="xn">
                        <a href="#"><span class="fa fa-barcode" style="color:#F5FF85" ></span> <span class="xn-text">Serial No. </span></a><span style="margin-left:20%;"  class="badge badge-danger xn-text" id="Serial" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span>
                    </li>
                    <li class="xn">
                        <a href="#"><span class="fa fa-exclamation" style="color:#ff9900" ></span> <span class="xn-text">Inv status </span></a><span style="margin-left:20%;"  class="badge badge-success xn-text" id="Status" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span>
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
                        <!-- <div id="breathing-button"> -->
                        <img id='zeroexport'  src='/img/Zeroexport3.png' height='50px' width='80px'  >
                        <!-- </div> -->
                    </li>
                    
                     <li class="pull-right">
                        <a href="#"><span class="fa fa-bars" style="color:#EA574B;"></span></a>
                        <ul class="xn-drop-left">
                            <li><a href="/Z50Profile"><span class="fa fa-user"></span> Profile</a></li>
                              <!-- แสดงเฉพาะ Manager level -->
                                @if(Auth::user()->Status == 'MANAGER')
                                    <li><a href="/Z50Managementuser"><span class="fa fa-group"></span> Management User</a></li>
                                    <li><a href="/TestNotify"><span class="glyphicon glyphicon-send"></span> LineNotify test</a></li>
                                @endif
                            <!-- แสดงเฉพาะ Manager level -->

                            <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                                                    
                        </ul>
                    </li>


                    <!-- Profile setting /////////////////////////////////////////////////////-->
                       
                    <!-- Profile setting /////////////////////////////////////////////////////////-->



                <!-- แสดงเฉพาะ Manager level -->
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
                <!-- แสดงเฉพาะ Manager level --> 
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
$(document).ready(function(){
    setInterval(function () 
    {
        $.ajax(
            {
                url: "/z50getlastdatalayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(power) 
                    {
                        console.log(power);
                        power.forEach(function(element,index) {
                            "use strict";
                        // console.log(index+"->"+element); 
                        document.getElementById("power").innerHTML = element+' kW' ;
                    });
                    });
    }, 300000);
});

$(document).ready(function(){
    setInterval(function () 
    {
        $.ajax(
            {
                url: "/z50gettodayenergylayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(energytoday) 
                    {
                        // console.log(energytoday);
                        energytoday.forEach(function(element,index) {
                            "use strict";
                        console.log("energytoday :"+element); 
                        document.getElementById("todayenergy").innerHTML = element+' kWh' ;    
                    });
                    });
    }, 300000);
});

$(document).ready(function(){
    setInterval(function () 
    {
        $.ajax(
            {
                url: "/z50getlastmodellayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(model) 
                    {
                        // console.log(model);
                        model.forEach(function(element,index) {
                            "use strict";
                        console.log("model :"+element); 
                        document.getElementById("model").innerHTML = element;
                           
                    });
                    });
    }, 300000);
});

$(document).ready(function(){
    setInterval(function () 
    {
        $.ajax(
            {
                url: "/z50getlastSeriallayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(Serial) 
                    {
                        // console.log(model);
                        Serial.forEach(function(element,index) {
                            "use strict";
                        console.log("Serial :"+element); 
                        document.getElementById("Serial").innerHTML = element;
                        document.getElementById("Serial2").innerHTML = element;
                           
                    });
                    });
    }, 300000);
});

$(document).ready(function(){
    setInterval(function () 
    {
        $.ajax(
            {
                url: "/z50getlaststatuslayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(Status) 
                    {
                        // console.log(model);
                        Status.forEach(function(element,index) {
                            "use strict";
                        console.log("Status :"+element); 
                        document.getElementById("Status").innerHTML = element;
                           
                    });
                    });
    }, 300000);

setInterval(function () 
    {
               $.ajax(
            {
                url: "/getzeroexportdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(zerodetail) 
                    {
                        switch(zerodetail) {
                                                                case "Z1":
                                                                    document.getElementById("zeroexport").setAttribute("style", "display: inline;");
                                                                    document.getElementById("zeroexport").setAttribute("class", "breathing");
                                                                    // document.getElementById("Z1"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "Z0":
                                                                    document.getElementById("zeroexport").setAttribute("style", "-webkit-filter: grayscale(100%);filter: grayscale(100%);display: inline;");
                                                                    document.getElementById("zeroexport").setAttribute("class", "");
                                                                    // document.getElementById("Z1"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "00":         
                                                                    document.getElementById("zeroexport").setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("zeroexport").setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "gray";                                                                                                                                                  
                                                            }  
                        
                    }); 
                }, 300000);

});

</script>



<script>
$(document).ready(function() {

    // /z50getlastdataDetail?SerialNo={{$serialnoz50}}&date='+today
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
$.getJSON('/z50getlastdataDetail?SerialNo={{$serialnoz50}}&date='+Daily, function(data){
console.log("last data now"+data);

//display all time label 
var datestart = new Date(today);
    datestart.setHours(05);
    datestart.setMinutes(30);
    datestart.setSeconds(00);
var start = datestart;
  console.log(start);
var datestop = new Date(today);
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
        var OnchangeDailydetailchart = new Highcharts.chart('Realtime', {
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
labels: {
            style: {
                color: '#fff'
            }
        }
},

yAxis: {
    min: 0,
    max: 5.5,
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
type: 'area',
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
            url: '/z50getlastdataDetail?SerialNo={{$serialnoz50}}&date='+Daily,
            type: 'GET',   
        }).done( 
            function(newdata) 
                {
                    OnchangeDailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                    OnchangeDailydetailchart.series[1].setData(newdata);   
                 console.log("new last data "+newdata);
                });
}, 10000);  

                });

    $.ajax(
            {
                url: "/z50getlastdatalayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(power) 
                    {
                        console.log(power);
                        power.forEach(function(element,index) {
                            "use strict";
                        // console.log(index+"->"+element); 
                        document.getElementById("power").innerHTML = element+' kW' ;
                    });
                    });

    $.ajax(
            {
                url: "/z50gettodayenergylayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(energytoday) 
                    {
                        // console.log(energytoday);
                        energytoday.forEach(function(element,index) {
                            "use strict";
                        console.log("energytoday :"+element); 
                        document.getElementById("todayenergy").innerHTML = element+' kWh' ;    
                    });
                    });

     $.ajax(
            {
                url: "/z50getlastmodellayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(model) 
                    {
                        // console.log(model);
                        model.forEach(function(element,index) {
                            "use strict";
                        console.log("model :"+element); 
                        document.getElementById("model").innerHTML = element;
                           
                    });
                    });

     $.ajax(
            {
                url: "/z50getlastSeriallayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(Serial) 
                    {
                        // console.log(model);
                        Serial.forEach(function(element,index) {
                            "use strict";
                        console.log("Serial :"+element); 
                        document.getElementById("Serial").innerHTML = element;
                        document.getElementById("Serial2").innerHTML = element;
                           
                    });
                    });

    $.ajax(
            {
                url: "/z50getlaststatuslayoutdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(Status) 
                    {
                        // console.log(model);
                        Status.forEach(function(element,index) {
                            "use strict";
                        console.log("Status :"+element); 
                        document.getElementById("Status").innerHTML = element;
                           
                    });
                    });


       $.ajax(
            {
                url: "/getstring1?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(string1) 
                    {
                        // console.log(pvarray);
                        string1.forEach(function(element,index) {
                        // console.log(index+"->"+element); 
                        document.getElementById("string1"+index).innerHTML = element;    
                        
                    });    
                       
            });  

             $.ajax(
            {
                url: "/getstring2?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(string1) 
                    {
                        // console.log(pvarray);
                        string1.forEach(function(element,index) {
                        // console.log(index+"->"+element); 
                        document.getElementById("string2"+index).innerHTML = element;    
                        
                    });    
                       
            });
            
            $.ajax(
            {
                url: "/getstring3?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(string1) 
                    {
                        // console.log(pvarray);
                        string1.forEach(function(element,index) {
                        // console.log(index+"->"+element); 
                        document.getElementById("string3"+index).innerHTML = element;    
                        
                    });    
                       
            });

               $.ajax(
            {
                url: "/getzeroexportdetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(zerodetail) 
                    {
                        switch(zerodetail) {
                                                                case "Z1":
                                                                    document.getElementById("zeroexport").setAttribute("style", "display: inline;");
                                                                    document.getElementById("zeroexport").setAttribute("class", "breathing");
                                                                    // document.getElementById("Z1"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "Z0":
                                                                    document.getElementById("zeroexport").setAttribute("style", "-webkit-filter: grayscale(100%);filter: grayscale(100%);display: inline;");
                                                                    // document.getElementById("Z1"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "00":         
                                                                    document.getElementById("zeroexport").setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("zeroexport").setAttribute("style", "display: none;");
                                                                    // document.getElementById("Z1"+index).style.color = "gray";                                                                                                                                                 
                                                            }  
                        
                    });   

                     $.ajax(
            {
                url: "/checktranfertime?SerialNo={{$serialnoz50}}",
                type: 'GET',   
            }).done( 
                function(timetranfer) 
                    {
                       console.log("Tranferstatus: "+timetranfer);
                       if(timetranfer === true)
                       {
                        closeNav();
                        
                       }
                       else if(timetranfer === false)
                       {
                        
                        openNav();
                           
                       }
                    });    
                       
            });     



// ajax
</script>
