<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> 
        <link rel="stylesheet" type="text/css" id="theme" href="m250/css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="m250/css/M250css.css"/>
        <script type="text/javascript" src="m250/js/m250js.js"></script>    
        <script src="https://code.highcharts.com/stock/highstock.js"></script> 
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/animate.css@3.5.2/animate.css" type="text/css" />
        <link rel="stylesheet" href="https://unpkg.com/rmodal@1.0.28/dist/rmodal.css" type="text/css" />
        <script type="text/javascript" src="https://unpkg.com/rmodal@1.0.26/dist/rmodal.js"></script>  
        <link rel="stylesheet" type="text/css" href="css/sweetalert.css">     
    <title>Debug z50 page</title>
</head>
<body>
    <h1 style="text-align:center;">Debug Z50 from wifi module(ESP-8266)</h1>
    <div class="col-md-12"> 
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
                    url: "/Debugdaily?MB=1&INV=1",
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
                    url: "/Debugmonthly?MB=1&INV=1",
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
                    url: "/Debugyearly?MB=1&INV=1",
                    type: 'GET',
                }).done( 
                    function(data) 
                    {
                        $('.Invchart').html(data.html);
                    }
                );
                }
              </script>        
</body>
<script type="text/javascript" src="m250/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="m250/js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="m250/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="m250/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="m250/js/plugins/scrolltotop/scrolltopcontrol.js"></script>             
<script type="text/javascript" src="m250/js/plugins/owl/owl.carousel.min.js"></script>   
<script src="js/sweetalert.js"></script>
</html>