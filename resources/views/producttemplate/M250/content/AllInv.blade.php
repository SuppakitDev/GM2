<div class="row page-navigation-toggled " >
                            @foreach($Inverter as $Inverters)
                            <style>
                            #Invnode{{$Inverters->PcsID}}{
                                margin-left: auto;
                                margin-right: auto;
                            }
                            </style>
                            <div class="col-md-4">
                            
                            <div class="panel panel-default">
                                <div id="Invnode{{$Inverters->PcsID}}" class="panel-body profile" style="background-color:#fff;align:center;">
                                    <div class="profile-image  ">
                                    <!-- ใส่ chart  -->
                                    <div id="container-speed{{$Inverters->PcsID}}" style="width:100%; height: 200px;"></div>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name" style="color:black;font-size:15px"> PCS : {{ $Inverters->PcsID  }}</div>
                                        <div class="profile-data-title" style="color:black;font-size:15px"><h4 id="descript{{$Inverters->PcsID}}" >STATUS : {{ $Inverters->tbPcsStatusDescripts->Descript }}</h4></div>
                                    </div>
                                    
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="InvDetail?id={{$Inverters->PcsID}}&mbid={{$Inverters->MBxID}}" class="btn btn-info btn-rounded btn-block"><span class="fa fa-search"></span>Detail</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-danger btn-rounded btn-block"><span class="glyphicon glyphicon-remove"></span>Remove</button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>                            
                            </div>
                           
                            <!-- Render Chart function Start -->
                            <script>
                                var gaugeOptions = {

                                chart: {

                                    type: 'solidgauge'
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

                                // the value axis
                                yAxis: {
                                    stops: [
                                        [2, '#55BF3B'], // green
                                        [8, '#DDDF0D'], // yellow
                                        [19, '#DF5353'] // red
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
                                var chartSpeed{{$Inverters->PcsID}} = Highcharts.chart('container-speed{{$Inverters->PcsID}}', Highcharts.merge(gaugeOptions, {
                                yAxis: {
                                    min: 0,
                                    max: 20,
                                    title: {
                                        text: 'Power Energy'
                                    }
                                },

                                credits: {
                                    enabled: false
                                },
                                exporting: { 
                                    enabled: false 
                                },

                                series: [{
                                    name: 'Power Energy',
                                    data: [{{$Inverters->Pac}}],
                                    dataLabels: {
                                        format: '<div style="text-align:center"><span style="font-size:25px;color:' +
                                            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') + '">{y}</span><br/>' +
                                            '<span style="font-size:12px;color:silver">kWh</span></div>'
                                    },
                                    tooltip: {
                                        valueSuffix: ' kWh'
                                    }
                                }]

                                }));
                                // Bring life to the dials
                                
                            </script>
                            <!-- Render Chart function Stop -->                            
                            <!-- Get data Realtime Chart function Start -->                            
                            <script>
                            setInterval(function () {
                                // Speed
                                var point,
                                    newVal,
                                    inc;
                                MasterBoxid = document.getElementById('MNXID').value;
                                if (chartSpeed{{$Inverters->PcsID}}) {
                                    point = chartSpeed{{$Inverters->PcsID}}.series[0].points[0];                                   
                                    $.getJSON('/getInvdata?pcsid={{$Inverters->PcsID}}&mbxid='+MasterBoxid, function (data) {
                                        // console.log(data);                                      
                                        newVal = data;          
                                    point.update(newVal);
                                })
                                // Change css follow status function Start 
                                    $.getJSON('/getPcsStatus?pcsid={{$Inverters->PcsID}}&mbxid='+MasterBoxid, function (status) {
                                            // console.log(status);
                                            switch(status) {
                                                                case 0:
                                                                    document.getElementById("Invnode{{$Inverters->PcsID}}").style.backgroundColor = "gray";
                                                                    document.getElementById("descript{{$Inverters->PcsID}}").innerHTML = "STATUS : Stop";
                                                                    break;
                                                                case 1:
                                                                    document.getElementById("Invnode{{$Inverters->PcsID}}").style.backgroundColor = "#F0E68C";
                                                                    document.getElementById("descript{{$Inverters->PcsID}}").innerHTML = "STATUS : Preparing";                                                                                                                                        
                                                                    break;
                                                                case 2:
                                                                    document.getElementById("Invnode{{$Inverters->PcsID}}").style.backgroundColor = "#03EBA6";                                                                                                                                        
                                                                    document.getElementById("descript{{$Inverters->PcsID}}").innerHTML = "STATUS : Operating";                                                                    
                                                                    break;
                                                                case 3:
                                                                    document.getElementById("Invnode{{$Inverters->PcsID}}").style.backgroundColor = "gray";                                                           
                                                                    document.getElementById("descript{{$Inverters->PcsID}}").innerHTML = "STATUS : Error";                                                                    
                                                                    break;
                                                                default:
                                                                    document.getElementById("Invnode{{$Inverters->PcsID}}").style.backgroundColor = "#FF2626";
                                                                    document.getElementById("descript{{$Inverters->PcsID}}").innerHTML = "STATUS : Fatal error";                                                                                                                                            
                                                            } 
                                    })
                                // Change css follow status function Stop

                                }
                                }, 10000);
                                </script>
                                <!-- Get data Realtime Chart function Stop -->   
                            @endforeach
                            </div> 
                                                    
                        </div>

                    </div> 