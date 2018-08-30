<!DOCTYPE html>
<html lang="en">
    <head>        
        <title>Z50</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />  
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
        <link rel="stylesheet" type="text/css" id="theme" href="Z50/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="Z50/css/Z50css.css"/>
        <script type="text/javascript" src="Z50/js/Z50js.js"></script>    
        @yield('Stylesheet')        
        

        

  <link rel="stylesheet" type="text/css" href="css/sweetalert.css">                                  
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">           
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="/userfilter">OVERVIEW</a>
                        <a href="#" class="x-navigation-control" ></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="Z50\img\siteimage\resize\{{$Site->Site_img}}" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="Z50\img\siteimage\resize\{{$Site->Site_img}}" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">{{$Site->SiteName}}</div>
                                <!-- <div class="profile-data-title">Site Name</div> -->
                            </div>
                            
                        </div>                                                                        
                    </li>

                    <li class="xn-title" style="font-size:120%"><span class="fa fa-info-circle" style="color:#EA574B;"></span>     Site Information</li>
                  
                    <div id="test"  >
                    
                    </div>
  
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->          
            <!-- PAGE CONTENT -->
            <div class="page-content">               
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
           

                     <li class="pull-right">
                        <a href="#"><span class="fa fa-bars" style="color:#EA574B;"></span></a>
                        <ul class="xn-drop-left">
                            <li><a href="/Z50Profile"><span class="fa fa-user"></span> Profile</a></li>
                            <li><a href="/Z50Managementuser"><span class="fa fa-group"></span> Management User</a></li>
                            <li><a href="/TestNotify"><span class="glyphicon glyphicon-send"></span> LineNotify test</a></li>
                            <!-- <li><a href="/MCOTmonthly?Siteid={{$Site->Site_ID}}&SerialNo={{$Site->SerialNolist}}"><span class="glyphicon glyphicon-cloud-download"></span> Monthly report</a></li> -->
                            <li><a href="/logout"><span class="glyphicon glyphicon-log-in"></span> Log out</a></li>
                                                    
                        </ul>
                    </li>
                    <!-- Profile setting /////////////////////////////////////////////////////-->
                       
                    <!-- Profile setting /////////////////////////////////////////////////////////-->

                    
                    <!-- END TASKS -->
                    <li class=" pull-right">
                        
                        <a href="/GotothisSite"><span class="fa fa-building-o" style="color:#EA574B;" ></span>My site</a>
                        
                     </li>
                    
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     
                <!-- PAGE CONTENT WRAPPER -->
                <div id="content" class="page-content-wrap">
                @yield('content')
                </div>

       
        <script src="js/sweetalert.js"></script>                 
        @yield('Script')   
        @include('Alerts::alerts')      
    </body>
</html>



<script>
$(document).ready(function() {

    
        $.ajax(
            {
                url: "/getserialnolist",
                type: 'GET',   
            }).done( 
                function(serialnolist) 
                    {
                        // console.log(pvarray);
                        var container = document.getElementById("test");
                        serialnolist.forEach(function(serial,index) {
                        
                            container.innerHTML += "<li class='xn'><a href='Z50detail?SerialNo="+serial+"'><span id='Pcsstatus"+index+"' class='fa fa-bolt' style='color: #ffff00'></span> <span class='xn-text'>INV :"+serial+"</span><span class='pull-right'><span id='INV"+index+"'class='fa fa-circle text'></span></span></a></li>" 
                    });       
            });     
    

});

setInterval(function () {
    $.ajax(
            {
                url: "/getstatustranfer",
                type: 'GET',   
            }).done( 
                function(serialnolist) 
                    {
                        // console.log(serialnolist);
                        
                        serialnolist.forEach(function(status,index) {
                        
                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#74EB8A";
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#E9FA5E";                                                             
                                                                    break;
                                                                case "C":         
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "#FB3B36";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("INV"+index).setAttribute("class", "fa fa-circle text");
                                                                    document.getElementById("INV"+index).style.color = "gray";                                                                                                                                                 
                                                            } 

                    });       
            });     
}, 1000); 
setInterval(function () {
    $.ajax(
            {
                url: "/getstatusInverter",
                type: 'GET',   
            }).done( 
                function(serialnolist) 
                    {
                        // console.log(serialnolist);                       
                        serialnolist.forEach(function(status,index) {                        
                            switch(status) {
                                                                case "A":
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FFFF47";
                                                                    break;
                                                                case "B":
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#03EBA6";                                                             
                                                                    break;
                                                                case "C":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#E4523B";
                                                                    break;
                                                                case "D":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#A6A5A1";
                                                                    break;
                                                                case "E":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#50EBC6";
                                                                    break;
                                                                case "F":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#680016";
                                                                    break;
                                                                case "G":         
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FF0000";
                                                                    break;
                                                                default:       
                                                                    document.getElementById("Pcsstatus"+index).setAttribute("class", "fa fa-bolt");
                                                                    document.getElementById("Pcsstatus"+index).style.color = "#FFFFFF";                                                                                                                                                 
                                                            } 
                    });       
            });     
}, 1000); 
</script>
           <script type="text/javascript" src="Z50/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="Z50/js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="Z50/js/plugins/jquery/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
        <script type="text/javascript" src="Z50/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>


