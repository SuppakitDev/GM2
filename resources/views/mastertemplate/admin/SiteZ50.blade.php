@extends('mastertemplate.admin.adminlayout')
    @section('content')
        <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><span class="fa fa-home"></span> Customer Site in Z50-GW product.</h2>
                   <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul> 
                    <div class="clearfix"></div>
                  </div>
                  <a href="#addsitez50" data-toggle="modal"><button type='button' class='btn btn-success'><i class="fa fa-plus"></i> Add Site</button></a>
                  <div class="x_content">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="priority-1" >SiteName</th>
                          <th class="priority-2" >Company</th>
                          <th class="priority-3" >Tal</th>
                          <th class="priority-4" >INVModel</th>
                          <th class="priority-5" >EDIT</th>
                          <th class="priority-6" >DELETE</th>
                        </tr>
                      </thead>
                      @foreach($siteall as $sitealls)
                     
                    <tbody>
                        <tr>
                          <td class="priority-1" >{{$sitealls->SiteName}}</td>
                          <td class="priority-2" >{{$sitealls->client_companyz50->C_Name}}</td>
                          <td class="priority-3" >{{$sitealls->Tal}}</td>
                          <td class="priority-4" >{{$sitealls->INVModel}}</td>
                          <td class="priority-5" style="text-align:center;">
                          <a href="#editSitez50{{$sitealls->Site_ID}}" data-toggle="modal"><button type='button' class='btn btn-warning'><i class="fa fa-pencil-square-o"></i></button></a>
                          </td>
                          <td class="priority-6" style="text-align:center;">
                            <?= Form::open(array('url' => 'Sitez50/'.$sitealls->Site_ID,'method'=>'DELETE')) ?>
                            <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure? This will remove this Site.')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            {!! Form::close() !!}
                          </td>
                    </tbody>
                        <!-- MODAL Edit -->
                            <div id="editSitez50{{$sitealls->Site_ID}}" class="modal fade" role="dialog" >
                                <div class="w3-center"><br>
                                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px;margin-top:10%">
                                        <?= Form::open(array('url' => 'Sitez50/'.$sitealls->Site_ID,'method'=>'POST' ,'enctype'=>'multipart/form-data')) ?>
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit {{ $sitealls->SiteName }}</h4>
                                                </div>
                                                <div class="modal-body"> 
                                                    <section id="login">
                                                        <div class="box-body">
                                                            <div class="row">
                                                            <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="C_ID" >Company</label>
                                                                            <select class="form-control" name="C_ID" id="C_ID"  >
                                                                            <option value="{{$sitealls->Site_ID}}"selected >{{$sitealls->client_companyz50->C_Name}}</option>
                                                                            @foreach($companydata as $companydatas)
                                                                                <option value="{{$companydatas->id}}">{{$companydatas->C_Name}}</option>                                                
                                                                            @endforeach    
                                                                            </select>
                                                                    </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group">
                                                                    <div class="col-md-12">  
                                                                        <label for="Sname">Site name</label>
                                                                        <input id="Sname" type="text" class="form-control" name="Sname" value="{{$sitealls->SiteName}}" required > 
                                                                    </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="Email">Tel</label>
                                                                        <input id="Tel" type="Tel" class="form-control" name="Tel" value="{{$sitealls->Tal}}" required>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <div class="col-md-12">  
                                                                        <label for="Invmodel">Inv Model</label>
                                                                        <select class="form-control" name="Invmodel" id="Invmodel"  >
                                                                            <option value="{{$sitealls->INVModel}}" selected >{{$sitealls->INVModel}}</option>
                                                                            <option value="m250">m250</option>                                                  
                                                                            <option value="Z50">Z50</option>                                                  
                                                                            </select>  
                                                                    </div>
                                                                    </div>

                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="Email">Email</label>
                                                                        <input id="Email" type="email" class="form-control" name="Email" value="{{$sitealls->Email}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="Address">Address</label>
                                                                        <textarea rows="2" cols="50" name="Address" class="form-control"  >{{$sitealls->Address}}</textarea>
                                                                    </div>
                                                                </div>
                                                                
                                                                                    
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="Email">SerialNo</label>
                                                                        
                                                                        <textarea rows="4" cols="50" name="SerialNo" class="form-control"  >{{$sitealls->SerialNolist}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="LineToken">LineToken</label>
                                                                        <input id="LineToken" type="text" class="form-control" name="LineToken" value="{{$sitealls->Notifytoken}}" required>
                                                                    </div>
                                                                </div>                      
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="FIT">Feed in tariff</label>
                                                                        <input id="FIT" type="text" class="form-control" name="FIT" value="{{$sitealls->FIT}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                    <label for="CO2">Co2_Criterion</label>
                                                                        <input id="CO2" type="text" class="form-control" name="CO2" value="{{$sitealls->Co2_Criterion}}" required>
                                                                    </div>
                                                                </div>  
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                    <label for="Capacity">Capacity</label>
                                                                        <input id="Capacity" type="text" class="form-control" name="Capacity" value="{{$sitealls->Capacity}}" required>
                                                                    </div>
                                                                </div>   
                                                            </div>
                                                            
                                                                                    
                                                        </div>  
                                                    </section>
                                                </div>
                                                
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button>
                                                    </div>
                                                </div>
                                                {!! Form::close() !!}
                                    </div>
                                </div>
                        </div>
                                       
                                            @endforeach
                                            </table>
                                            {!! $companydata->render() !!}
                                        </div>
                                        </div>
                                    </div>
                        <!-- MODAL ADD -->
                        <div id="addsitez50" class="modal fade" role="dialog" >
                        <!-- <form class="form-horizontal" method="POST" action="site" role="form" > -->
                        <form  method="POST" action="Sitez50" class="form-horizontal" role="form" enctype="multipart/form-data" >
                                {{ csrf_field() }}
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">New Site</h4>
                                            </div>
                                            <div class="modal-body"> 
                                            <section id="login">
                                                <div class="box-body">
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="C_ID" >Company</label>
                                                                    <select class="form-control" name="C_ID" id="C_ID"  >
                                                                    <option value="#" disabled selected >select company</option>
                                                                    @foreach($companydata as $companydatas)
                                                                        <option value="{{$companydatas->id}}">{{$companydatas->C_Name}}</option>                                                
                                                                    @endforeach    
                                                                    </select>
                                                            </div>
                                                            </div>
                                                            <div class="form-group">
                                                            <div class="col-md-12">  
                                                                <label for="Sname">Site name</label>
                                                                <input id="Sname" type="text" class="form-control" name="Sname" required autofocus> 
                                                            </div>
                                                            </div>
                                                    </div>
                                                
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                            <div class="col-md-12">  
                                                                <label for="Invmodel">Inv Model</label>
                                                                <select class="form-control" name="Invmodel" id="Invmodel"  >
                                                                    <option value="#" disabled selected >select Model</option>
                                                                    <option value="m250">m250</option>                                                  
                                                                    <option value="Z50">Z50</option>                                                  
                                                                    </select>  
                                                            </div>
                                                            </div>
                                                        
                                                            <div class="form-group">
                                                            <div class="col-md-12">  
                                                                <label for="Tel">Telephone</label>
                                                                <input id="Tel" type="tel" class="form-control" name="Tel" required autofocus> 
                                                            </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                        
                                                            
                                                            <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="simage" >Site Image</label>
                                                                <input type="file" name="simage" value="Select image" id="simage" alt="placeholder image" />
                                                            </div>
                                                            </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="Email">Email</label>
                                                                <input id="Email" type="email" class="form-control" name="Email" required>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                        
                                                                    <div class="col-md-6">
                                                                        <label for="FIT">Feed in tariff</label>
                                                                        <input id="FIT" type="text" class="form-control" name="FIT" value="" required>
                                                                    </div>
                                                                
                                                                
                                                                    <div class="col-md-6">
                                                                    <label for="CO2">Co2_Criterion</label>
                                                                        <input id="CO2" type="text" class="form-control" name="CO2" value="" required>
                                                                    </div>
                                                                   
                                                                 
                                                            <div class="col-md-6">
                                                                <label for="Address">Address</label>
                                                                <textarea rows="4" cols="50" name="Address" class="form-control" > Enter Address here...</textarea>
                                                                
                                                            </div>
                                                            <div class="col-md-6">
                                                                    <label for="LineToken">LineToken</label>
                                                                        <input id="LineToken" type="text" class="form-control" name="LineToken" value="" required>
                                                                    </div>
                                                             <div class="col-md-6">
                                                                    <label for="Capacity">Capacity</label>
                                                                        <input id="Capacity" type="text" class="form-control" name="Capacity" value="" required>
                                                                    </div>
                                                            <div class="col-md-6">
                                                                <label for="Email">Inverter SerialNo</label>
                                                                <div id="main">
                                                                    <input type="button" id="btAdd" value="Add serial" class="bt btn-info" />
                                                                    <input type="button" id="btRemove" value="Remove serial" class="bt btn-warning" />
                                                                    <input type="button" id="btRemoveAll" value="Remove All" class="bt btn-danger" /><br />
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                      
                                                                            
                                                    </div>
                                                    
                                                        
                                                                            
                                                    </div>
                                                        <input type="submit" id="btn-login" class="btn btn-success btn-lg btn-block" value="Add Site">                         
                                                </div>  
                                            </section>
                                            </div>   
                                    </div>
                                    </div>
                            </form>   

                        </div>
        @endsection
        @section('script')
        <script>
    $(document).ready(function() {

        var iCnt = 0;
        // CREATE A "DIV" ELEMENT AND DESIGN IT USING jQuery ".css()" CLASS.
        var container = $(document.createElement('div')).css({
            padding: '5px', margin: '22px', width: '69%', border: '1px dashed',
            borderTopColor: '#999', borderBottomColor: '#999',
            borderLeftColor: '#999', borderRightColor: '#999'
        });

        $('#btAdd').click(function() {
            if (iCnt <= 19) {

                iCnt = iCnt + 1;

                // ADD TEXTBOX.
                $(container).append('<input style="margin-bottom:2%;" type=text name="Serialarray[]" class="input" id=tb' + iCnt + ' ' +
                    'placeholder="SerialNo Inv : ' + iCnt + '" />');

                // SHOW SUBMIT BUTTON IF ATLEAST "1" ELEMENT HAS BEEN CREATED.
                if (iCnt == 1) {
                    var divSubmit = $(document.createElement('div'));
                    $(divSubmit).append('<input type=hidden class="bt"' + 
                        'onclick="GetTextValue()"' + 
                            'id=btSubmit value=Submit />');
                }

                // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                $('#main').after(container, divSubmit);
            }
            // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON.
            // (20 IS THE LIMIT WE HAVE SET)
            else {      
                $(container).append('<label>Reached the limit</label>'); 
                $('#btAdd').attr('class', 'bt-disable'); 
                $('#btAdd').attr('disabled', 'disabled');
            }
        });

        // REMOVE ONE ELEMENT PER CLICK.
        $('#btRemove').click(function() {
            if (iCnt != 0) { $('#tb' + iCnt).remove(); iCnt = iCnt - 1; }
        
            if (iCnt == 0) { 
                $(container)
                    .empty() 
                    .remove(); 

                $('#btSubmit').remove(); 
                $('#btAdd')
                    .removeAttr('disabled') 
                    .attr('class', 'bt');
            }
        });

        // REMOVE ALL THE ELEMENTS IN THE CONTAINER.
        $('#btRemoveAll').click(function() {
            $(container)
                .empty()
                .remove(); 

            $('#btSubmit').remove(); 
            iCnt = 0; 
            
            $('#btAdd')
                .removeAttr('disabled') 
                .attr('class', 'bt');
        });
    });

    // PICK THE VALUES FROM EACH TEXTBOX WHEN "SUBMIT" BUTTON IS CLICKED.
    var divValue, values = '';

    function GetTextValue() {
        $(divValue) 
            .empty() 
            .remove(); 
        
        values = '';

        $('.input').each(function() {
            divValue = $(document.createElement('div')).css({
                padding:'5px', width:'200px'
            });
            values += this.value + '<br />'
        });

        $(divValue).append('<p><b>Your selected values</b></p>' + values);
        $('body').append(divValue);
    }
</script>
        <!-- Datatables -->
        <script src="admin/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
        <script src="admin/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="admin/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="admin/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
        <script src="admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
        <script src="admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
        <script src="admin/vendors/jszip/dist/jszip.min.js"></script>
        <script src="admin/vendors/pdfmake/build/pdfmake.min.js"></script>
        <script src="admin/vendors/pdfmake/build/vfs_fonts.js"></script>
        @include('Alerts::alerts')
        @endsection
    