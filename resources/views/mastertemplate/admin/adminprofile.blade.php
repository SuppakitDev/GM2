@extends('mastertemplate.admin.adminlayout')
    @section('content')
    <div class="clearfix"></div>
                <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                    <div class="x_title">
                        <h2><span class="fa fa-home"></span> {{ $userdatap->username }} Profiles</h2>
                        <div class="clearfix"></div>
                    </div>
                @if (count($errors) > 0)
                <div class="alert alert-warning">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @endif
            <div class="box-body">
                <div class="row">
                <?= Form::model($userdatap, array('url'=> 'adminprofile/'.$userdatap->id, 'method' => 'PUT','files' => true)) ?>
                {{ csrf_field() }}
                <div class="col-xs-12"  align='center' style="padding-bottom: 15px;" >
                    <img src="img/profiles/resize/{{App\User::find(Auth::user()->id)->image}}" class="img-circle" alt="User Image">
                </div>
                <div class="col-xs-6" >
                    <div class="form-group" >
                        <?= Form::label('Fname','First Name');?>
                        <?= Form::text('Fname',$userdatap->Fname,['class' => 'form-control select2','placeholder' => 'First Name' ,'style' => 'width: 100%;' ]);?>
                    </div>
                </div>
                <div class="col-xs-6" >
                    <div class="form-group" >
                        <?= Form::label('Lname','Last Name');?>
                        <?= Form::text('Lname',$userdatap->Lname,['class' => 'form-control select2','placeholder' => 'Last Name']);?>
                    </div>
                </div>
                <div class="col-xs-6" >
                    <div class="form-group" >
                        <?= Form::label('username','UserName');?>
                        <?= Form::text('username',$userdatap->username,['class' => 'form-control','placeholder' => 'UserName']);?>
                    </div>
                </div>
                <div class="col-xs-6" >
                    <div class="form-group" >
                        <?= Form::label('Tel','Phone Number');?>
                        <?= Form::text('Tel',$userdatap->Tel,['class' => 'form-control','placeholder' => 'Phone Number']);?>
                    </div>
                </div>
                <div class="col-xs-8" >
                    <div class="form-group" >
                        <?= Form::label('email','E-mail');?>
                        <?= Form::text('email',$userdatap->email,['class' => 'form-control','placeholder' => 'E-mail']);?>
                    </div>
                </div>
                <div class="col-xs-6" >
                    <div class="form-group" >
                        <?= Form::label('image','Profile Image');?>
                        <?= Form::file('image');?>
                    </div>
                </div >
                <div class="col-xs-4" style="margin-left:4%">
                    <div class="form-group" >
                        <?= Form::label('','Change password');?><br>
                        <a href="adminchangepass" class="btn btn-warning">Change password</a>
                    </div>
                </div>
                <div class="col-xs-6" >
                    <div class="form-group" >
                        <?= Form::submit('Save',['class' => 'btn btn-success']);?>
                        <a href="userfilter" class="btn btn-danger">Cancle</a> 
                    </div>
                </div>
                    {!! Form::close() !!}
            </div>
            <div class="box-footer">
                <p>
                    Please Check your information! Thank {{ $userdatap->Fname }} {{$userdatap->Lname  }} 
                </p>
            </div>
    </div>
    @endsection
