<!-- START WIDGETS --> 
<div class="row">

						<div class="col-md-12">
                            <!-- START SALES BLOCK -->                
                            <div class="panel panel-default">
                                <div class="panel-heading">                                    
                                    <ul class="panel-controls panel-controls-title">       
                                    <li>
                                   
                                        <div class="form-group">
                                        <div class="col-md-3">
                                            <div class="input-group" >
                                                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                                                
                                                <input style="width:85%" id="daily" type="date" class="form-control datepicker"/>                                                
                                               
                                            </div>  
                                                                                   
                                        </div>
                                        <div class="form-group pull-right">
                                            <img  id="Loadingexcel" style="height:5%;width:10%;display:none;" src="M250\img\loadingcall.gif">     
                                            <!-- <a class="btn btn-success" id="exportexceldaydetail"><i class="glyphicon glyphicon-cloud-download"></i>CSV download</a>  -->
                                            <!-- <img  id="Loadingerror" style="height:5%;width:10%;display:none;" src="M250\img\loadingcall.gif">                                                -->
                                            <!-- <a id="exporterrordaydetail"  class="btn btn-danger"><i class="fa fa-exclamation-triangle"></i> Error log</a>                                                 -->
                                            <!-- <button onclick="dailydetail()" type="button" class="btn btn-info btn-rounded bactive ">Daily</button> -->
                                            <!-- <button onclick="InvDetailmonthly()" type="button" class="btn btn-warning btn-rounded">Monthly</button> -->
                                            <!-- <button onclick="InvDetailyearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button> -->
                                           
                                    </div>
                                        </li>  
                                        <li>
                                        </li>                              
                                        <!-- <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li> -->
                                    </ul>                                    
                                    
                                </div>
                                

                                <div class="panel-body">                                    
                                <div id="container" style="height=500px" ></div>              
                        </div>
                    <!-- END WIDGETS --> 
                    
                    <script>
                     // ajax call page conent
                //      function InvDetaildaily(){
                // $.ajax(
                // {
                //     url: "/InvDetaildaily?MB={{$MB}}&INV={{$INV}}",
                //     type: 'GET',
                // }).done( 
                //     function(data) 
                //     {
                //         $('.Invchart').html(data.html);
                //     }
                // );
                // }
            function InvDetailmonthly(){
                $.ajax(
                {
                    url: "/Debugmonthly?MB={{$MB}}&INV={{$INV}}",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.Invchart').html(data.html);
                    }
                );
                }
            function InvDetailyearly(){
                $.ajax(
                {
                    url: "/Debugyearly?MB={{$MB}}&INV={{$INV}}",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.Invchart').html(data.html);
                    }
                );
                }


// $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) {
    $('#daily').on('change',function(e){

    var Daily = e.target.value;
    console.log(Daily);
    
    // ajax
    $.getJSON('/getDailyDebug?Daily='+Daily+'&MB={{$MB}}&INV={{$INV}}', function(data){
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
var OnchangeDailydetailchart = new Highcharts.chart('container', {
    chart: {
        zoomType: 'x',
        height:'500px',
    },
    title: {
        text: 'Daily Debug Graph'
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
            text: 'Energy (kW)'
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

    series: [
    {
    type: 'column',
    name: 'Power',
    data: []
},{
        type: 'column',
        name: 'Power',
        turboThreshold:null,
        data: data
    }]
});
setInterval(function () {
    $.ajax(
            {
                url: '/getDailyDebug?Daily='+Daily+'&MB={{$MB}}&INV={{$INV}}',
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                         
                        OnchangeDailydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
}, 20000);
});
});
</script>
<!-- on first time -->
<script>
// $.getJSON('https://www.highcharts.com/samples/data/jsonp.php?filename=usdeur.json&callback=?', function (data) {
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
        document.getElementById("daily").value = Daily;

console.log(Daily);

// ajax
$.getJSON('/getDailyDebug?Daily='+Daily+'&MB={{$MB}}&INV={{$INV}}', function(data){
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
            var Dailydetailchart = new Highcharts.chart('container', {
chart: {
    zoomType: 'x',
    height:'500px',
},
title: {
    text: 'Daily Debug Graph'
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
    },
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
    type: 'column',
    name: 'Power',
    data: []
},{
    type: 'column',
    name: 'Power',
    data: data
}]
});
setInterval(function () {
    $.ajax(
            {
                url: '/getDailyDebug?Daily='+Daily+'&MB={{$MB}}&INV={{$INV}}',
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                       
                        Dailydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
}, 20000);  
});
}
</script>
<script>
$('#exportexceldaydetail').click(function() {
  
  $(document).bind(".mine"); 
  Dateexcel = document.getElementById('daily').value;
  

  $.ajaxSetup({
      url: $("#exportexceldaydetail").attr("href", "/exportexcelDaydetail?date="+Dateexcel+"&MB={{ $MB }}&INV={{ $INV }}"),
      type: 'GET',
  });
  $(document).bind("ajaxStart.mine", function() {
      $('#Loadingexcel').show();
  });

  $(document).bind("ajaxStop.mine", function() {
      $('#Loadingexcel').hide();
      $(document).unbind(".mine");             

  });
  });
  </script>

<script>
  $('#exporterrordaydetail').click(function() {
  
  $(document).bind(".mine"); 
  Dateexcel = document.getElementById('daily').value;
  

  $.ajaxSetup({
      url: $("#exporterrordaydetail").attr("href", "/exporterrordaydetail?date="+Dateexcel+"&MB={{ $MB }}&INV={{ $INV }}"),
      type: 'GET',
  });
  $(document).bind("ajaxStart.mine", function() {
      $('#Loadingerror').show();
  });

  $(document).bind("ajaxStop.mine", function() {
      $('#Loadingerror').hide();
      $(document).unbind(".mine");             

  });
  });
</script>
<script>
$(document).ready(function() {
    dailydetail();
})
</script>