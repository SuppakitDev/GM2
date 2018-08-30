@extends('producttemplate.m250.template.m250layout')
@section('Stylesheet')

@endsection
@section('content')
        <style>
        .highcharts-yaxis-grid .highcharts-grid-line {
            display: none;
        }
        </style>
        <script type="text/javascript" src="m250/js/plugins.js"></script>
        <script type="text/javascript" src="m250/js/actions.js"></script> 
                  <!--  START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title" style="margin-top:20px">                    
                            <h2><span class="glyphicon glyphicon-th"></span> Inverter view</h2>
                            <div class="form-group">                                        
                                                <label class="col-sm-1" >MasterBox</label>
                                                <img id="loading-image" style="height:30px;width:100px;" src="M250\img\loadingcall.gif" disable>
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-hdd-o" ></span></span>
                                                        <select id="MNXID" class="form-control" value="1">
                                                <option value="1" disable>MasterBox 1</option>
                                                @foreach($MBX as $MBXID)
                                                <option value="{{$MBXID->MBxID}}" >Masterbox id:{{$MBXID->MBxID}}</option>
                                                @endforeach
                                            </select>  
                                                                                   
                                                    </div>
                                                    
                                                </div>     
                                            </div>
                        </div>                                                             
                    </div>

                    <!-- START CONTENT FRAME BODY -->
                    <div class="AllInv" >
                     
                    <!-- END CONTENT FRAME BODY -->
                    </div>
                </div>               
                <!-- END CONTENT FRAME -->

                <!-- Ajax for filter by MbxID  -->
                <script>
                $('#loading-image').hide();
                
                $('#MNXID').on('change',function(e){
                    
                    var MBxID666 = e.target.value;
                    
                    // console.log(MBxID666);
                    $('#loading-image').show();
                    $.ajax(
                        {
                            url: "/AllInv?MBxID="+MBxID666,
                            type: 'GET',   
                        }).done( 
                            function(data) 
                            {
                                $('#loading-image').hide();
                                $('.AllInv').html(data.html);
                            }
                        );
                    });
                </script>
                <!-- on first time -->
                <script>
                $(document).ready(function() {
                $('#loading-image').hide();
                
                MasterBoxid = document.getElementById('MNXID').value;
                    
                    $('#loading-image').show();
                    $.ajax(
                        {
                            url: "/AllInv?MBxID="+MasterBoxid,
                            type: 'GET',   
                        }).done( 
                            function(data) 
                            {
                                $('#loading-image').hide();
                                $('.AllInv').html(data.html);
                            }
                        );
                });
                </script>

@endsection
@section('Script')

@endsection

