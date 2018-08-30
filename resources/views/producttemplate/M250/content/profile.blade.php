@extends('producttemplate.m250.template.m250layout')

@section('content')
<section class="content">
<div class="content-frame-top">    
        <div class="box box-default">
            @if (count($errors) > 0)
            <div class="alert alert-warning">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
            @endif
   
 
        <div class="box-body" style="margin-top:2%;">
          <div class="row">
          <?= Form::model($profileinfo, array('url'=> 'profiles/'.$profileinfo->id, 'method' => 'PUT','files' => true)) ?>
          {{ csrf_field() }}
            <div class="col-xs-12"  align='center' style="padding-bottom: 15px;" >
                <img src="img/profiles/resize/{{App\User::find(Auth::user()->id)->image}}" class="img-circle" alt="User Image">
            </div>
            <div class="col-xs-6" >
                <div class="form-group" >
                    <?= Form::label('Fname','First Name');?>
                    <?= Form::text('Fname',$profileinfo->Fname,['class' => 'form-control select2','placeholder' => 'First Name' ,'style' => 'width: 100%;' ]);?>
                </div>
            </div>
            <div class="col-xs-6" >
                <div class="form-group" >
                    <?= Form::label('Lname','Last Name');?>
                    <?= Form::text('Lname',$profileinfo->Lname,['class' => 'form-control select2','placeholder' => 'Last Name']);?>
                </div>
            </div>
            <div class="col-xs-6" >
                <div class="form-group" >
                    <?= Form::label('username','UserName');?>
                    <?= Form::text('username',$profileinfo->username,['class' => 'form-control','placeholder' => 'UserName']);?>
                </div>
            </div>
            <div class="col-xs-6" >
                <div class="form-group" >
                    <?= Form::label('Tel','Phone Number');?>
                    <?= Form::text('Tel',$profileinfo->Tel,['class' => 'form-control','placeholder' => 'Phone Number']);?>
                </div>
            </div>
            <div class="col-xs-8" >
                <div class="form-group" >
                    <?= Form::label('email','E-mail');?>
                    <?= Form::text('email',$profileinfo->email,['class' => 'form-control','placeholder' => 'E-mail']);?>
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
                    <a href="/m250changepass" class="btn btn-warning">Change password</a>
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
        <p class="pull-right">
            Please Check your information! Thank {{ $profileinfo->Fname }} {{$profileinfo->Lname  }} 
        </p>
        </div>
      </div>
      </div>
      </div>
</section>
@endsection


