<!-- START WIDGETS --> 
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
                                        <img  id="Loadingexcel" style="height:5%;width:10%;display:none;" src="M250\img\loadingcall.gif">
                                        <a id="exportexcelYeardetail" class="btn btn-success"><i class="glyphicon glyphicon-cloud-download"></i> CSV download</a>                                                
                                        <img  id="Loadingexcel" style="height:5%;width:10%;display:none;" src="M250\img\loadingcall.gif">                                        
                                        <a id="exporterrorYeardetail" class="btn btn-danger"><i class="fa fa-exclamation-triangle"></i> Error log</a>
                                            <button onclick="InvDetaildaily()" type="button" class="btn btn-info btn-rounded ">Daily</button>
                                            <button onclick="InvDetailmonthly()" type="button" class="btn btn-warning btn-rounded ">Monthly</button>
                                            <button onclick="yearlydetail()" type="button" class="btn btn-danger btn-rounded bactive">Yearly</button>
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

    $('#yearly').on('change',function(e){
        var Yearly = e.target.value;
        console.log(Yearly);
// ajax
$.getJSON('/getYearlydataINV?Yearly='+Yearly+'&MB={{$MB}}&INV={{$INV}}', function(data){
    console.log(data);
    Highcharts.setOptions({
                colors: ['#bedf0f'],
                global: {
                    useUTC: false
                },
                lang: {
                    thousandsSep: ','
                }
                });
            var OnchangeYearlydetailchart = new Highcharts.chart('container', {
        chart: {
            zoomType: 'x',
            height:'330px',
        },
        title: {
            text: 'Yearly Power Graph'
        },
  
        xAxis: {
            title: {
                text: 'Month'
            },
            type: 'datetime',
            ordinal: false,
            startOnTick: false,
            endOnTick: false,
            minPadding: 0,
            maxPadding: 0,
            // tickInterval: 31 * 24 * 3600 * 1000,
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
            color: '#EC7063',    
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
                url: '/getYearlydataINV?Yearly='+Yearly+'&MB={{$MB}}&INV={{$INV}}',
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        OnchangeYearlydetailchart.series[0].setData([[0,null],[11,null]]);   
                        OnchangeYearlydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000);
    });
});

                </script>
<script>
function yearlydetail(){
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
        console.log(Yearly);
// ajax
$.getJSON('/getYearlydataINV?Yearly='+Yearly+'&MB={{$MB}}&INV={{$INV}}', function(data){
    console.log(data);
    mb = {{$MB}};
    inv = {{$INV}};
    console.log(mb);
    console.log(inv);
    Highcharts.setOptions({
                colors: ['#bedf0f'],
                global: {
                    useUTC: false
                },
                lang: {
        thousandsSep: ','
    }
                });
                var Yearlydetailchart = new Highcharts.chart('container', {
        chart: {
            zoomType: 'x',
            height:'330px',
        },
        title: {
            text: 'Yearly Power Graph'
        },
  
        xAxis: {
            title: {
                text: 'Month'
            },
            type: 'datetime',
            ordinal: false,
            startOnTick: true,
            endOnTick: false,
            minPadding: 0,
            maxPadding: 0,
            
            // tickInterval: 31 * 24 * 3600 * 1000,
            categories : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            
        },
        xAxis: {
        categories: Highcharts.getOptions().lang.shortMonths,
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
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
            color: '#EC7063',    
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
                url: '/getYearlydataINV?Yearly='+Yearly+'&MB={{$MB}}&INV={{$INV}}',
                type: 'GET',   
            }).done( 
                function(newdata) 
                    {
                        Yearlydetailchart.series[0].setData([[0,null],[11,null]]);   
                        Yearlydetailchart.series[1].setData(newdata);   
                     console.log(newdata);
                    });
            }, 60000); 
    });
}
</script>

<script>

$('#exportexcelYeardetail').click(function() {
  
                    $(document).bind(".mine"); 
    Yeareexcel = document.getElementById('yearly').value;
    
                    $.ajaxSetup({
                        url: $("#exportexcelYeardetail").attr("href", "/exportexcelYeardetail?year="+Yeareexcel+"&MB={{ $MB }}&INV={{ $INV }}"),
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

$('#exporterrorYeardetail').click(function() {
  
                    $(document).bind(".mine"); 
    Yeareexcel = document.getElementById('yearly').value;
    
                    $.ajaxSetup({
                        url: $("#exporterrorYeardetail").attr("href", "/exporterrorYeardetail?year="+Yeareexcel+"&MB={{ $MB }}&INV={{ $INV }}"),
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
    yearlydetail();
})
</script>