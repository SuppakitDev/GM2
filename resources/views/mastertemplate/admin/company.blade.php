@extends('mastertemplate.admin.adminlayout')
    @section('content')
        <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><span class="fa fa-home"></span> Customer company</h2>
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
                  <a href="#addcompany" data-toggle="modal"><button type='button' class='btn btn-success'><i class="fa fa-plus"></i> Add company</button></a>
                  <div class="x_content">
                    <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th class="priority-1" >Name</th>
                          <th class="priority-2" >Start</th>
                          <th class="priority-3" >Tel</th>
                          <th class="priority-4" >Email</th>
                          <th class="priority-5" >Edit</th>
                          <th class="priority-6" >Delete</th>
                        </tr>
                      </thead>
                      @foreach($companydata as $company)
                      @if( !$loop->first )
                      <tbody>
                        <tr>
                          <td class="priority-1" >{{$company->C_Name}}</td>
                          <td class="priority-2" >{{$company->Startdate}}</td>
                          <td class="priority-3" >{{$company->Tel}}</td>
                          <td class="priority-4" >{{$company->Email}}</td>
                          <td class="priority-5" style="text-align:center;">
                          <a href="#editcompany{{$company->id}}" data-toggle="modal"><button type='button' class='btn btn-warning'><i class="fa fa-pencil-square-o"></i></button></a>
                          </td>
                          <td class="priority-6" style="text-align:center;">
                          <?= Form::open(array('url' => 'company/'.$company->id,'method'=>'DELETE')) ?>
                            <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure? This will remove this Company.')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            {!! Form::close() !!}
                          </td>
                      </tbody>
                        <!-- MODAL Edit -->
                            <div id="editcompany{{$company->id}}" class="modal fade" role="dialog" >
                                <div class="w3-center"><br>
                                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px;margin-top:10%">
                                        <?= Form::open(array('url' => 'company/'.$company->id,'method'=>'POST')) ?>
                                            {{ method_field('PUT') }}
                                            {{ csrf_field() }}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Edit {{ $company->C_Name }}</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label >Company name :</label>
                                                    <input type="text" name="cname" value="{{$company->C_Name}}"><br>
                                                    <label >Startdate :</label>
                                                    <input type="date" name="cdate" value="{{$company->Startdate}}"><br>
                                                    <label >Telephone :</label>
                                                    <input type="text" name="ctel" value="{{$company->Tel}}"><br>
                                                    <label >Email :</label>
                                                    <input type="email" name="cemail" value="{{$company->Email}}"><br>
                                                    <label >Address :</label>
                                                    <textarea name="caddress" cols="30" rows="5">{{$company->Address}}</textarea>
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
                                        @endif
                                            @endforeach
                                            </table>
                                            {!! $companydata->render() !!}
                                        </div>
                                        </div>
                                    </div>
                        <!-- MODAL ADD -->
                        <div id="addcompany" class="modal fade" role="dialog" >
                            <form method="POST" action="company" class="form-horizontal" role="form">
                            {{ csrf_field() }}
                                        <div class="modal-dialog modal-md">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Add Company</h4>
                                                </div>
                                                <div class="modal-body">    
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-4">Company Name:</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="item_name" 
                                                            name="cname" value="" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-4">Startdate</label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="item_name" 
                                                            name="cdate" value="" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-4">Telephone</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="item_name" 
                                                            name="ctel" value="" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-4">Email</label>
                                                        <div class="col-sm-8">
                                                            <input type="email" class="form-control" id="item_name" 
                                                            name="cemail" value="" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-4">Address</label>
                                                        <div class="col-sm-8">
                                                        <textarea name="caddress" id="" cols="30" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" name="update_item"><span class="glyphicon glyphicon-edit"></span> Create</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
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
    