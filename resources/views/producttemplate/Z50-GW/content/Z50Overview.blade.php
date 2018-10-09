@extends('producttemplate.Z50-GW.template.z50layout')
@section('content')
 <!-- START WIDGETS -->   
 <link href="https://fonts.googleapis.com/css?family=Chau+Philomene+One|Jua" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Yatra+One" rel="stylesheet">
 <script type="text/javascript" src="Z50/js/plugins.js"></script>        
        <script type="text/javascript" src="Z50/js/actions.js"></script> 
<div class="row">
@foreach($Z50serial as $Z50serials)
<div class="col-md-3 ">
                            
                            <div class="panel panel-default z50panel">
                                <div id="" class="panel-body profile z50insidepanel" style="align:center;">
                                    <div class="progress progress-middle progress-striped active">
                                        <div id="Statusbar{{$Z50serials}}" class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                        </div>
                                    <div class="profile-image  ">
                                    <!-- ใส่ chart  -->
                                    <div id="container-speed{{$Z50serials}}" style="width:100%; height: 100px;"></div>
                                    </div>
                                    <div class="profile-data ">
                                        
                                        <div class="profile-data-name" style="color:#fff;font-size:15px"><h4 style="color:#fff;font-size:15px" id="" >INV: {{$Z50serials}}</h4></div>
                                        <div class="profile-data-name" style="color:#fff;font-size:15px"><h4 style="color:#fff;font-size:15px" id="" >STATUS OF INVERTER</h4></div>
                                        <div class="profile-data-name" style="color:#fff;font-size:15px" id="status{{$Z50serials}}">Waiting</div>
                                    </div>
                                    
                                </div>                                
                                <div class="panel-body z50insidepanel">                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="Z50detail?SerialNo={{$Z50serials}}" class="btn btn-warning btn-rounded btn-block"><span class="fa fa-search"></span>Detail</a>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>                            
                            </div>

                            <script>
                            var gaugeOptions = {

chart: {
    type: 'solidgauge',
    backgroundColor:'transparent',
},

title: null,

pane: {
    center: ['50%', '85%'],
    size: '140%',
    startAngle: -90,
    endAngle: 90,
    background: {
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
    }
},

tooltip: {
    enabled: false
},
credits: {
    enabled: false
},
exporting: {
        enabled: false
    },

// the value axis
yAxis: {
    stops: [
        [0.1, '#55BF3B'], // green
        [0.5, '#DDDF0D'], // yellow
        [0.9, '#DF5353'] // red
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
var chartSpeed{{$Z50serials}} = Highcharts.chart('container-speed{{$Z50serials}}', Highcharts.merge(gaugeOptions, {
yAxis: {
    min: 0,
    max: 2,
    title: {
        text: 'Speed'
    }
},

credits: {
    enabled: false
},

series: [{
    name: 'Speed',
    data:0 ,
    dataLabels: {
        format: '<div style="text-align:center"><span style="font-size:24px;color:' +
            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
               '<span style="font-size:12px;color:#fff">kw</span></div>'
    },
    tooltip: {
        valueSuffix: 'kw'
    }
}]

}));

// Bring life to the dials
setInterval(function () {
// Speed

if (chartSpeed{{$Z50serials}}) {
    $.getJSON('/getZ50power_out?Serialno={{$Z50serials}}', function (data) {
                                        console.log(data);                                      
                                        chartSpeed{{$Z50serials}}.series[0].setData(data);   
                                })


    //tranfer status
}

// Change css follow status function Start 
$.getJSON('/getINVStatus?Serialno={{$Z50serials}}', function (status) {
                                            // console.log(status);
                                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#FFFF47";
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Grid connection in preparation.";
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#FFFF47";                                                                                                                                       
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#03EBA6";
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Grid connection in operation"; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#03EBA6";                                                                                                                                       
                                                                    break;
                                                                case "C":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#E4523B";                                                                                                                                        
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Grid connection in manual stop";
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#E4523B";                                                                                                                                       
                                                                                                                                        
                                                                    break;
                                                                case "D":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#A6A5A1";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Stand alone in preparation."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#A6A5A1";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                case "E":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#50EBC6";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Stand alone in operation."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#50EBC6";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                case "F":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#680016";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Stand alone in manual stop."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#680016";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                case "G":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#FF0000";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Failure or into systems error."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#FF0000";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                default: //"H"
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#FFFFFF";
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Setting value.";  
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#FFFFFF";                                                                                                                                       
                                                                                                                                                                                                              
                                                            } 
                                    })
                                // Change css follow status function Stop
}, 300000);

$(document).ready(function() {

if (chartSpeed{{$Z50serials}}) {
    $.getJSON('/getZ50power_out?Serialno={{$Z50serials}}', function (data) {
                                        console.log(data);                                      
                                        chartSpeed{{$Z50serials}}.series[0].setData(data);   
                                })


    //tranfer status
}

// Change css follow status function Start 
$.getJSON('/getINVStatus?Serialno={{$Z50serials}}', function (status) {
                                            // console.log(status);
                                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#FFFF47";
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Grid connection in preparation.";
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#FFFF47";                                                                                                                                       
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#03EBA6";
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Grid connection in operation"; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#03EBA6";                                                                                                                                       
                                                                    break;
                                                                case "C":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#E4523B";                                                                                                                                        
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Grid connection in manual stop";
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#E4523B";                                                                                                                                       
                                                                                                                                        
                                                                    break;
                                                                case "D":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#A6A5A1";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Stand alone in preparation."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#A6A5A1";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                case "E":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#50EBC6";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Stand alone in operation."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#50EBC6";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                case "F":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#680016";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Stand alone in manual stop."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#680016";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                case "G":
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#FF0000";                                                           
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Failure or into systems error."; 
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#FF0000";                                                                                                                                       
                                                                                                                                       
                                                                    break;
                                                                default: //"H"
                                                                    document.getElementById("Statusbar{{$Z50serials}}").style.backgroundColor = "#FFFFFF";
                                                                    document.getElementById("status{{$Z50serials}}").innerHTML = "Setting value.";  
                                                                    document.getElementById("status{{$Z50serials}}").style.color = "#FFFFFF";                                                                                                                                       
                                                                                                                                                                                                              
                                                            } 
                                    })

});

</script>

@endforeach
</div>

@endsection


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

