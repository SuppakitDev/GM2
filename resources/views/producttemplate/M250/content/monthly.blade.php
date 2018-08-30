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
                            <a id="exporterrormonth" href="#" class="tile tile-danger">
                            <img id="Loaddererror" style="height:70px;width:100px;display:none;" src="M250\img\loadererror.gif"> 
                            <span class="fa fa-warning"></span>
                                <p>Error log</p>                            
                                <div class="informer informer-default dir-tr"><span class="fa fa-warning"></span></div>
                            </a>                        
                        </div>
                        <div class="col-md-3">                        
                            <a href="##" onclick="exportexcel()"  id="exportexcelmonth" class="tile tile-success">
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
                                                <input id="monthly" type="month" class="form-control datepicker"/>                                                
                                            </div>                                            
                                        </div>
                                        <div class="form-group pull-right">
                                        <a href="/userfilter" class="btn btn-success btn-rounded" ><span class="fa fa-clock-o"></span> Real-time</a>
                                        
                                            <button onclick="Daily()" type="button" class="btn btn-info btn-rounded ">Daily</button>
                                            <button onclick="monthly()" type="button" class="btn btn-warning btn-rounded bactive">Monthly</button>
                                            <button onclick="Yearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button>
                                    </div>
                                        </li>                                
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
            $('#monthly').on('change',function(e){
                var date = new Date($('#monthly').val());
                month = date.getMonth() + 1;
                year = date.getFullYear();

            console.log(month);
            console.log(year);

            // ajax
            $.getJSON('/getMonthlydata?Monthly='+month+'&YY='+year, function(data){
                console.log(data);
                Highcharts.setOptions({
                colors: ['#58D68D'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
                var OnchangeMonthlychart = new Highcharts.chart('container', {
                    chart: {
                        zoomType: 'x'
                    },
                    title: {
                        text: 'Monthly Energy Graph'
                    },
                  
                    xAxis: {
                        title: {
                            text: 'Day'
                        },
                        type: 'datetime',
                        ordinal: false,
                        startOnTick: false,
                        endOnTick: false,
                        minPadding: 0,
                        maxPadding: 0,
                        // tickInterval:  24*3600*1000,
                        categories: ['0', '1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']

                        
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
                        series: {
            pointWidth: 20
        }
                    },
                
                    series: [{
                        type: 'column',
                        name: 'Energy',
                        
                        turboThreshold:null,
                        data: data,
                        color: '#58D68D',
                        dataLabels: 
                            {
                            enabled: true
                            },
                    },
                    {
                        type: 'column',
                        name: 'Energy',
                        data: [[1,null],[31,null]],
                        color: '#58D68D',                        
                        dataLabels: {
                            enabled: true
                                    },
                    }]
                    });
                    setInterval(function () {
            $.ajax(
            {
                url: '/getMonthlydata?Monthly='+month+'&YY='+year,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        OnchangeMonthlychart.series[0].setData([[1,null],[31,null]]);   
                        OnchangeMonthlychart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
                });
            });

                </script>
<script>
 function monthly(){
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
            $.getJSON('/getMonthlydata?Monthly='+month+'&YY='+year, function(data){
                console.log(data);
                Highcharts.setOptions({
                colors: ['#58D68D'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
                var Monthlychart = new Highcharts.chart('container', {
                    chart: {
                        zoomType: 'x',
                        height:'330px',
                    },
                    title: {
                        text: 'Monthly Energy Graph'
                    },
                    xAxis: {
                        title: {
                            text: 'Day'
                        },
                        type: 'datetime',
                        ordinal: false,
                        startOnTick: false,
                        endOnTick: false,
                        minPadding: 0,
                        maxPadding: 0,
                        // tickInterval:  24*3600*1000,
                        categories: ['0', '1', '2', '3', '4', '5', '6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31']
                        
                    },
                    
                
                    yAxis: {
                        min:0,                        
                        title: {
                            text: 'Energy (kWh)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions:{
                        series: {
            pointWidth: 20
        },
        
                    },
                
                    series: [{
                        type: 'column',
                        name: 'Energy',
                        data: data,
                        color: '#58D68D',
                        dataLabels: {
                            enabled: true
                                    },
                    },
                    {
                        type: 'column',
                        name: 'Energy',
                        data: [[1,null],[31,null]],
                        color: '#58D68D',
                        dataLabels: {
                            enabled: true
                                    },
                    }]
                    });
                    
                    setInterval(function () {
            $.ajax(
            {
                url: '/getMonthlydata?Monthly='+month+'&YY='+year,
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Monthlychart.series[0].setData([[1,null],[31,null]]);   
                        Monthlychart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
                });
            }

            
</script>

<script>

///////////////////////////////////////////////////////////////////////////////////////////////////////

        $('#exporterrormonth').click(function() {
            $(document).bind(".mine"); 
    Montherror = document.getElementById('monthly').value;

    if(!Montherror)
    {
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
            var month = mm;
            var year = yyyy;
            console.log(month);
            console.log(year); 
    }else
    {
        var date = new Date($('#monthly').val());
                month = date.getMonth() + 1;
                year = date.getFullYear();

            console.log(month);
            console.log(year);       
    }

            
       
            $(document).bind(".mine"); 
            

            $.ajaxSetup({
                url: $("#exporterrormonth").attr("href", "/exporterrormonth?Monthly="+month+"&YY="+year),
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
 function exportexcel(){
   
// $('#exportexcelmonth').click(function() {
  
    $(document).bind(".mine"); 
                    Monthexcel = document.getElementById('monthly').value;

if(!Monthexcel)
{
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
        var month = mm;
        var year = yyyy;
        console.log(month);
        console.log(year); 
}else
{
    var date = new Date($('#monthly').val());
            month = date.getMonth() + 1;
            year = date.getFullYear();

        console.log(month);
        console.log(year);       
}
                    $.ajaxSetup({
                        url: $("#exportexcelmonth").attr("href", "/ExportexcelMonth?Monthly="+month+"&YY="+year),
                        type: 'GET',
                    });
                    $(document).bind("ajaxStart.mine", function() {
                        $('#Loadder').show();
                    });

                    $(document).bind("ajaxStop.mine", function() {
                        $('#Loadder').hide();
                        $(document).unbind(".mine");             

                    });
                    
    console.log('From here');
                    }
                    




</script>
<script>
$(document).ready(function() {
    monthly();
})
</script>