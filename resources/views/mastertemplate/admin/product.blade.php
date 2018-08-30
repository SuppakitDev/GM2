@extends('mastertemplate.admin.adminlayout')
    @section('content')
        <div class="clearfix"></div>
         <!--START Preloading when insert New product -->
         <script src="js/jquery-3.2.1.js"></script>
                                                    <script>
                                                        $(document).ready(function() 
                                                            {
                                                                $('#loaderadd').hide();
                                                            });
                                                            $(document).ready(function() 
                                                            {
                                                                $('#addproduct').submit(function() 
                                                                {
                                                               $('#loaderadd').show();
                                                                   
                                                                }) 
                                                            })
                                                    </script>
        <!--STOP Preloading when insert New product -->
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><span class="fa fa-home"></span> Product List</h2>
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
                  <a href="#addproduct" data-toggle="modal"><button type='button' class='btn btn-success'><i class="fa fa-plus"></i> Add product</button></a>
                  <div class="x_content">
                    <table  class="table table-striped table-bordered">
                      <thead >
                        <tr >
                          <th  class="priority-1" >Image</th>
                          <th class="priority-2" >Product name</th>
                          <th class="priority-3" >Product_model</th>
                          <th class="priority-5" >Edit</th>
                          <th class="priority-6" >Delete</th>
                        </tr>
                      </thead>
                      @foreach($productdata as $product)
                      @if( !$loop->first )
                      <tbody>
                        <tr align="center" >
                          <td class="priority-1" ><img width="40" src="img\imgproduct\resize\{{$product->P_Img}}"></td>
                          <td class="priority-2" >{{$product->P_Name}}</td>
                          <td class="priority-3" >{{$product->P_Model}}</td>
                          <td class="priority-5" style="text-align:center;">
                          <a href="#editproduct{{$product->id}}" data-toggle="modal"><button type='button' class='btn btn-warning'><i class="fa fa-pencil-square-o"></i></button></a>
                          </td>
                          <td class="priority-6" style="text-align:center;">
                          <?= Form::open(array('url' => 'product/' . $product->id, 'method' => 'DELETE')) ?>
                            <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure? This will remove this product.')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            {!! Form::close() !!}
                          </td>
                      </tbody>

                      <!--START MODAL Edit -->
                      <div id="editproduct{{$product->id}}" class="modal fade" role="dialog" >
                     
                      <?= Form::open(array( 'class'=>'formedit' , 'files' => true, 'url' => 'product/' . $product->id, 'method' => 'POST')) ?>
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Edit product</h4>
                                            </div>
                                            <div class="modal-body" style="margin-left:10%" >    
                                                <div class="form-group">
                                                    <label class="control-label col-sm-8">Product Name:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="item_name" 
                                                        name="pname" value="{{$product->P_Name}}" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-8">Product Model:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="item_name" 
                                                        name="pmodel" value="{{$product->P_Model}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-8">Comment</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="pcomment" cols="30" rows="3">{{$product->Comment}}</textarea> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                <label class="control-label col-sm-8">Image</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="pimage"> 
                                                    </div>
                                                </div>
                                                <div class="form-group"    >
                                                <label class="control-label col-sm-8">Specification</label>
                                                    <div class="col-sm-8" >
                                                        <input   type="file" name="Specification"> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-8" style="margin-left:62%;">
                                                    <button onclick="pic1()" type="submit" class="btn btn-success" name="update_item"><span class="glyphicon glyphicon-edit"></span>Edit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button>
                                                    </div>
                                                    </div>
                                                    </div>
                                            
                                                <div class="modal-footer">
                                                
                                                </div>
                                            </div>
                                        </div>
                            {!! Form::close() !!}
                        </div>
                      <!--STOP MODAL Edit -->
                       
                        @endif
                      @endforeach
                    </table>
                    {!! $productdata->render() !!}
                  </div>
                </div>
                    <!-- MODAL ADD -->
                    <div id="addproduct" class="modal fade" role="dialog" >
                    <form id="addproduct" method="POST" action="product" class="form-horizontal" role="form" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Add product</h4>
                                            </div>
                                            <div class="modal-body">    
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Product Name:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="item_name" 
                                                        name="pname" value="" required autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Product Model:</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="item_name" 
                                                        name="pmodel" value="" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Comment</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="pcomment" cols="30" rows="3"></textarea> 
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Image (Min size 2000 x 2000 px.)</label>
                                                    <div class="col-sm-6">
                                                        <input type="file" name="pimage"> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4">Specification  (Min size 2000 x 2000 px.)</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" name="Specification" value=""> 
                                                    </div>
                                                </div>
                                                <!--START Preloading when insert New product -->
                                                    <div id="loaderadd" align="center"   >
                                                        <img height="5%" width="20%" src="img/preloader.gif" alt="">
                                                    </div>
                                                <!--STOP Preloading when insert New product -->
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
    