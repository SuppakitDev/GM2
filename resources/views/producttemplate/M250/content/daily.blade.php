<!-- START WIDGETS --> 
                    <div class="row" style="margin-top:10px" >
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
                        <div class="col-md-3">                  
                            <a id="exporterrorday" href="#"  class="tile tile-danger">
                            <img id="Loaddererror" style="height:70px;width:100px;display:none;" src="M250\img\loadererror.gif"> 
                            <span class="fa fa-warning"></span>
                                <p>Error log</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-warning"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-3">                        
                            <a id="exportexcelday" href="#" class="tile tile-success">
                            <img id="Loadder" style="height:70px;width:100px;display:none;" src="M250\img\loader.gif"> 
                            <span class="fa fa-file-text-o"></span>
                                <p>Download CSV</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-file-text-o"></span></div>
                            </a>                        
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
                                        <div class="col-md-3">
                                            <div class="input-group">
                                                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                                                <input id="daily" type="date" class="form-control datepicker"/>                                                
                                            </div>                                            
                                        </div>
                                        <div class="form-group pull-right">
                                        <a href="/userfilter" class="btn btn-success btn-rounded" ><span class="fa fa-clock-o"></span> Real-time</a>
                                        <!-- <button href="##" type="button" class="btn btn-success btn-rounded bactive ">
                                            <span class="fa fa-clock-o"></span> Real-time</button> -->
                                            <button onclick="daily()" type="button" class="btn btn-info btn-rounded bactive ">Daily</button>
                                            <button onclick="Monthly()" type="button" class="btn btn-warning btn-rounded">Monthly</button>
                                            <button onclick="Yearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button>
                                    </div>
                                        </li>                                
                                        <!-- <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li> -->
                                    </ul>                                    
                                    
                                </div>
                                

                                <div class="panel-body">                                    
                                <div id="container" style="height=790px" ></div>  
                                </div>
                            </div>
                            <!-- END SALES BLOCK -->
                            
                        </div>
                    <!-- END WIDGETS --> 
                    
                    <script>
                    
           
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


    $('#daily').on('change',function(e){

    var Daily = e.target.value;
    console.log(Daily);
    
    // ajax
    $.getJSON('/getDailydata?Daily='+Daily, function(data){
        console.log(data);
        //display all time label 
    var datestart = new Date(Daily);
        datestart.setHours(0);
        datestart.setMinutes(0);
        datestart.setSeconds(0);
    var start = datestart;
      console.log(start);
    var datestop = new Date(Daily);
        datestop.setHours(23);
        datestop.setMinutes(59);
        datestop.setSeconds(0);
    var stop = datestop;
      console.log(stop);
      var OnchangeDailychart = new Highcharts.chart('container', {
    chart: {
        zoomType: 'x'
    },
    title: {
        text: 'Daily Power Graph'
    },
    subtitle: {
        text: document.ontouchstart === undefined ?
        'Energy : xxx kWh  |  Solar radiation (Max) : xx W/m2  |  Avg Temp : x.x °C' : 'Pinch the chart to zoom in'
    },
    xAxis: {
        title: {
            text: 'Hours'
        },
        type: 'datetime',
        ordinal: false,
        startOnTick: false,
        endOnTick: false,
        minPadding: 0,
        maxPadding: 0,
        tickInterval: 60 * 1000,
        /* minTickInterval: 60 * 1000 */
    },

    yAxis: {
        min:0,
        title: {
            text: 'Power (kW)'
        }
    },
    legend: {
        enabled: false
    },
    plotOptions: {
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
        type: 'area',
        name: 'Power',
        turboThreshold:null,        
        data: data
    }]
});
setInterval(function () {
    $.ajax(
            {
                url: '/getDailydata?Daily='+Daily,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        OnchangeDailychart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        OnchangeDailychart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
}, 60000); 
});
});
                </script>

<script>

        function daily(){
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
        document.getElementById("daily").value = Daily;

console.log(Daily);

// ajax
$.getJSON('/getDailydata?Daily='+Daily, function(data){
    console.log(data);
    //display all time label 
    var datestart = new Date(Daily);
        datestart.setHours(0);
        datestart.setMinutes(0);
        datestart.setSeconds(0);
    var start = datestart;
      console.log(start);
    var datestop = new Date(Daily);
        datestop.setHours(23);
        datestop.setMinutes(59);
        datestop.setSeconds(0);
    var stop = datestop;
      console.log(stop);

    Highcharts.setOptions({
            colors: ['#44CC9B'],
            global: {
                useUTC: false
            },
            });
var Dailychart = new Highcharts.chart('container', {
    
chart: {
    zoomType: 'x',
    height:'330px',
    
},
title: {
    text: 'Daily Power Graph'
},

xAxis: {
    title: {
        text: 'Hours'
    },
    type: 'datetime',
    ordinal: false,
    startOnTick: false,
    endOnTick: false,
    minPadding: 0,
    maxPadding: 0,
    
    tickInterval: 60 * 1000,
    /* minTickInterval: 60 * 1000 */
    
},

yAxis: {
    min:0,
    
    title: {
        text: 'Power (kW)'
    }
},
legend: {
    enabled: false
},
plotOptions: {
    
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
    }
},

series: [{
    type: 'area',
    name: 'Power',
    data: [{"x":start,"y":null},{"x":stop,"y":null}]
},
{
    type: 'area',
    name: 'Power',
    data: data
}

]
});

  setInterval(function () {
    $.ajax(
            {
                url: '/getDailydata?Daily='+Daily,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Dailychart.series[0].setData([{"x":start,"y":null},{"x":stop,"y":null}]);   
                        Dailychart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
}, 60000);  

});

}

</script>
<script>

$('#exporterrorday').click(function() {
  
  $(document).bind(".mine"); 
  Dateerror = document.getElementById('daily').value;

  $.ajaxSetup({
      url: $("#exporterrorday").attr("href", "/exporterrorday?date="+Dateerror),
      type: 'GET',
  });
  $(document).bind("ajaxStart.mine", function() {
      $('#Loaddererror').show();
  });

  $(document).bind("ajaxStop.mine", function() {
      $('#Loaddererror').hide();
      $(document).unbind(".mine");             

  });
  });

</script>
<script>

$('#exportexcelday').click(function() {
  
  $(document).bind(".mine"); 
  Dateexcel = document.getElementById('daily').value;

  $.ajaxSetup({
      url: $("#exportexcelday").attr("href", "/ExportexcelDay?date="+Dateexcel),
      type: 'GET',
  });
  $(document).bind("ajaxStart.mine", function() {
      $('#Loadder').show();
  });

  $(document).bind("ajaxStop.mine", function() {
      $('#Loadder').hide();
      $(document).unbind(".mine");             

  });
  });
                        
</script>


<script>
$(document).ready(function() {
    daily();
})
</script>