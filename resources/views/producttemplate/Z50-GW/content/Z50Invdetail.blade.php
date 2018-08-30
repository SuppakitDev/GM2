@extends('producttemplate.Z50-GW.template.z50layoutinside')
@section('content')

 <!-- START WIDGETS -->   
 <link href="https://fonts.googleapis.com/css?family=Chau+Philomene+One|Jua" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Yatra+One" rel="stylesheet">
 <script type="text/javascript" src="Z50/js/plugins.js"></script>    
 
 <link rel="stylesheet" href="https://unpkg.com/animate.css@3.5.2/animate.css" type="text/css" />


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&callback=initialize"></script> 

 <link rel="stylesheet" href="https://unpkg.com/rmodal@1.0.28/dist/rmodal.css" type="text/css" />
 <script type="text/javascript" src="https://unpkg.com/rmodal@1.0.26/dist/rmodal.js"></script>   
 <script type="text/javascript" src="Z50/js/actions.js"></script> 
<div class="row">
    <div class="col-md-12" style="margin-bottom:10px;"> 
    <div  class="col-md-10"style="background-color:#D1D1D1;opacity: 0.5;border-radius: 5px;">   
            <!-- <a class="weatherwidget-io" href="https://forecast7.com/en/13d55100d99/bang-pakong-district/" data-label_1="อำเภอ บางปะกง" data-label_2="THAI TABUCHI" data-font="Verdana" data-icons="Climacons Animated" data-theme="original" data-basecolor="rgba(20, 20, 20, 0.2)" data-accent="rgba(146, 134, 134, 0)" data-textcolor="#1EAA86" data-highcolor="#ff503e" data-lowcolor="#45d7cf" data-suncolor="#fFB534" data-cloudcolor="#1EAA86" data-cloudfill="#CCCCCC" data-raincolor="#51f3df" >THAILAND WEATHER</a>
            <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
            </script>   -->
            <iframe id="showskill" frameborder="0" height="135px" width="100%" src=""></iframe>

        </div>
                              
        
        <div class="col-md-2" style="margin-top:10px;"> 
                               
                            <a style="background-color:#F0675C;border-style: none;" href="#" id="showModal" data-toggle="modal" data-target="#myModal" class="tile tile tile-valign"><span style="font-size:80%;" class="fa fa-laptop"> Export</span></a>
                                                      
                        </div>   
                                         
                        
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
                                        <h3 class="Textvalues" ><span style="font-size:240%;" id="Power" >{{$DATAS->RT_powerout}}</span> kW</h3>
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
                                         <h3>Total power generate</h3>
                                        
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
                                      <h3 class="Textvalues" ><span style="font-size:240%;" id="Poweraccum" >{{$DATAS->RT_poweraccum}}</span> kWh</h3>
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
                                        $MONEY = $DATAS->RT_poweraccum*$FIT;
                                    ?>
                                    <h3 class="Textrevenue" style="padding-left:45%;padding-top:5%;" ><span style="font-size:200%;" id="Revenue" ><?php echo number_format($MONEY,2) ?></span> THB</h3>
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
                                    
                                        <h3>Graph</h3>
                                    </div>
                                    <!--<ul class="panel-controls ">-->
                                    <!--<div class="form-group ">-->
                                    <!--    <button href="##" type="button" class="btn btn-success btn-rounded bactive ">-->
                                    <!--    <span class="fa fa-clock-o"></span> Real-time</button>-->
                                    <!--    <button onclick="Daily()" type="button" class="btn btn-info btn-rounded ">Daily</button>-->
                                    <!--    <button onclick="Monthly()" type="button" class="btn btn-warning btn-rounded">Monthly</button>-->
                                    <!--    <button onclick="Yearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button>-->
                                    <!--</div>                                  -->
                                    <!--</ul>-->
                                </div>
                                <div class="panel-body padding-0 z50panel">
                                   
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 140px;">
                                    <div id="Realtime" style="height:100%;width:100%" ></div>
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
                                        $CO2 = $DATAS->RT_poweraccum*0.498;
                                    ?>
                                    <img id="CO2" src="Z50/img/green-energy.svg">
                                    <h3 class="TextCo2" ><span style="font-size:350%;" id="COtwo"><?php echo number_format($CO2,2) ?></span>  kg</h3>
                                    <!-- content -->
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-5">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">

                              
                                <div class="panel-body padding-0 z50panel" style="height:152px;">
                                <div class="table-responsive">
                                        <table class="table table-bordered" style="height:100%">
                                            <thead style="color:#fff" >
                                                <tr >
                                                    <td align="center" style="background-color:transparent;font-size:15px;" width="20%">PV Input</td>
                                                    <td align="center" style="background-color:transparent;font-size:15px;" width="30%">Voltage</td>
                                                    <td align="center" style="background-color:transparent;font-size:15px;" width="30%">Current</td>
                                                    <td align="center" style="background-color:transparent;font-size:15px;" width="20%">Power</td>
                                                </tr>
                                            </thead>
                                            <tbody >                           
                                                <tr style="color:#fff" >
                                                <?php
                                                $value = 250;
                                                $persen = ($value/450)*100;
                                                ?>
                                                    <td ><strong>String 1</strong></td>
                                                    <td align="center" >
                                                    <span id="string10" style="font-size:15px;color:#37FFAE;" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span><span  style="font-size:15px;color:#37FFAE;"> / 450 V. </span>
                                                        
                                                    </td>
                                                    <td align="center">
                                                    <span id="string11" style="font-size:15px;color:#FFEE6B;" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span><span  style="font-size:15px;color:#FFEE6B;"> / 10 A.</span>  
                                                        
                                                    </td>
                                                    <td>
                                                    <div  style="font-size:15px;color:#00EAF5;" class="pull-right">kw. </div>
                                                    <div id="string12" align="center" style="font-size:15px;color:#00EAF5;" >
                                                    <img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif">
                                                    </div>
                                                    </td>
                                                </tr> 
                                                <tr style="color:#fff" >
                                                <td ><strong>String 2</strong></td>
                                                    <td align="center" >
                                                    <span id="string20" style="font-size:15px;color:#37FFAE;" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span><span  style="font-size:15px;color:#37FFAE;"> / 450 V. </span>
                                                        
                                                    </td>
                                                    <td align="center">
                                                    <span id="string21" style="font-size:15px;color:#FFEE6B;" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span><span  style="font-size:15px;color:#FFEE6B;"> / 10 A.</span>  
                                                        
                                                    </td>
                                                    <td>
                                                    <div  style="font-size:15px;color:#00EAF5;" class="pull-right">kw. </div>
                                                    <div id="string22" align="center" style="font-size:15px;color:#00EAF5;" >
                                                    <img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif">
                                                    </div>
                                                    </td>
                                                </tr>    
                                                <tr style="color:#fff" >
                                                <td ><strong>String 3</strong></td>
                                                    <td align="center" >
                                                    <span id="string30" style="font-size:15px;color:#37FFAE;" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span><span  style="font-size:15px;color:#37FFAE;"> / 450 V. </span>
                                                        
                                                    </td>
                                                    <td align="center">
                                                    <span id="string31" style="font-size:15px;color:#FFEE6B;" ><img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif"></span><span  style="font-size:15px;color:#FFEE6B;"> / 10 A.</span>  
                                                        
                                                    </td>
                                                    <td>
                                                    <div  style="font-size:15px;color:#00EAF5;" class="pull-right">kw. </div>
                                                    <div id="string32" align="center" style="font-size:15px;color:#00EAF5;" >
                                                    <img style="height:20px;width:20px;" src="Z50\img\pvloaddata.gif">
                                                    </div>
                                                    </td>
                                                </tr>                                                                                                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START VISITORS BLOCK -->
                            <div class="panel panel-default z50panel ">

                                <div class="panel-body padding-0 z50panel">
                                    <div class="chart-holder z50panel" id="dashboard-donut-1" style="height: 155px;">                  
                                    <li class="xn">
                                       
                                        <span class="fa fa-tachometer" style="color:#99ffcc;margin-top:5%;" ></span> <span class="xn-text" style="color:#fff">ERROR CODE</span><span id="##" class="pull-right badge badge-danger"></span>
                                        <br><p style="margin-left:40%" class="badge badge-danger" id="getInverror" >{{$DATAS->error_codes->Descript}}</p>

                                    </li>
                                    <li class="xn">
                                    @foreach($DATA2 as $DATA2S) 
                                        <span class="fa fa-sun-o" style="color:#ff9900" ></span> <span class="xn-text"  style="color:#fff">SUPPRESSION</span><span id="##" class="pull-right badge badge-success"></span>
                                        <br><p style="margin-left:40%" class="badge badge-danger"  id="getInvsuppression">{{$DATA2S->suppression_descripts->Descript}}</p>
                                    </li>
                                    @endforeach
                                    <li class="xn">
                                        <span class="glyphicon glyphicon-cloud" style="color:#66ccff" ></span> <span class="xn-text"  style="color:#fff">RECOVERY TIME</span><span id="##" class="pull-right badge "></span>
                                        <br><p style="margin-left:40%" class="badge badge-danger" id="getInvrecoverytime">{{$DATAS->Recoverytime}}</p>
                                    </li>
                                    </div>
                                </div>
                            </div>
                            <!-- END VISITORS BLOCK -->
                            
                        </div>
                      

                        
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
                                                <input type="Date"  id="DetailDayExport" class="form-control" />
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        <br>
                                        <a id="Detailexportday" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>
                                        </div>
                                       
                                    </div>
                                    
                                    </div>
                                    <div class="tab-pane" id="tab9">
                                    <div class="input-group">
                <div class="col-md-3" >
                <label class="col-sm-1" >Month</label>
                        <div class="input-group">
                            <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                            <select style="width:150px;" id="DetailMonthExport" class="form-control" >
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
                            <select style="width:150px;" id="DetailYearExport" class="form-control">
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
                                        <a id="Detailexportmonth" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>                                         
                </div>
            </div>
                                    </div>
                                    <div class="tab-pane" id="tab10">
                                        <div class="input-group">
                                            <div class="col-md-3" >
                                                                                        
                                            <label class="col-sm-1">Year</label>
                                                    <div class="input-group"  >
                                                        <span class="input-group-addon add-on"><span class="fa fa-calendar-o"></span></span>
                                                        <select style="width:150px;" id="DetailYear2Export" class="form-control">
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
                                        <a id="Detailexportyear" class="btn btn-primary" type="button" onclick="modal.close();">Export</a>
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
	               
<script>
// Current power chart
$(function () {  
 // ajax request first data to power chart
$.getJSON('/z50getlastpowerchartDetail?SerialNo={{$serialnoz50}}', function(powerdata){
    var powerdata =  powerdata.reverse();
    console.log(powerdata); 
    Highcharts.setOptions({                                           
        global : {
            useUTC : true
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
                url: '/z50getlastpowerchartDetail?SerialNo={{$serialnoz50}}',
                type: 'GET',   
            }).done( 
                function(newpowerdata) 
                    {
                        var newpowerdata =  newpowerdata.reverse();
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        chartpower.series[0].setData(newpowerdata);   
                     console.log(newpowerdata);
                    });
}, 10000);    
});
});

// Current Consumption chart
$(function () {
     // ajax request first data to power chart
$.getJSON('/z50getlastpoweraccumchartDetail?SerialNo={{$serialnoz50}}', function(poweraccumdata){
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
                url: '/z50getlastpoweraccumchartDetail?SerialNo={{$serialnoz50}}',
                type: 'GET',   
            }).done( 
                function(newpoweraccumdata) 
                    {
                        var newpoweraccumdata =  newpoweraccumdata.reverse();
                        // Dailydetailchart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        chartpoweraccum.series[0].setData(newpoweraccumdata);   
                     console.log(newpoweraccumdata);
                    });
}, 10000);    
});
});

// To day's Energy chart

var gaugeOptions = {

chart: {
    renderTo: 'TodayEnergy',
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
        [0.1, '#DF5353'], // green
        [0.5, '#DDDF0D'], // yellow
        [0.9, '#55BF3B'] // red
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
$.getJSON('z50gettodayenergyDetail?SerialNo={{$serialnoz50}}', function (energytoday1) {

var chartSpeed = Highcharts.chart(Highcharts.merge(gaugeOptions, {
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
   
    $.getJSON('z50gettodayenergyDetail?SerialNo={{$serialnoz50}}', function (energytoday) {
                                        console.log("Energy to day :"+energytoday);  
                                        newVal = energytoday;
    point.update(newVal);
})
}

// RPM

}, 10000);
});

 // Chart respon
 var url = "{{url('/z50getlivedataDetail?SerialNo=$serialnoz50')}}";
                $(document).ready(function(){ //เปิด JS
                $.get(url, function(data){ //รับค่าจาก response
                seriesData = data;
                // console.log("live: "+seriesData);
            function requestData() 
                {
                $.ajax({
                url: '/z50getlastdataDetail?SerialNo={{$serialnoz50}}',
                success: function(point) {
                    console.log("last: "+point);
                var series = chart.series[0],
                    shift = series.data.length > 60; 

                chart.series[0].addPoint(point, true, shift);
 
                setTimeout(requestData, 10000);    
                        },
                cache: false
            });
            }       
                Highcharts.setOptions({
                    
                colors: ['#59f7bc'],
                global: {
                    useUTC: true
                },
                });
                // Create the chart
                var chart = Highcharts.stockChart('Realtime', {

                    chart: {
                        // width: 1080,
                        type: 'spline',
                        margin:[50, 0, 40, 10],
                       
                        backgroundColor:'transparent',
                      
                        animation: Highcharts.svg, // don't animate in old IE
                        marginRight: 10,
                        events: {
                            load: requestData
                        }
                    },
                    title: {
                        text: null
                    },

                    rangeSelector: {
                        enabled: false
                    },
                    navigator:{
                enabled: false
            },
            scrollbar :{
                enabled: false
            },
                    subtitle: {
                        text: null
                    },
                    exporting: {
                        enabled: false
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Power',
                        data: seriesData,
                        type: 'spline',
                    }],

                    responsive: {
                        rules: [{
                            condition: {
                                // maxWidth: 500
                            },
                            chartOptions: {
                                chart: {
                                    // height: 300
                                },
                                subtitle: {
                                    text: null
                                },
                                xAxis: {
                                    type: 'datetime',
                                    dateTimeLabelFormats: {
                                      day: "%e. %b",
                                      month: "%b '%y",
                                      year: "%Y"
                                    }
                                  },
                                navigator: {
                                    enabled: false
                                }
                            }
                        }]
                    }
                });

    });
});
</script>
<!-- Request new  data into text display -->
<script>  
//  Request new power data into text display 
     setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastpowerDetail?SerialNo={{$serialnoz50}}",
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
    }, 10000);

//  Request new power accum into text display 
         setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastpoweraccumDetail?SerialNo={{$serialnoz50}}",
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
    }, 10000);

    //  Request new power accum into text display 
    setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastRevenueDetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
                }).done( 
                function(lastRevenue) 
                    {
                        lastRevenue.forEach(function(element,index) 
                        {
                        console.log("Total Revenue: "+(element*132.93).toFixed(2)); 
                        document.getElementById("Revenue").innerHTML = (element*132.93).toFixed(2);
                        });      
                    }
                );
    }, 10000);

    //  Request new CO2 Avoided into text display 
    setInterval(function () {
            $.ajax(
                {
                url: "/z50getlastpoweraccumDetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
                }).done( 
                function(lastCO2) 
                    {
                        lastCO2.forEach(function(element,index) 
                        {
                        console.log("CO2: "+(element*0.498).toFixed(2)); 
                        document.getElementById("COtwo").innerHTML = (element*0.498).toFixed(2);
                        });      
                    }
                );
    }, 10000);
            
</script>

<script>
                setInterval(function () {
        // getdetail 
            $.ajax(
                {
                url: "/getInverrorDetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
                }).done( 
                function(invstatus) 
                    {
                        // console.log(invarray);

                        invstatus.forEach(function(element,index) 
                        {
                        console.log("error :"+element); 
                        document.getElementById("getInverror").innerHTML = element ;
                        });      
                    }
                );
    }, 10000);

                    setInterval(function () {
        // getdetail 
            $.ajax(
                {
                url: "/getInvsuppressionDetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
                }).done( 
                function(invstatus) 
                    {
                        // console.log(invarray);

                        invstatus.forEach(function(element,index) 
                        {
                        console.log("suppression :"+element); 
                        document.getElementById("getInvsuppression").innerHTML = element ;
                        });      
                    }
                );
    }, 10000);

                 setInterval(function () {
        // getdetail 
            $.ajax(
                {
                url: "/getInvrecoverytimeDetail?SerialNo={{$serialnoz50}}",
                type: 'GET',   
                }).done( 
                function(invstatus) 
                    {
                        // console.log(invarray);

                        invstatus.forEach(function(element,index) 
                        {
                        console.log("recoverytime :"+element); 
                        document.getElementById("getInvrecoverytime").innerHTML = element ;
                        });      
                    }
                );
    }, 10000);
            </script>

            <script>
        setInterval(function () {
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
    }, 10000);

            setInterval(function () {
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
    }, 10000);

            setInterval(function () {
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
    }, 10000);
            </script>

            <!-- <script>
// เพื่อทำการ insert ข้อมูลลง ตาราง Sum_of_z50info
setInterval(function () {
    $.ajax(
            {
                url: '/Insertsumofdata',
                type: 'GET',   
            }).done( 

                );
}, 300000); 
</script>

<script>

$(document).ready(function() {
    $.ajax(
            {
                url: '/Insertsumofdata',
                type: 'GET',   
            }).done( 
                
                );
});
       
</script> -->
<!-- Export dayly button -->
<script>
$('#Detailexportday').click(function() 
    {
        
        DetailDayExport = document.getElementById('DetailDayExport').value;
            console.log("Date export: "+DetailDayExport);
        $.ajaxSetup({
            url: $("#Detailexportday").attr("href", "/Z50Exportdaydetail?SerialNo={{$serialnoz50}}&Day="+DetailDayExport),
            type: 'GET',
        });
       
    });


$('#Detailexportmonth').click(function() 
    {
        DetailMonthExport = document.getElementById('DetailMonthExport').value;
        DetailYearExport = document.getElementById('DetailYearExport').value;
            console.log("Month export: "+DetailDayExport);
            console.log("Year export: "+DetailYearExport);
        $.ajaxSetup({
            url: $("#Detailexportmonth").attr("href", "/Z50Exportmonthdetail?SerialNo={{$serialnoz50}}&Month="+DetailMonthExport+"&Year="+DetailYearExport),
            type: 'GET',
        });
       
    });

$('#Detailexportyear').click(function() 
    {
        DetailYear2Export = document.getElementById('DetailYear2Export').value;
            console.log("Year export: "+DetailYear2Export);
        $.ajaxSetup({
            url: $("#Detailexportyear").attr("href", "/Z50Exportyeardetail?SerialNo={{$serialnoz50}}&Year="+DetailYear2Export),
            type: 'GET',
        });
       
    });
</script>
@endsection

<script>

function btnclose()
   {
       document.getElementById("myNav").outerHTML = "";  
   }

 setInterval(function () {
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
    }, 1000);



</script>
<style>



.overlay {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 5;
    top: 50;
    left: 0;
    right: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);
    overflow-x: hidden;
    transition: 0.5s;
}

.overlay-content {
    position: relative;
    top: 15%;
    width: 100%;
    text-align: center;
    margin-top: 30px;
}

.overlay a {
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }
}

</style>
<div id="myNav" class="overlay">
  <a href="javascript:void(0)" id="closebbt" class="closebtn" onclick="closeNav(),btnclose()">&times;</a>
  <div class="overlay-content">
  <img  src="Z50/img/tranferfinal.gif" height="50%" width="50%">
  <h3 style="color:#fff">INV: {{$serialnoz50}} missing data over time!!<span><a href="userfilter">Back</a></span></h3>
  
  </div>
</div>



<script>
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    
}
</script>
<script>
setInterval(function () {
    $.ajax(
            {
                url: '/Updatesumofdata',
                type: 'GET',   
            }).done( 

                );
}, 300000); 
</script>

<script>

$(document).ready(function() {
    $.ajax(
            {
                url: '/Updatesumofdata',
                type: 'GET',   
            }).done( 
                
                );
});
       
</script>


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
