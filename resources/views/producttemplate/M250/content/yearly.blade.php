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
                            <a id="exporterroryear" href="#" class="tile tile-danger">
                            <img id="Loaddererror" style="height:70px;width:100px;display:none;" src="M250\img\loadererror.gif">
                            <span class="fa fa-warning"></span>
                                <p>Error log</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-warning"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-3">
                            <a href="#" id="exportexcelyear" class="tile tile-success">
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
                                    <div class="">                                        
                                        <div class="col-md-3">
                                        <div class="input-group">
                                        <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>                                               
                                            <select id="yearly" class="form-control select">
                                                <option value="#" disable>Select Year</option>
                                                <option value="2017" >2017</option>
                                                <option value="2018">2018</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                            </select>                                           
                                        </div>
                                        </div>
                                        <div class="form-group pull-right">
                                        <a href="/userfilter" class="btn btn-success btn-rounded" ><span class="fa fa-clock-o"></span> Real-time</a>
                                            <button onclick="Daily()" type="button" class="btn btn-info btn-rounded ">Daily</button>
                                            <button onclick="Monthly()" type="button" class="btn btn-warning btn-rounded ">Monthly</button>
                                            <button onclick="yearly()" type="button" class="btn btn-danger btn-rounded bactive">Yearly</button>
                                    </div>

                                    </div>                                    
                                    
                                </div>
                                <div class="panel-body">                                    
                                <div id="container" style="height=790px" ></div>
                                       
                                </div>
                            </div>
                            <!-- END SALES BLOCK -->
                            
                        </div>
                    <!-- END WIDGETS --> 
                    
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
                    // function Yearly(){
                    //     $.ajax(
                    //     {
                    //         url: "/getYearly",
                    //         type: 'GET',
                    //     }).done( 
                    //         function(data) 
                    //         {
                    //             $('.por').html(data.html);
                    //         }
                    //     );
                    //     }

    $('#yearly').on('change',function(e){
        var Yearly = e.target.value;
        console.log(Yearly);
// ajax
$.getJSON('/getYearlydata?Yearly='+Yearly, function(data){
    console.log(data);
    Highcharts.setOptions({
                colors: ['#bedf0f'],
                global: {
                    useUTC: true
                },
                lang: {
        thousandsSep: ','
    }
                });
                var OnchangeYearlychart = new Highcharts.chart('container', {
        chart: {
            zoomType: 'x',
            height:'330px',
        },
        title: {
            text: 'Yearly Energy Graph'
        },
  
        xAxis: {
            title: {
                text: 'Month'
            },
            type: 'datetime',
            dateTimeLabelFormats: { 
            month: '%M'
            },
            ordinal: false,
            startOnTick: false,
            endOnTick: false,
            minPadding: 0,
            maxPadding: 0,
            // tickInterval:24 * 3600 * 1000,
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
        plotOptions: {
            plotOptions: {
                        series: {
            pointWidth: 50
        }
                    }
        },
    
        series: [{
            type: 'column',
            name: 'Energy',
            data: data,
            color: '#EC7063',
            dataLabels: {
                enabled: true
            },
        },
        {
            type: 'column',
            name: 'Energy',
            data: [[0,null],[11,null]],
            color: '#EC7063',
            dataLabels: {
                enabled: true
            },
        }]
        });
        setInterval(function () {
            $.ajax(
            {
                url: '/getYearlydata?Yearly='+Yearly,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        OnchangeYearlychart.series[0].setData([[0,null],[11,null]]);   
                        OnchangeYearlychart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
    });
});

                </script>
<script>
 function yearly(){
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
        document.getElementById("yearly").value = Yearly;
// ajax
$.getJSON('/getYearlydata?Yearly='+Yearly, function(data){
    console.log(data);
    Highcharts.setOptions({
                colors: ['#bedf0f'],
                global: {
                    useUTC: true
                },
                lang: {
        thousandsSep: ','
    }
                });
    var Yearlychart = new Highcharts.chart('container', {
        chart: {
            zoomType: 'x',
            height:'330px',
        },
        title: {
            text: 'Yearly Energy Graph'
        },
  
        xAxis: {
            title: {
                text: 'Month'
            },
            type: 'datetime',
            dateTimeLabelFormats: { 
            month: '%M'
            },
            ordinal: false,
            startOnTick: false,
            endOnTick: false,
            minPadding: 0,
            maxPadding: 0,
            // tickInterval:24 * 3600 * 1000,
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
        plotOptions: {
            plotOptions: {
                        series: {
            pointWidth: 50
        }
                    }
        },
    
        series: [{
            type: 'column',
            name: 'Energy',
            data: data,
            color: '#EC7063',            
            dataLabels: {
                enabled: true
            },
        },
        {
            type: 'column',
            name: 'Energy',
            data: [[0,null],[11,null]],
            color: '#EC7063',            
            dataLabels: {
                enabled: true
            },
        }]
        });
        setInterval(function () {
            $.ajax(
            {
                url: '/getYearlydata?Yearly='+Yearly,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Yearlychart.series[0].setData([[0,null],[11,null]]);   
                        Yearlychart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
    });
}
</script>
<script>


$('#exporterroryear').click(function() {
  
  $(document).bind(".mine"); 
  Yearerror = document.getElementById('yearly').value;

  $.ajaxSetup({
      url: $("#exporterroryear").attr("href", "/exporterroryear?year="+Yearerror),
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

$('#exportexcelyear').click(function() {
  
                    $(document).bind(".mine"); 
    Yeareexcel = document.getElementById('yearly').value;
    
                    $.ajaxSetup({
                        url: $("#exportexcelyear").attr("href", "/ExportexcelYear?year="+Yeareexcel),
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
    yearly();
})
</script>