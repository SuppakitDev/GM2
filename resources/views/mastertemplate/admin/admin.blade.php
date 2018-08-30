@extends('mastertemplate.admin.adminlayout')
  @section('content')
  <div class="">
              <div class="page-title">
                <div class="title_left">
                  <h3> {{ $userdatap->Fname }} <small>Admin</small> </h3>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="row">
                <div class="col-md-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>All PRODUCT <small> R&D center thai-tabuchi electric </small></h2>
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
                    <div class="x_content">
                      <div class="row">
                        <p>Product in R&D center Thai-Tabuchi Electric</p>
                    @foreach($productdata as $product)
                    @if($loop->index)
                        <div class="col-md-55">
                          <div class="thumbnail">
                            <div class="image view view-first">
                              <img style="width: 100%; display: block;" src="img/imgproduct/resize/{{$product->P_Img }}" alt="image" />
                              <div class="mask">
                                <p>{{ $product->P_Name }}</p>
                                <div class="tools tools-bottom">
                                  <!-- ต้องแก้ไปใช้ foreach -->         
                                  <a href="admingoto{{ $product->P_Name }}"><i class="fa fa-link"></i></a>                                
                                </div>
                              </div>
                            </div>
                            <div class="caption" style="text-align:center;" >
                              <p>{{ $product->P_Name }}</p>
                            </div>
                          </div>
                        </div>
                        @endif
                    @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  @endsection