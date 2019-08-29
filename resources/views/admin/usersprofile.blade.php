
@extends('admin.common.admin_header_sidebar')

@section('content')
    

    <section class="content-header">
	<h3 class="box-title"></h3>
      <h1>
	        
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
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
				@if(!empty($userdatail->profile_pic))
				<img class="profile-user-img img-responsive img-circle" src="{{ url('/')}}/public/images/{{$userdatail->id}}/{{$userdatail->profile_pic}}" alt="{{$userdatail->name}}">
				@else
				<img class="profile-user-img img-responsive img-circle" src="{{ url('/')}}/public/images/default_images/default_user.png" alt="{{$userdatail->name}}">
				@endif
              <h3 class="profile-username text-center">{{$userdatail->name}} {{$userdatail->surname1}} </h3>

              <p class="text-muted text-center">{{$userdatail->email}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Nick Name</b>  <a class="pull-right">{{ @$userdatail->nickname}}</a>
                </li>
                
                
              </ul>

              <a href="void:javascript:(0)" class="btn btn-primary btn-block"><b>
            @if($userdatail->user_type==0)
                Buyer
                @else
                    Seller
              @endif
              </b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Listing</a></li>
              <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
              <li><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                 <?php
                 //to check either products exits or not
                    if(!empty(count($products_listing)>0))
                    {
                 ?>
                
                @foreach($products_listing as $product)
                <!-- Post -->
                <div class="post">
                    <!--
                  <div class="user-block">
						@if(!empty($userdatail->profile_pic))
						<img class="profile-user-img img-responsive img-circle" src="{{ url('/')}}/public/images/{{$userdatail->id}}/{{$userdatail->profile_pic}}" alt="{{$userdatail->name}}">
						@else
						<img class="profile-user-img img-responsive img-circle" src="{{ url('/')}}/public/images/default_images/default_user.png" alt="{{$userdatail->name}}">
						@endif
                        <span class="username">
                          <a href="#">{{ $userdatail->name }}</a>
						  
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">{{ $userdatail->user_type }}</span>
                  </div> -->
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-3">
                        @if(!empty($product->bike_imgs))
                            <img class="img-responsive" src="{{ url('/')}}/public/images/{{ $userdatail->id }}/{{$product->id}}/{{ $product->bike_imgs }}" alt="Photo">
                            @else
                            <img class="img-responsive" src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="Photo">
                        @endif
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-sm-12">
							<div class="">							
							<strong>{{ $product->bike_name}}, {{ $product->category->category_name}}</strong>
							<p class="text-muted">
							{{ $product->brand->brand_name}}, {{ $product->model->model_name}}
							</p>
							<p class="text-muted" >CC:{{ $product->cc_data->cc_name}}, CV: {{ $product->cv_original_data->cv_original_name}}</p>
							
						
				
							</div>
							<button type="button" class="btn btn-primary btn-sm  ">Certificate</button> <button type="button" class="btn btn-primary btn-sm  ">Certificate</button>
							
                        </div>
                        
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.post -->
            @endforeach
            
          <?php
             }else{
                   echo '<div class="post">
                            <h3>No Motorcycle uploaded </h3>
                        </div>';  
                        
                }
                    ?>
                
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  
                  <!-- END timeline item -->
                  <!-- timeline item -->
                 
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-comments bg-yellow"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                      <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                      <div class="timeline-body">
                        Take me to your leader!
                        Switzerland is small and neutral!
                        We are more like Germany, ambitious and misunderstood!
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline time label -->
                  
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  
                  <!-- END timeline item -->
                  
                </ul>
              </div>
              <!-- /.tab-pane -->
                
              <div class="tab-pane" id="settings">
                <table class="table table-striped" id="" >
                    <tr>
                        <td style="width: 30%;"> Nickname (Alias) : </td>
                        <td>{{ $userdatail->nickname }}</td>
                    </tr>
                    <tr>
                        <td> Name: </td>
                        <td> {{ $userdatail->name }}</td>
                    </tr>
                    <tr>
                        <td> Surname </td>
                        <td>{{ $userdatail->surname1 }} </td>
                    </tr>
                     <tr>
                        <td> Second Surname </td>
                        <td>{{ $userdatail->surname2 }} </td>
                    </tr>
                    <tr>
                        <td>Email </td>
                        <td> {{ $userdatail->email }} </td>
                    </tr>
                    <tr>
                        <td>Date of Birth </td>
                        <td> {{ $userdatail->date_of_birth }} </td>
                    </tr>
                    <tr>
                        <td> DNI</td>
                        <td> {{ $userdatail->dni }}</td>
                    </tr>
                    
                    <tr>
                        <td> DNI Expiry Date</td>
                        <td>{{ $userdatail->dni_expiry_date }} </td>
                    </tr>
                    
                    <tr>
                        <td> Date of Birth </td>
                        <td>{{ $userdatail->date_of_birth }} </td>
                    </tr>
                    <tr>
                        <td> Motorcycle Licence Typology	 </td>
                        <td>{{ $userdatail->motorcycle_licence_typology	 }} </td>
                    </tr>
                    <tr>
                        <td> Motorcycle Licence Number	 </td>
                        <td>{{ $userdatail->m_licence_no	 }} </td>
                    </tr>
                    
                    <tr>
                        <td> Motorcycle Licence Expiry date	 </td>
                        <td>{{ $userdatail->m_licence_expiry_date	 }} </td>
                    </tr>
                    <tr>
                        <td> Country	 </td>
                        <td>
                           
                         {{ $userdatail->country_data->country_name	 }}
                        </td>
                    </tr>
                    <tr>
                        <td> State	 </td>
                        <td>  {{ $userdatail->state_data->state_name	 }} </td>
                    </tr>
                    <tr>
                        <td> City	 </td>
                        <td>{{ $userdatail->city	 }} </td>
                    </tr>
                     <tr>
                        <td> User Type	 </td>
                        <td>
                         @if($userdatail->user_type=='1')
                            <span class="label label-primary"> Seller</span>
                            @elseif($userdatail->user_type=='0')
                            <span class="label label-warning"> Buyer</span>
                        @endif
                        
                         </td>
                    </tr>
                     <tr>
                        <td> Email Notification	 </td>
                        <td> @if($userdatail->email_notification=='Active')
                                 <span class="label label-success"> {{ $userdatail->email_notification	 }}  </span>
                                     @else
                                      <span class="label label-danger">{{ $userdatail->email_notification	 }} </span>
                            @endif
                        </td>
                    </tr>
                     <tr>
                        <td> 	Status	 </td>
                        <td> @if($userdatail->status==1) 
                                    <span class="label label-success">Active </span>
                                    @else
                                    <span class="label label-danger">Disable </span>
                                @endif
                         </td>
                    </tr>
                    
                     <tr>
                        <td> Created On	 </td>
                        <td> {{ date('l jS \of F Y h:i:s A', strtotime($userdatail->created_at) )	 }} </td>
                    </tr>
                     <tr>
                        <td> Updated On	 </td>
                        <td> {{  date('l jS \of F Y h:i:s A',  strtotime($userdatail->updated_at))	 }} </td>
                    </tr>
                    
                </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
 


  
    
   

@endsection

