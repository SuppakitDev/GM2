@extends('producttemplate.Z50-GW.template.Z50layout')
@section('content')
<link href="https://fonts.googleapis.com/css?family=Chau+Philomene+One|Jua" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Yatra+One" rel="stylesheet">
 <script type="text/javascript" src="Z50/js/plugins.js"></script>        
        <script type="text/javascript" src="Z50/js/actions.js"></script> 
<div style="color:#fff" class="row">
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
        
        <!-- /.box-header -->
        <div class="box-body" style="margin-top:2%;">
          <div class="row">
          <?= Form::model($profileinfo, array('url'=> 'Z50changepass/'.$profileinfo->id, 'method' => 'PUT','files' => true)) ?>
          {{ csrf_field() }}
              <div class="col-md-9">             
                <label for="current-password" class="col-sm-4 control-label">Current Password</label>
                <div class="col-sm-8">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Password">
                  </div>
                </div>
                <label for="password" class="col-sm-4 control-label">New Password</label>
                <div class="col-sm-8">
                  <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                  </div>
                </div>
                <label for="password_confirmation" class="col-sm-4 control-label">Re-enter Password</label>
                <div class="col-sm-8">
                  <div class="form-group">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-enter Password">
                  </div>
                </div>
              </div>
             
              <div class="form-group">
                <div class="col-sm-offset-5 col-sm-6">
                <br>
                <button type="submit" class="btn btn-success">Submit</button>
                  <input class="btn btn-danger" action="action" onclick="window.history.go(-1); return false;" type="button" value="Back" />
                </div>
              </div>
            </form>

                {!! Form::close() !!}
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div style="margin-left:5%;" class="box-footer">
        <br>
        <p class="pull-left">
            Please Check your information! Thank {{ $profileinfo->Fname }} {{$profileinfo->Lname  }} 
        </p>
        </div>
      </div>
      </div>
      <!-- /.box -->
      @if (session()->has('status'))
<script>
swal({
title: "<?php echo session()->get('status'); ?>",
text: "ผลการทํางาน",
timer: 2000,
type: 'success',
showConfirmButton: false
});
</script>
@endif
</div> 

@endsection
