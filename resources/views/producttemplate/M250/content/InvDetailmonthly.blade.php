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
                                            <div class="input-group">
                                                <span class="input-group-addon add-on"><span class="fa fa-calendar"></span></span>
                                                <input style="width:60%" id="monthly" type="month" class="form-control datepicker"/>   
                                                                                          
                                            </div>                                            
                                        </div>
                                        
                                        <div class="form-group pull-right">
                                        <img  id="Loadingexcel" style="height:5%;width:10%;display:none;" src="M250\img\loadingcall.gif">   
                                        
                                        <a id="exportexcelmonthdetail" class="btn btn-success"><i class="glyphicon glyphicon-cloud-download"></i> CSV download</a>                                                
                                        <img  id="Loadingerror" style="height:5%;width:10%;display:none;" src="M250\img\loadingcall.gif">
                                            
                                            <a id="exporterrormonthdetail" class="btn btn-danger"><i class="fa fa-exclamation-triangle"></i> Error log</a>
                                            <button onclick="InvDetaildaily()" type="button" class="btn btn-info btn-rounded ">Daily</button>
                                            <button onclick="monthlydetail()" type="button" class="btn btn-warning btn-rounded bactive">Monthly</button>
                                            <button onclick="InvDetailyearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button>
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
                   function InvDetaildaily(){
                $.ajax(
                {
                    url: "/InvDetaildaily?MB={{$MB}}&INV={{$INV}}",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.Invchart').html(data.html);
                    }
                );
                }
            function InvDetailmonthly(){
                $.ajax(
                {
                    url: "/InvDetailmonthly?MB={{$MB}}&INV={{$INV}}",
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
                    url: "/InvDetailyearly?MB={{$MB}}&INV={{$INV}}",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.Invchart').html(data.html);
                    }
                );
                }
                
                function bbb()
                    {
                        var text = "69";
                        return text;
                    }

            $('#monthly').on('change',function(e){
                var date = new Date($('#monthly').val());
                month = date.getMonth() + 1;
                year = date.getFullYear();

            console.log(month);
            console.log(year);

            // ajax
            $.getJSON('/getMonthlydataINV?Monthly='+month+'&YY='+year+'&MB={{$MB}}&INV={{$INV}}', function(data){
                console.log(data);
                Highcharts.setOptions({
                colors: ['#00dbe2'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
                var OnchangeMonthlydetailchart = new Highcharts.chart('container', {
                    chart: {
                        zoomType: 'x',
                        height:'330px',
                    },
                    title: {
                        text: 'Monthly Power Graph'
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
                    plotOptions:{
                        series: {
            pointWidth: 20
        }
                    },
                
                    series: [{
                        type: 'column',
                        name: 'Power',
                        dataLabels: {
                                enabled: true
                            },
                        data: data,
                        color: '#58D68D',
                    },
                    {
                        type: 'column',
                        name: 'Power',
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
                url: '/getMonthlydataINV?Monthly='+month+'&YY='+year+'&MB={{$MB}}&INV={{$INV}}',
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
            $.getJSON('/getMonthlydataINV?Monthly='+month+'&YY='+year+'&MB={{$MB}}&INV={{$INV}}', function(data){
                console.log(data);
                Highcharts.setOptions({
                colors: ['#00dbe2'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
                var Monthlydetailchart = new Highcharts.chart('container', {
                    chart: {
                        zoomType: 'x',
                        height:'330px',
                    },
                    title: {
                        text: 'Monthly Power Graph'
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
                            text: 'Power (kWh)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions:{
                        series: {
            pointWidth: 20
        }
                    },
                
                    series: [{
                        type: 'column',
                        name: 'Power',
                        dataLabels: {
                enabled: true
            },
                        data: data,
                        color: '#58D68D',
                    },
                    {
                        type: 'column',
                        name: 'Power',
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
                url: '/getMonthlydataINV?Monthly='+month+'&YY='+year+'&MB={{$MB}}&INV={{$INV}}',
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

<script>
$('#exportexcelmonthdetail').click(function() {
  
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
      url: $("#exportexcelmonthdetail").attr("href", "/exportexcelMonthdetail?Monthly="+month+"&YY="+year+"&MB={{ $MB }}&INV={{ $INV }}"),
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
$('#exporterrormonthdetail').click(function() {
  
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
      url: $("#exporterrormonthdetail").attr("href", "/exporterrormonthdetail?Monthly="+month+"&YY="+year+"&MB={{ $MB }}&INV={{ $INV }}"),
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
    monthlydetail();
})
</script>