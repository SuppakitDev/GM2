@extends('mastertemplate.admin.adminlayout')
    @section('link')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
    @endsection

    @section('content')
        <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Admin theme</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    
                    <a href="#addnewadmin" data-toggle="modal"><button type='button' class='btn btn-success'><i class="fa fa-plus"></i> New Admin</button></a>
                
                  </div>
                </div>
              </div>
            @foreach ($adminuser as $admin)
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                          <div class="icon">
                        </div>
                        <div class="count"><img src="img/profiles/resize/{{ $admin->image }}" style="width:60px;"></div>
                            <h3>{{ $admin->Fname }}</h3>
                            <p>{{ $admin->email }}</p>
                        </div>
                </div>
            @endforeach
            </div>
        </div>
        </div>
        @if($errors->all())
                <script>
                $(document).ready(function(){
                $("#addnewadmin").modal();
                    });
        </script>
        @endif
<!-- MODAL ADD --> 
    <div class="modal fade" id="addnewadmin" tabindex="-1" role="dialog"  aria-hidden="true">
        <form class="form-horizontal" method="POST" action="{{ route('register') }}" role="form" >
        {{ csrf_field() }}
                <div class="modal-dialog modal-md">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">New admin</h4>
                        </div>
                        <div class="modal-body">    
                            
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- first name -->
                        <div class="form-group{{ $errors->has('Fname') ? ' has-error' : '' }}">
                            <label for="Fname" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="Fname" type="text" class="form-control" name="Fname" value="{{ old('Fname') }}" required autofocus>

                                @if ($errors->has('Fname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Fname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- end first name -->
                        <!-- last name -->
                        <div class="form-group{{ $errors->has('Lname') ? ' has-error' : '' }}">
                            <label for="Lname" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="Lname" type="text" class="form-control" name="Lname" value="{{ old('Lname') }}" required autofocus>

                                @if ($errors->has('Lname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Lname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- end last name -->                   
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- ส่วนที่เพิ่ม Tel -->
                         <div class="form-group{{ $errors->has('Tel') ? ' has-error' : '' }}">
                            <label for="Tel" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="Tel" type="text" class="form-control" name="Tel" value="{{ old('Tel') }}" required>

                                @if ($errors->has('Tel'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 
                        <!-- สิ้นสุดส่วนที่เพิ่ม Tel  -->
                        @if(Auth::user()->Status == 'ADMIN')
                        <input id="P_ID" type="hidden" name="P_ID" value="0" required>
                        <input id="C_ID" type="hidden" name="C_ID" value="0" required>
                        <input id="site" type="hidden" name="site" value="0" required>
                        <!-- <input id="dept" type="hidden" name="dept" value="0" required> -->
                        <!-- <input id="B_ID" type="hidden" name="B_ID" value="0" required> -->
                        @else
                        <!-- ส่วนที่เพิ่ม Company -->
                        <div class="form-group{{ $errors->has('C_ID') ? ' has-error' : '' }}">
                            <label for="C_ID" class="col-md-4 control-label">Company</label>
                            <div class="col-md-6">
                            <?= Form::select('C_ID', 
                            App\client_company::pluck('C_Name','id'),null,['class' => 'form-control','placeholder' => 'Select Company']); ?>
                            </div>
                        </div>
                        <!-- สิ้นสุดส่วนที่เพิ่ม Company  -->  
                        <!-- ส่วนที่เพิ่ม Product -->
                        <div class="form-group{{ $errors->has('P_ID') ? ' has-error' : '' }}">
                            <label for="P_ID" class="col-md-4 control-label">Product</label>
                            <div class="col-md-6">
                            <?= Form::select('P_ID', 
                            App\Product_list::pluck('P_Name','id'),null,['class' => 'form-control','placeholder' => 'Select Product']); ?>
                            </div>
                        </div>
                        <!-- สิ้นสุดส่วนที่เพิ่ม Product  -->                                              
                        @endif
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                         <!-- ส่วนที่ hidden -->
                            <!-- Status -->
                                <input id="Staus" type="hidden" name="Status" value="ADMIN" required>
                            <!-- End Status -->
                            <input id="CreateBy" type="hidden" name="CreateBy" value="{{Auth::user()->id}}" required> 
                        <!-- สิ้นสุดส่วนที่ hidden -->       
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>                   
    @endsection
    @section('script')
        <script src="{{ asset('js/app.js') }}"></script>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script  src="/js/index.js"></script>
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    @endsection