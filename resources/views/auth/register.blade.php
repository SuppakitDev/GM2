@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('Username'))
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
                                <input id="Fname" type="text" class="form-control" name="Fname" value="{{ old('Fname') }}" required >

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
                                <input id="Lname" type="text" class="form-control" name="Lname" value="{{ old('Lname') }}" required >

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

                <!-- ส่วนที่เพิ่ม TEL -->
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
                        <!-- สิ้นสุดส่วนที่เพิ่ม TEL  -->
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
                            @if(Auth::user()->Status == 'ADMIN')
                                <input id="Staus" type="hidden" name="Status" value="MANAGER" required>
                            @elseif(Auth::user()->Status == 'MANAGER')
                                <input id="Staus" type="hidden" name="Status" value="USER" required>                                                
                            @else
                                <input id="Staus" type="hidden" name="Status" value="USER" required>                        
                            @endif
                            <!-- End Status -->
                            <input id="CreateBy" type="hidden" name="CreateBy" value="{{Auth::user()->id}}" required> 
                        <!-- สิ้นสุดส่วนที่ hidden -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
