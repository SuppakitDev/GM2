 <!-- START WIDGETS -->   
 <script type="text/javascript" src="m250/js/plugins.js"></script>        
        <script type="text/javascript" src="m250/js/actions.js"></script> 
 <div class="row">
                        <a style="margin-bottom:10px;margin-top:10px;" class="weatherwidget-io" href="https://forecast7.com/en/15d87100d99/thailand/" data-label_1="THAILAND" data-label_2="WEATHER" data-font="Play" data-icons="Climacons Animated" data-theme="hexellence" data-sunColor="#e78d17" data-cloudFill="rgba(187, 246, 232, 0.35)" >THAILAND WEATHER</a>
                        <script>
                            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://weatherwidget.io/js/widget.min.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","weatherwidget-io-js");
                        </script>
                        <div class="col-md-3">   
                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-carousel" style="height:20px;" >
                                <div class="owl-carousel" id="owl-example" >
                                    <div>                                    
                                        <div class="widget-title">Power</div>                                                                        
                                        <div class="widget-int"><span class="fa fa-bolt" style="color: #f5f300"></div>
                                        <div class="widget-int"><p id="siteinfod0"  ><img style="height:40px;width:40px;" src="M250\img\pvloaddata.gif"></p></div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Today's energy</div>
                                        <div class="widget-int"><span class="fa fa-tachometer" style="color:#00e673" ></div>
                                        <div class="widget-int"><p id="siteinfod1"><img style="height:40px;width:40px;" src="M250\img\pvloaddata.gif"></p></div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Solar radiation</div>
                                        <div class="widget-int"><span class="fa fa-sun-o" style="color:#ff9900" ></span></div>
                                        <div class="widget-int"><p id="siteinfod2"><img style="height:40px;width:40px;" src="M250\img\pvloaddata.gif"></p></div>
                                    </div>
                                    <div>                                    
                                        <div class="widget-title">Temperature</div>
                                        <div class="widget-int"><span class="glyphicon glyphicon-cloud" style="color:#66ccff" ></span></div>
                                        <div class="widget-int"><p id="siteinfod3"><img style="height:40px;width:40px;" src="M250\img\pvloaddata.gif"></p></div>
                                    </div>
                                </div>                            
                              
                            </div>         
                            <!-- END WIDGET SLIDER -->
                            
                        </div>
                        <div class="col-md-6">
                            <div class="widget widget-info widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-building-o"></span>
                                </div>
                                <div class="widget-data">
                                    <div style="padding-top:10px;" class="widget-int num-count">Model : M250</div>
                                    <div class="widget-title">Type : Solar Rooftop</div>
                                    <div class="widget-title">Spect : Capacity 75 kW</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>
                        </div>
                        <!--  -->
                        <div class="col-md-3">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-warning widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
                    </div>
                     <div class="row">
						<div class="col-md-12">
                            
                            <!-- START SALES BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                    
                                    <ul class="panel-controls panel-controls-title">                                        
                                        <li>
                                        <div class="form-group">
                                        <button href="##" type="button" class="btn btn-success btn-rounded bactive ">
                                        <span class="fa fa-clock-o"></span> Real-time</button>
                                        <button onclick="Daily()" type="button" class="btn btn-info btn-rounded ">Daily</button>
                                        <button onclick="Monthly()" type="button" class="btn btn-warning btn-rounded">Monthly</button>
                                        <button onclick="Yearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button>
                                    </div>
                                        </li>                                
                                        <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
                                    </ul>                                    
                                    
                                </div>
                                <div class="panel-body">                                    
                                <div id="container" style="height=790px" ></div>
                            <button id="large">Large</button>
                            <button id="small">Small</button>
                            <button id="auto">Auto</button>                                
                                </div>
                            </div>
                            <!-- END SALES BLOCK -->
                            
                        </div>
                    <!-- END WIDGETS --> 
                    </div>                
                    <script>
     
            // ajax call page conent
            function Daily(){
                $.ajax(
                {
                    url: "/getDaily",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.por').html(data.html);
                    }
                );
                }
            function Monthly(){
                $.ajax(
                {
                    url: "/getMonthly",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.por').html(data.html);
                    }
                );
                }
            function Yearly(){
                $.ajax(
                {
                    url: "/getYearly",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.por').html(data.html);
                    }
                );
                }
     
            // Chart respon
            var url = "{{url('/getlivedata')}}";
                $(document).ready(function(){ //เปิด JS
                $.get(url, function(data){ //รับค่าจาก response
                seriesData = data;
                // console.log("live: "+seriesData);
            function requestData() 
                {
                $.ajax({
                url: '/getlastdata',
                success: function(point) {
                    // console.log("last: "+point);
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
                    useUTC: false
                },
                });
                // Create the chart
                var chart = Highcharts.stockChart('container', {

                    chart: {
                        width: 1080,
                        type: 'spline',
                        animation: Highcharts.svg, // don't animate in old IE
                        marginRight: 10,
                        events: {
                            load: requestData
                        }
                    },
                    title: {
                        text: 'Power chart'
                    },
                    rangeSelector: {
                        enabled: false
                    },

                    subtitle: {
                        text: 'The chart shows the relationship between all power of inverters and time in a day.'
                    },
                    exporting: {
                        enabled: true
                    },
                    series: [{
                        name: 'Power',
                        data: seriesData,
                        type: 'area',
                    }],

                    responsive: {
                        rules: [{
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                chart: {
                                    height: 300
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


                $('#small').click(function () {
                    chart.setSize(400);
                });

                $('#large').click(function () {
                    chart.setSize(800);
                });

                $('#auto').click(function () {
                    chart.setSize(null);
                });

                $(document).ready(function(){ 
	                $('#auto').trigger('click'); 
        });
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
                        // console.log(index+"->"+element); 
                        document.getElementById("siteinfod"+index).innerHTML = element ;
                           
                    });
                    });
    }, 10000);
});
</script>
