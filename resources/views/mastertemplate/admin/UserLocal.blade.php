@extends('mastertemplate.admin.adminlayout')
    @section('content')
        <div class="clearfix"></div>
            <div class="row">
@if($errors->all())
        <script>
        $(document).ready(function(){
        $("#adduserlocal").modal();
            });
</script>
@endif 

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><span class="fa fa-home"></span> Manager in project</h2>
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
                  <a href="#adduserlocal" data-toggle="modal"><button type='button' class='btn btn-success'><i class="fa fa-plus"></i> Add manager</button></a>
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
                      @foreach($userlocal as $userlocals)
                 
                      <tbody>
                        <tr>
                          <td class="priority-1" >{{$userlocals->Fname}}</td>
                          <td class="priority-2" >{{$userlocals->Lname}}</td>
                          <td class="priority-3" >{{$userlocals->Tel}}</td>
                          <td class="priority-4" >{{$userlocals->email}}</td>
                          <td class="priority-5" style="text-align:center;">
                          <a href="#edituserlocal{{$userlocals->id}}" data-toggle="modal"><button type='button' class='btn btn-warning'><i class="fa fa-pencil-square-o"></i></button></a>
                          </td>
                          <td class="priority-6" style="text-align:center;">
                          <?= Form::open(array('url' => 'Userlocal/'.$userlocals->id,'method'=>'DELETE')) ?>
                            <button type="submit"  class="btn btn-danger" onclick="return confirm('Are you sure? This will remove this Company.')" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                            {!! Form::close() !!}
                          </td>
                      </tbody>
                        <!-- MODAL Edit -->
                            <div id="edituserlocal{{$userlocals->id}}" class="modal fade" role="dialog" >
                                <div class="w3-center"><br>
                                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:500px;margin-top:10%">
                                    <?= Form::model($userlocals, array('url'=> 'adminprofile/'.$userlocals->id, 'method' => 'PUT','files' => true)) ?>
                                        {{ csrf_field() }}
                                        <div class="modal-content">
                                        <div class="modal-body">
                                        <div class="col-xs-12"  align='center' style="padding-bottom: 15px;" >
                                            <img src="img/profiles/resize/{{$userlocals->image}}" class="img-circle" alt="User Image">
                                        </div>
                                        <div class="col-xs-6" >
                                            <div class="form-group" >
                                                <?= Form::label('Fname','First Name');?>
                                                <?= Form::text('Fname',$userlocals->Fname,['class' => 'form-control select2','placeholder' => 'First Name' ,'style' => 'width: 100%;' ]);?>
                                            </div>
                                        </div>
                                        <div class="col-xs-6" >
                                            <div class="form-group" >
                                                <?= Form::label('Lname','Last Name');?>
                                                <?= Form::text('Lname',$userlocals->Lname,['class' => 'form-control select2','placeholder' => 'Last Name']);?>
                                            </div>
                                        </div>
                                        <div class="col-xs-6" >
                                            <div class="form-group" >
                                                <?= Form::label('username','UserName');?>
                                                <?= Form::text('username',$userlocals->username,['class' => 'form-control','placeholder' => 'UserName']);?>
                                            </div>
                                        </div>
                                        <div class="col-xs-6" >
                                            <div class="form-group" >
                                                <?= Form::label('Tel','Phone Number');?>
                                                <?= Form::text('Tel',$userlocals->Tel,['class' => 'form-control','placeholder' => 'Phone Number']);?>
                                            </div>
                                        </div>
                                        <div class="col-xs-6" >
                                            <div class="form-group" >
                                                <?= Form::label('email','E-mail');?>
                                                <?= Form::text('email',$userlocals->email,['class' => 'form-control','placeholder' => 'E-mail']);?>
                                            </div>
                                        </div>
                                        
                                        <!-- <div class="col-xs-4" style="margin-left:4%">
                                            <div class="form-group" >
                                                <?= Form::label('','Change password');?><br>
                                                <a href="adminchangepass" class="btn btn-warning">Change password</a>
                                            </div>
                                        </div> -->
                                        <div class="col-xs-6" >
                                            <div class="form-group" >
                                                <?= Form::submit('Save',['class' => 'btn btn-success']);?>
                                                <a href="#" data-dismiss="modal" class="btn btn-danger">Cancle</a> 
                                            </div>
                                        </div>
                                        <?= Form::hidden('image55',$userlocals->image,['class' => 'form-control']);?>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> Edit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> NO</button> -->
                                                                            </div>
                                        </div>
                    {!! Form::close() !!}
                                    </div>
                                </div>
                        </div>
                                        
                                            @endforeach
                                            </table>
                                            
                                        </div>
                                        </div>
                                    </div>
                        <!-- MODAL ADD -->
                        <div id="adduserlocal" class="modal fade" role="dialog" >
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}" role="form" >
        {{ csrf_field() }}
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New user</h4>
                    </div>
                    <div class="modal-body"> 
                    <section id="login">
                        <div class="box-body">
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="username" >Username</label>
                                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                        @if ($errors->has('username'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }}">
                                    <div class="col-md-12">  
                                        <label for="Fname">First name</label>
                                        <input id="Fname" type="text" class="form-control" name="Fname" value="{{ old('Fname') }}" required autofocus>
                                        @if ($errors->has('Fname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Fname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="Lname" >Last Name</label>
                                        <input id="Lname" type="text" class="form-control" name="Lname" value="{{ old('Lname') }}" required autofocus>
                                        @if ($errors->has('Lname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Lname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="email">Email address</label>
                                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('Tel') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="Tel" >Phone number</label>
                                        <input id="Tel" type="text" class="form-control" name="Tel" value="{{ old('Tel') }}" required autofocus>
                                        @if ($errors->has('Tel'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('Tel') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('site') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="site" >Site Installing</label>
                                       
                                        <select class="form-control" name="site" id="site"  >
                                        <option value="{{ old('site') }}" required>{{ old('site') }}</option>     
                                            @foreach($SiteLocal as $SiteLocals)
                                                <option value="{{$SiteLocals->UserID}}">{{$SiteLocals->SiteName}}</option>                                                
                                            @endforeach    
                                            </select>
                                        @if ($errors->has('site'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('site') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                               
                            </div> 
                            

                            <!-- hiddent -->
                                    <input id="SerialItem" type="hidden" name="SerialItem[]" value="" required>
                                    <input id="Staus" type="hidden" name="Status" value="MANAGER" required>
                                    <input id="P_ID" type="hidden" name="P_ID" value="1" required>
                                    <input id="C_ID" type="hidden" name="C_ID" value="{{ Auth::user()->C_ID}}" required>
                                    <input id="CreateBy" type="hidden" name="CreateBy" value="{{Auth::user()->id}}" required> 
                                    <input type="hidden" name="redirecTo" value="/userfilter"/>
                            <!-- end hiddent -->
                            <!-- password -->
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="col-md-12">
                                        <label for="password">Password  <a style="color:#ff9966" class="fa fa-eye-slash" onclick="showPassword()" >Showpassword</a></label>
                                        <input id="password" type="password" class="form-control" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>                       
                            </div>
                            
                                <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Add user">                         
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
    