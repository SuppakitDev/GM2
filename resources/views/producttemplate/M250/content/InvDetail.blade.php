@extends('producttemplate.m250.template.m250layout')
@section('Script')
<!-- <script type="text/javascript" src="m250/js/settings.js"></script> -->
@endsection
@section('content')
<div class="content-frame page-navigation-toggled " >
<script type="text/javascript" src="m250/js/plugins.js"></script>
<script type="text/javascript" src="m250/js/actions.js"></script> 
    <div class="row" style="margin-top:10px;"> 
        <div class="col-md-3">   
        @foreach($Inverter as $Invinfo)                                    
            <div class="list-group border-bottom push-down-20">
                <a href="#" class="list-group-item" style="Background-color:#39E9CB;" ><h4><span class="fa fa-wrench"></span>Data Information</h4></a>
                <a href="#" class="list-group-item">Ac Voltage (V) <span id="{{$Invinfo->SerialNo}}0" class="badge badge-success">{{$Invinfo->Vac}}</span></a>
                <a href="#" class="list-group-item">AC Current (A) <span id="{{$Invinfo->SerialNo}}1" class="badge badge-success">{{$Invinfo->Iac}}</span></a>
                <a href="#" class="list-group-item">AC Frequency (Hz) <span id="{{$Invinfo->SerialNo}}2" class="badge badge-success">{{$Invinfo->AcFreq}}</span></a>
                <a href="#" class="list-group-item">DC bus voltage (V)<span id="{{$Invinfo->SerialNo}}3" class="badge badge-success">{{$Invinfo->VdcBus}}</span></a>
                <a href="#" class="list-group-item">Power output ratio (%)<span id="{{$Invinfo->SerialNo}}4" class="badge badge-success">{{$Invinfo->PCtrlRate}}</span></a>
                <a href="#" class="list-group-item">Output suppression <span id="{{$Invinfo->SerialNo}}5" class="badge badge-success">{{$Invinfo->tbSuppressionDescripts->Descript}}</span></a>
                <a href="#" class="list-group-item">Voltage suppression <span id="{{$Invinfo->SerialNo}}6" class="badge badge-success">{{$Invinfo->tbSuppressionDescript_V->Descript}}</span></a>
                <a href="#" class="list-group-item">Temperature suppression <span id="{{$Invinfo->SerialNo}}7" class="badge badge-success">{{$Invinfo->tbSuppressionDescript_T->Descript}}</span></a>
                <a href="#" class="list-group-item">Power consumption (kWh)<span id="{{$Invinfo->SerialNo}}8" class="badge badge-success">{{$Invinfo->PConsumption}}</span></a>
                <a href="#" class="list-group-item">Inverter temperature (°C)<span id="{{$Invinfo->SerialNo}}9" class="badge badge-success">{{$Invinfo->INVTemp}}</span></a>
            </div> 
            <script>
                setInterval(function () {
        // getdetail 
            $.ajax(
                {
                url: "/getInvinfo?Serial={{$Invinfo->SerialNo}}&pcsid={{$Invinfo->PcsID}}&mbxid={{$Invinfo->MBxID}}",
                type: 'GET',   
                }).done( 
                function(invarray) 
                    {
                        // console.log(invarray);

                        invarray.forEach(function(element,index) 
                        {
                        // console.log(index+"->"+element); 
                        document.getElementById("{{$Invinfo->SerialNo}}"+index).innerHTML = element ;
                        });      
                    }
                );
    }, 60000);
            </script>
        </div>
        <div class="col-md-6"> 
              <div class="Invchart" >
                    
                                        <div class="form-group">
                                        <button href="##" type="button" class="btn btn-success btn-rounded bactive ">
                                        <button id="ddd" onclick="InvDetaildaily()" type="button" class="btn btn-info btn-rounded ">Daily</button>
                                        <button onclick="InvDetailmonthly()" type="button" class="btn btn-warning btn-rounded">Monthly</button>
                                        <button onclick="InvDetailyearly()" type="button" class="btn btn-danger btn-rounded">Yearly</button>
                                        <script>
                                        $(document).ready(function() {
                                            jQuery(function(){
                                                jQuery('#ddd').click();
                                            });
                                        })
                                        </script>
                                        </div>
                                        
        </div>
        
            
              <script>
              // ajax call page conent
            function InvDetaildaily(){
                $.ajax(
                {
                    url: "/InvDetaildaily?MB={{$Invinfo->MBxID}}&INV={{$Invinfo->PcsID}}",
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
                    url: "/InvDetailmonthly?MB={{$Invinfo->MBxID}}&INV={{$Invinfo->PcsID}}",
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
                    url: "/InvDetailyearly?MB={{$Invinfo->MBxID}}&INV={{$Invinfo->PcsID}}",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.Invchart').html(data.html);
                    }
                );
                }
              </script> 
                                                     
                       
        </div>
        @endforeach  
        <div class="col-md-3" style="margin-bottom:5px;">  
            <div class="input-group">
                <div class="col-md-3" >
                <label class="col-sm-1" >MasterBox</label>
                        <div class="input-group">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-hdd"></span></span>
                            <select style="width:100px;" id="MTB" class="form-control" >
                                <option value="#" disable>Masterbox</option>
                                @foreach($MB as $MBxID)
                                <option value="{{$MBxID->MBxID}}" >{{$MBxID->MBxID}}</option>
                                @endforeach
                            </select>
                        </div>                                                    
                <label class="col-sm-1" >Inverter</label>
                        <div class="input-group"  >
                            <span class="input-group-addon add-on"><span class="fa fa-bolt"></span></span>
                            <select style="width:100px;" id="INV" class="form-control">
                            <option value=""></option>
                            </select>
                            <span onclick="GOGO()" class="input-group-addon add-on"><a onclick="GOGO()" id="InvGO" style="color:red;"><span class="fa fa-mail-forward" style="padding-left:5px;color:red;"></span> Go</a></span>                                               
                        </div>                                            
                </div>
            </div>                                                       
                                                                                   
        </div>

        <div class="col-md-3">  
        @foreach($Inverter as $Inverters)                                              
            <div class="list-group border-bottom push-down-20">
                <a href="#" class="list-group-item" style="Background-color:#f34c4c;" ><h4><span class="fa fa-dashboard"></span>Inv Information (kW)</h4></a>
                <a id="{{$Inverters->SerialNo}}10" href="#" class="list-group-item" style="text-align:center;font-size:30px;">{{$Inverters->Pac}}</a>
                <a href="#" class="list-group-item" style="Background-color:#33FFBD;" ><h4><span class="fa fa-credit-card"></span>Serial Number</h4></a>                
                <a id="{{$Inverters->SerialNo}}11" href="#" class="list-group-item" style="text-align:center;font-size:30px;">{{$Inverters->SerialNo}}</a>
                <a href="#" class="list-group-item" style="Background-color:#DAF7A6;" ><h4><span class="fa fa-cog"></span>Inverter Status</h4></a>                                                
                <a id="{{$Inverters->SerialNo}}12" href="#" class="list-group-item" style="text-align:center;font-size:30px;">{{$Inverters->tbPcsStatusDescripts->Descript}}</a>
                <a href="#" class="list-group-item" style="Background-color:#FFF42D;" ><h4><span class="fa fa-list-alt"></span>Description</h4></a>                                                                
                <a href="#" class="list-group-item" style="text-align:center;font-size:30px;">--</a>                
            </div> 
        @endforeach                                             
        </div>      
    </div>
    <div class="row">
    
    @foreach($Pvinfo as $Pvinfos )
    <div class="col-md-2">
    <div class="panel panel-default">
                                <div id="Invnode{{$Pvinfos->StringNo}}" class="panel-body profile" style="background-color:#fff;align:center;">
                                    <div class="profile-image  ">
                                    <!-- ใส่ chart  -->
                                    <div id="container-{{$Pvinfos->StringNo}}" style="height:150px;"></div>
                                    </div>
                                    <div style="margin-top:0px;padding-top:0px;">
                                        <div class="profile-data-name" style="color:black;font-size:15px"> Voltage(V) : <span id="{{$Pvinfos->StringNo}}0" class=" pull-right"><img style="height:20px;width:20px;" src="M250\img\pvloaddata.gif"></span></div>
                                        <div class="profile-data-name" style="color:black;font-size:15px"> Current(A) : <span id="{{$Pvinfos->StringNo}}1" class=" pull-right"><img style="height:20px;width:20px;" src="M250\img\pvloaddata.gif"></span></div>
                                        <div class="profile-data-name" style="color:black;font-size:15px"> Error : <span id="{{$Pvinfos->StringNo}}2" class=" pull-right"><img style="height:20px;width:20px;" src="M250\img\pvloaddata.gif"></span></div>
                                        <div class="profile-data-name" style="color:black;font-size:15px"> Temp : <span id="{{$Pvinfos->StringNo}}3" class=" pull-right"><img style="height:20px;width:20px;" src="M250\img\pvloaddata.gif"></span></div>
                                    </div>
                                    
                                </div>                                
    </div>
    </div>
    <script>
    
Highcharts.chart('container-{{$Pvinfos->StringNo}}', {

chart: {
    type: 'gauge',
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    margin: [30, 0, 0, 0],
    plotShadow: false
},

title: {
    text:'String:{{$Pvinfos->StringNo}}'
},
exporting: {
    enabled: false
},
credits: {
      enabled: false
},
pane: {
    startAngle: -120,
    endAngle: 120,
    background: [{
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
                [0, '#FFF'],
                [1, '#333']
            ]
        },
        borderWidth: 0,
        outerRadius: '109%'
    }, {
        backgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
                [0, '#333'],
                [1, '#FFF']
            ]
        },
        borderWidth: 1,
        outerRadius: '107%'
    }, {
        // default background
    }, {
        backgroundColor: '#DDD',
        borderWidth: 0,
        outerRadius: '105%',
        innerRadius: '103%'
    }]
},

// the value axis
yAxis: {
    min: 0,
    max: 4.3,

    minorTickInterval: 'auto',
    minorTickWidth: 1,
    minorTickLength: 10,
    minorTickPosition: 'inside',
    minorTickColor: '#666',

    tickPixelInterval: 30,
    tickWidth: 2,
    tickPosition: 'inside',
    tickLength: 10,
    tickColor: '#666',
    labels: {
        step: 2,
        rotation: 'auto'
    },
    title: {
        // text: 'km/h'
    },
    plotBands: [{
        from: 0,
        to: 1.5,
        color: '#55BF3B' // green
    }, {
        from: 1.5,
        to: 3,
        color: '#DDDF0D' // yellow
    }, {
        from: 3,
        to: 4.3,
        color: '#DF5353' // red
    }]
},

series: [{
    name: 'Power',
    data: [{{$Pvinfos->Power}}],
    // tooltip: {
    //     valueSuffix: ' km/h'
    // }
}]

},
// Add some life
function (chart) {
if (!chart.renderer.forExport) {
    setInterval(function () {
        var point = chart.series[0].points[0],
            newVal
        $.ajax(
            {
                url: "/getlivePV?Serial={{$Pvinfos->StringNo}}&pcsid={{$Pvinfos->PcsID}}&mbxid={{$Pvinfos->MBxID}}",
                type: 'GET',   
            }).done( 
                function(newVal) 
                    {
                        // newVal=data;
                        // console.log(newVal);          
                        point.update(newVal);
                    });
        $.ajax(
            {
                url: "/getPvdetail?Serial={{$Pvinfos->StringNo}}&pcsid={{$Pvinfos->PcsID}}&mbxid={{$Pvinfos->MBxID}}",
                type: 'GET',   
            }).done( 
                function(pvarray) 
                    {
                        // console.log(pvarray);
                        pvarray.forEach(function(element,index) {
                        // console.log(index+"->"+element); 
                        document.getElementById("{{$Pvinfos->StringNo}}"+index).innerHTML = '<span class="badge badge-danger pull-right"> '+element+' </span>' ;    
                    });       
            });     
    }, 20000);
}
});
    </script>
@endforeach   
</div>
<script>
            $('#MTB').on('change',function(e){
                // console.log(e);
                var MBXID = e.target.value;
                $.get('/getmasterbox?MBXID=' +MBXID, function(data){
                    $('#INV').empty();
                    // console.log(data);
                    $.each(data, function(index, masterbox){
                    $('#INV').append('<option value="'+masterbox.PcsID+'">'+masterbox.PcsID+'</option>');
                        });
                });
            });
</script> 
<script>
function GOGO(){
    // console.log("OK");
    MasterBoxid = document.getElementById('MTB').value;    
    PcsID = document.getElementById('INV').value;
    // console.log(MasterBoxid,PcsID);  
    $(window.location.href = '/InvDetail?id='+PcsID+'&mbid='+MasterBoxid);                
}
</script>
@endsection
