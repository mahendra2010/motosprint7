@extends('admin.common.admin_header_sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                @if(!empty(Auth::guard('admin')->user()->profile_pic))
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/') }}/public/backend/dist/images/{{ Auth::guard('admin')->user()->profile_pic }}" alt="User profile picture">
                    @else
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/') }}/public/backend/dist/images/default_user.png" alt="User profile picture">
                @endif
              

              <h3 class="profile-username text-center">{{ ucfirst(Auth::guard('admin')->user()->name) }}</h3>

              <p class="text-muted text-center">Super Admin</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <center>{{ Auth::guard('admin')->user()->email }}</center>
                </li>
                
              </ul>

              <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-primary btn-block"><b>Change Photo</b></button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
               @if(session('info'))
        					
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               <i class="icon fa fa-check"></i>
                                {{ session('info') }}
                          </div>
                        @elseif(session('error_info'))
                        <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               <i class="icon fa fa-check"></i>
                                	{{ session('error_info') }}
                          </div>
                       
        		@endif
        		
            <ul class="nav nav-tabs">
              
              <li class="active"><a href="#settings" data-toggle="tab">Change Password</a></li>
              <li ><a href="#activity" data-toggle="tab">Activity</a></li>
            </ul>
            
            
            <div class="tab-content">
                <div class=" active tab-pane" id="settings">
                <form class="form-horizontal" action="{{ url('/admin/change_password')}}" method="post">
                  {{ csrf_field() }}
                  <div class="form-group">
                    <label for="inputEmail"  class="col-sm-3 control-label">Current Password</label>

                    <div class="col-sm-9">
                      <input type="password" name="current_password" class="form-control"  id="inputEmail" placeholder="Enter current password" required>
                      {!! $errors->first('current_password', '<span class="help-block text-danger"> :message </span>') !!}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-3 control-label"> New password</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="new_password" id="inputName" placeholder="Enter New Password" required>
                      {!! $errors->first('new_password', '<span class="help-block text-danger"> :message </span>') !!}
                    </div>
                  </div>
                  
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" class="btn btn-danger">Change</button>
                    </div>
                  </div>
                </form>
              </div>
              
              <div class=" tab-pane" id="activity">
                <!-- Post -->
                
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  
                  <!-- /.user-block -->
                  <br><br>
                  <p>
                    Any Other activity here..............
                  </p>
                <br><br>
                  
                </div>
                <!-- /.post -->

                <!-- Post -->
                
                <!-- /.post -->
              </div>
              <!-- /.tab-pane -->
              
              <!-- /.tab-pane -->

              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change  profile photo</h4>
              </div>
              <form method="post" action="{{ url('/admin/change_photo') }}" enctype="multipart/form-data">
              <div class="modal-body">
                
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label> Select Photo</label>
                        <input type="file" name="profile_pic" class="form-control" required>
                    </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save changes">
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


    </section>
    <!-- /.content -->

@endsection
