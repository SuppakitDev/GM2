@extends('producttemplate.Z50-GW.template.z50manageuserlayout')
@section('content')
<script type="text/javascript" src="Z50/js/plugins.js"></script>    
<script type="text/javascript" src="Z50/js/actions.js"></script> 
<script type="text/javascript" src="Z50/js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="Z50/js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="Z50/js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="Z50/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
    @if($errors->all())
            <script>
                $(document).ready(function()
                {
                    $("#ADDUSER").modal();
                });
            </script>
    @endif 
    <style>
        @media only screen and (max-width: 900px) 
        {
            #piority-3,#piority-4 
            {
                display:none;
            }
        }

        .avatar 
        {
                vertical-align: middle;
                width: 30px;
                height: 30px;
                border-radius: 50%;
        }

        /*Check box*/
        input[type="checkbox"] + .label-text:before
        {
            content: "\f096";
            font-family: "FontAwesome";
            speak: none;
            font-style: normal;
            font-weight: normal;
            font-variant: normal;
            text-transform: none;
            line-height: 1;
            -webkit-font-smoothing:antialiased;
            width: 1em;
            display: inline-block;
            margin-right: 5px;
        }
    </style>


    <div class="container" style="width:100%;" >
        <div class="row" style="margin-top:2%;" >
            <div class="col-md-12" style="background-color:#45E3AB;padding:2%;border-radius: 10px;">
                <h2  style="color:#FFFFFF;font-size:20px;font-weight: bold;" >User Management    <button type="button" class="btn  btn-lg pull-right" data-toggle="modal" data-target="#ADDUSER" style="background-color:#FFF;border-radius: 25px;color:black;font-weight: bold;" > 
                <span class="glyphicon glyphicon-plus-sign"></span>Add User</button></h2>
            </div>
    <!-- Modal Add User -->
    <div class="modal fade" id="ADDUSER" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add new user</h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}" role="form" >
            {{ csrf_field() }}
        
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
                                </div> 
                                <!-- hiddent -->
                                        <input id="Staus" type="hidden" name="Status" value="USER" required>
                                        <input id="P_ID" type="hidden" name="P_ID" value="2" required>
                                        <input id="C_ID" type="hidden" name="C_ID" value="{{ Auth::user()->C_ID}}" required>
                                        <input id="site" type="hidden" name="site" value="{{ Auth::user()->Site_ID}}" required>
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
                                    <div class="form-group" style="margin-bottom:20px;">
                                        <div class="col-md-12">
                                            <label for="password-confirm">Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>                       
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('SerialItem') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="SerialItem" >Serialno Item</label>
                                            @if ($errors->has('SerialItem'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('SerialItem') }}</strong>
                                            </span>
                                        @endif
                                            <br>

                                            @foreach($SerialNolist as $SerialNolists)
                                            <div class="col-md-3">
                                                <div>
                                                <input id="SerialItem{{$SerialNolists}}" type="checkbox" name="SerialItem[]" 
                                                value="{{$SerialNolists}}">
                                                {{$SerialNolists}}
                                                </input>
                                                </div>
                                                </div>
                                            @endforeach                                           
                                        </div>                                   
                                    </div>                                
                                </div>
                                    <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" style="border-radius: 5px;background-color:#58DC82;" value="Add user">                         
                            </div>  
                        </section>
        </form>   
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" style="border-radius: 5px;" data-dismiss="modal">Close</button>
            </div>
        </div>  
        </div>
    </div>
    <table class="table table-dark" style="color:#FFF;background-color:#000000;border-radius: 25px;table-layout: fixed; width: 100%" >
    <thead style="background-color:#000000;" >
        <tr style="background-color:#000000;">
        <th id="piority-1"  style="font-size:15px;font-weight: bold;color:#FFF;background-color:#000000;width:50px;" scope="col">ID</th>
        <th id="piority-2"  style="font-size:15px;font-weight: bold;color:#FFF;background-color:#000000;" scope="col">FirstName</th>
        <th id="piority-3"  style="font-size:15px;font-weight: bold;color:#FFF;background-color:#000000;" scope="col">LastName</th>
        <th id="piority-4"  style="font-size:15px;font-weight: bold;color:#FFF;background-color:#000000;" scope="col">Create date</th>
        <th id="piority-5"  style="font-size:15px;font-weight: bold;color:#FFF;background-color:#000000;" scope="col">Serial-Item</th>
        <th id="piority-6"  style="font-size:15px;font-weight: bold;color:#FFF;background-color:#000000;" scope="col">Action</th>
        </tr>
    </thead>
    @foreach($userlevel as $userlevels)
    <tbody>
        <tr>
        <th id="piority-1" style="vertical-align: middle;font-size:13px;">{{$userlevels->id}}</th>
        <td id="piority-2" style="vertical-align: middle;font-size:13px;"><img src="/img/profiles/resize/{{$userlevels->image}}"  alt="Avatar" class="avatar" >   {{$userlevels->Fname}}</td>
        <td id="piority-3" style="vertical-align: middle;font-size:13px;" >{{$userlevels->Lname}}</td>
        <td id="piority-4"  style="vertical-align: middle;font-size:13px;">{{$userlevels->created_at}}</td>
        <td id="piority-5"  style="vertical-align: middle;font-size:13px;word-wrap: break-word;">{{$userlevels->SerialNoitem}}</td>
        <td id="piority-6" style="vertical-align: middle;font-size:13px;padding-left:2%;" >
        <a href="" data-toggle="modal" data-target="#EDITUSER{{$userlevels->id}}"  ><img src="/img/tools.png" style="width:25px;" ></a>
        <?= Form::open(array('url' => 'Userz50manage/'.$userlevels->id,'method'=>'DELETE')) ?>
                                <button type="submit"  style="border:none;padding: 0;background: none;color: inherit;"  onclick="return confirm('Are you sure? This will remove this User.')" ><img src="/img/delete.png" style="width:25px;" ></button>
                                {!! Form::close() !!}
        </td>
        </tr>
    </tbody>
    <!-- Modal Edit User -->
    <div class="modal fade" id="EDITUSER{{$userlevels->id}}" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Edit {{$userlevels->Fname}} Profile. </h4>
            </div>
            <div class="modal-body">
            <?= Form::model($userlevels, array('url'=> 'Userz50manage/'.$userlevels->id, 'method' => 'PUT','files' => true)) ?>
                {{ csrf_field() }}
                        <section id="login">
                            <div class="box-body">
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="username" >Username</label>
                                            <input id="username" type="text" class="form-control" name="username" value="{{$userlevels->username}}" required autofocus>
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
                                            <input id="Fname" type="text" class="form-control" name="Fname" value="{{$userlevels->Fname}}" required autofocus>
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
                                            <input id="Lname" type="text" class="form-control" name="Lname" value="{{$userlevels->Lname}}" required autofocus>
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
                                            <input id="email" type="text" class="form-control" name="email" value="{{$userlevels->email}}" required autofocus>
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
                                            <input id="Tel" type="text" class="form-control" name="Tel" value="{{$userlevels->Tel}}" required autofocus>
                                            @if ($errors->has('Tel'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('Tel') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>                                
                                <!-- hiddent -->
                                        <input id="Staus" type="hidden" name="Status" value="USER" required>
                                        <input id="P_ID" type="hidden" name="P_ID" value="2" required>
                                        <input id="C_ID" type="hidden" name="C_ID" value="{{ Auth::user()->C_ID}}" required>
                                        <input id="site" type="hidden" name="site" value="{{ Auth::user()->Site_ID}}" required>
                                        <input id="CreateBy" type="hidden" name="CreateBy" value="{{Auth::user()->id}}" required> 
                                        <!-- <input type="hidden" name="redirecTo" value="/userfilter"/> -->
                                <!-- end hiddent -->
                                <div class="col-md-12">
                                    <div class="form-group{{ $errors->has('SerialItem') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            <label for="SerialItem" >Serialno Item</label>
                                            @if ($errors->has('SerialItem'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('SerialItem') }}</strong>
                                            </span>
                                        @endif
                                            <br>
                                            @foreach($SerialNolist as $SerialNolists)
                                            <div class="col-md-3">
                                                <div>
                                                <input id="SerialItem{{$userlevels->id}}{{$SerialNolists}}" type="checkbox" name="SerialItemedit[]" 
                                                value="{{$SerialNolists}}">
                                                {{$SerialNolists}}
                                                </input>
                                                </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>                                
                                </div>                              
                                    <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" style="border-radius: 5px;background-color:#58DC82;" value="Update user">                         
                            </div>  
                        </section>                       
                        {!! Form::close() !!}  
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" style="border-radius: 5px;" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php
            $SerialNoItem = [];
            $SerialNoItem = explode(",",$userlevels->SerialNoitem);
                                            
        ?>
             @foreach($SerialNoItem as $SerialNoItems )
                @foreach($SerialNolist as $SerialNolists)
                    @if($SerialNoItems == $SerialNolists)
                        <script>
                            document.getElementById("SerialItem{{$userlevels->id}}{{$SerialNolists}}").checked = true;
                            // document.getElementById("SerialItem{{$userlevels->id}}{{$SerialNoItems}}").value = "{{$SerialNolists}}";  
                        </script>
                    @endif
                @endforeach
            @endforeach                             
        </div>
    </div>
    @endforeach
    </table>   
    </div>
    </div>
@endsection
        <script>
        function showPassword() {
            
            var key_attr = $('#password-confirm').attr('type');
            
            if(key_attr != 'text') {
                
                $('.checkbox').addClass('show');
                $('#password-confirm').attr('type', 'text');
                
            } else {
                
                $('.checkbox').removeClass('show');
                $('#password-confirm').attr('type', 'password');
                
            }

            var key_attr = $('#password').attr('type');
            
            if(key_attr != 'text') {
                
                $('.checkbox').addClass('show');
                $('#password').attr('type', 'text');
                
            } else {
                
                $('.checkbox').removeClass('show');
                $('#password').attr('type', 'password');
                
            }
            
        }
        </script>
        <script>
        setInterval(function () {
            // Console.log("Operated in UpdateSumFunction");

            $.ajax(
                    {
                        url: '/Updatesumofdata',
                        type: 'GET',   
                    }).done( 
                        );

        }, 120000); 
        </script>

        <script>

        $(document).ready(function() {
            // Console.log("Operated in UpdateSumFunction");

            $.ajax(
                    {
                        url: '/Updatesumofdata',
                        type: 'GET',   
                    }).done( 
                        );

        });
            
        </script>
        @include('Alerts::alerts')