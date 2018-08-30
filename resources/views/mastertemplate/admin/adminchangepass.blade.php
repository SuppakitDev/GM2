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
              <?= Form::model($userdatap, array('url'=> 'adminchangepass/'.$userdatap->id, 'method' => 'PUT','files' => true)) ?>
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
                    <button type="submit" class="btn btn-success">Submit</button>
                    <input class="btn btn-danger" action="action" onclick="window.history.go(-1); return false;" type="button" value="Back" />
                  </div>
                </div>
              </form>
                  {!! Form::close() !!}
          </div>
          <div class="box-footer">
        </div>
      </div>

  @endsection
