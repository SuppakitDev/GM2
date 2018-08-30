@extends('mastertemplate.admin.adminlayout')
    @section('content')
        <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><span class="fa fa-home"></span> Customer Site</h2>
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
                  <a href="#addcompany" data-toggle="modal"><button type='button' class='btn btn-success'><i class="fa fa-plus"></i> Add Site</button></a>
                  <div class="x_content">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="priority-1" >SiteName</th>
                          <th class="priority-2" >Company</th>
                          <th class="priority-3" >Capacity</th>
                          <th class="priority-4" >InstallationType</th>
                          <th class="priority-5" >EDIT</th>
                          <th class="priority-6" >DELETE</th>
                        </tr>
                      </thead>
                      @foreach($siteall as $sitealls)
                     
                    <tbody>
                        <tr>
                          <td class="priority-1" >{{$sitealls->SiteName}}</td>
                          <td class="priority-2" >{{$sitealls->client_companys->C_Name}}</td>
                          <td class="priority-3" >{{$sitealls->Capacity}}</td>
                          <td class="priority-4" >{{$sitealls->InstallationType}}</td>
                          <td class="priority-5" style="text-align:center;">
                          <a href="#editsitelocal{{$sitealls->UserID}}" data-toggle="modal"><button type='button' class='btn btn-warning'><i class="fa fa-pencil-square-o"></i></button></a>
                          </td>
                          <td class="priority-6" style="text-align:center;">
                            <?= Form::open(array('url' => 'site/'.$sitealls->UserID,'method'=>'DELETE')) ?>
                            <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure? This will remove this Site.')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            {!! Form::close() !!}
                          </td>
                    </tbody>
                        <!-- MODAL Edit -->
                            <div id="editsitelocal{{$sitealls->UserID}}" class="modal fade" role="dialog" >
                                <div class="w3-center"><br>
                                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px;margin-top:10%">
                                        <?= Form::open(array('url' => 'site/'.$sitealls->UserID,'method'=>'POST' ,'enctype'=>'multipart/form-data')) ?>
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
                                                                            <option value="{{$sitealls->UserID}}"selected >{{$sitealls->client_companys->C_Name}}</option>
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
                                                                
                                                                    <div class="form-group">
                                                                    <div class="col-md-12">  
                                                                        <label for="fit">Feed-in tariff (THB)</label>
                                                                        <input id="fit" type="text" class="form-control" name="fit" value="{{$sitealls->FIT}}" > 
                                                                    </div>
                                                                    </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                    <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label for="Capacity" >Capacity</label>
                                                                        <input id="Capacity" type="text" class="form-control" name="Capacity" value="{{$sitealls->Capacity}}">
                                                                    </div>
                                                                    </div>
                                                                
                                                                    <div class="form-group">
                                                                    <div class="col-md-12">  
                                                                        <label for="InstallT">InstallationType</label>
                                                                        <select class="form-control" name="InstallT" id="InstallT"  >
                                                                            <option value="{{$sitealls->InstallationType}}" selected >{{$sitealls->InstallationType}}</option>
                                                                            <option value="m250">1</option>                                                  
                                                                            <option value="Z50">2</option>                                                  
                                                                            </select> 
                                                                    </div>
                                                                    </div>
                                                                    
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
                                                                        <input id="Email" type="email" class="form-control" name="Email" value="{{$sitealls->Email}}" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <label>Environment Sensors</label><br>
                                                                        <input type="checkbox" id="SolarS{{$sitealls->UserID}}" name="SolarS"  >Solar Radiation Sensor<br>                                    
                                                                        <input type="checkbox" id="TempS{{$sitealls->UserID}}" name="TempS" >Temperature Sensor<br>
                                                                    </div>

                                                                    <script>
                                                                            if({{ $sitealls->SRI_sensor }} == 1){
                                                                                document.getElementById("SolarS{{$sitealls->UserID}}").checked = true;
                                                                                document.getElementById("SolarS{{$sitealls->UserID}}").value = 1;                                                 
                                                                                
                                                                            }
                                                                            else{
                                                                                document.getElementById("SolarS{{$sitealls->UserID}}").checked = false;                                                 
                                                                                document.getElementById("SolarS{{$sitealls->UserID}}").value = 0;                                                 
                                                                            }

                                                                            if({{ $sitealls->Temp_sensor }} == 1){
                                                                                document.getElementById("TempS{{$sitealls->UserID}}").checked = true; 
                                                                                document.getElementById("TempS{{$sitealls->UserID}}").value = 1;                                                 
                                                                                                                            
                                                                            }
                                                                            else{
                                                                                document.getElementById("TempS{{$sitealls->UserID}}").checked = false;
                                                                                document.getElementById("TempS{{$sitealls->UserID}}").value = 0;                                                 
                                                                                                                                
                                                                            }
                                                                    </script>
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
                        <div id="addcompany" class="modal fade" role="dialog" >
                        <!-- <form class="form-horizontal" method="POST" action="site" role="form" > -->
                        <form  method="POST" action="site" class="form-horizontal" role="form" enctype="multipart/form-data" >
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
                                                                <label for="fit">Feed-in tariff (THB)</label>
                                                                <input id="fit" type="text" class="form-control" name="fit" required autofocus> 
                                                            </div>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                            <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="Capacity" >Capacity</label>
                                                                <input id="Capacity" type="text" class="form-control" name="Capacity" value="{{ old('Tel') }}" required autofocus>
                                                            </div>
                                                            </div>
                                                        
                                                            <div class="form-group">
                                                            <div class="col-md-12">  
                                                                <label for="InstallT">InstallationType</label>
                                                                <select class="form-control" name="InstallT" id="InstallT"  >
                                                                    <option value="#" disabled selected >select Type</option>
                                                                    <option value="m250">1</option>                                                  
                                                                    <option value="Z50">2</option>                                                  
                                                                    </select> 
                                                            </div>
                                                            </div>
                                                            
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
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label>Environment Sensors</label><br>
                                                                <input type="checkbox" id="SolarS" name="SolarS"  >Solar Radiation Sensor<br>                                    
                                                                <input type="checkbox" id="TempS" name="TempS" >Temperature Sensor<br>
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
    