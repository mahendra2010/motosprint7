@extends('admin.common.admin_header_sidebar')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                @if($product->user_data->profile_pic)
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/')}}/public/images/{{ @$product->user_data->id }}/{{ @$product->user_data->profile_pic}}" alt="User profile picture">
                    @else
                    <img class="profile-user-img img-responsive img-circle" src="{{ url('/')}}/public/images/default_images/default_user.png" alt="User profile picture">
                @endif
              

              <h3 class="profile-username text-center"> {{ @$product->user_data->name }}</h3>

              <p class="text-muted text-center">Uploaded this Motorcycle</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>User ID: </b> <a class="pull-right">{{ @$product->user_data->id }}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{ @$product->user_data->email }}</a>
                </li>
                
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Seller</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-body box-profile">
                     <h4 class="profile-username" >{{ @$product->bike_name}} , {{ @$product->brand->brand_name}} , {{ @$product->model->model_name}} </h4>
                </div>
            </div>
          <div class="nav-tabs-custom">
              
              
              
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
              <li><a href="#timeline" data-toggle="tab">Documentation</a></li>
              <li><a href="#settings" data-toggle="tab">MotorCycle Details</a></li>
              <li><a href="#previous_owners" data-toggle="tab"> Previous Owners</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                   <!-- Post -->
                <div class="post">
                  <div class="user-block">
                
                        <span class="username">
                          <a href="#">Motor Cycle Images</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Last Updated at {{ date('l jS \of F Y h:i:s A', strtotime(@$product->updated_at) )	 }} </span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                        @if(!empty($product->bike_imgs))
                            <img class="img-responsive" src="{{ url('/')}}/public/images/{{ @$product->user_data->id }}/{{ @$product->id }}/{{ @$product->bike_imgs }}" alt="Photo">
                            @else
                            <img class="img-responsive" src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="Photo">
                        @endif
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="{{ url('/')}}/public/backend/dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="{{ url('/')}}/public/backend/dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="{{ url('/')}}/public/backend/dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="{{ url('/')}}/public/backend/dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  
                </div>
                <!-- /.post -->
                <!-- Post -->
                <div class="post">
                 <!-- <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{ url('/')}}/public/backend/dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>-->
                  <!-- /.user-block -->
                  <p>
                  More Description of Bike 
                  </p>
                  

                </div>
                <!-- /.post -->

                

               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                
                <ul class="timeline timeline-inverse">
                 
                @if(count($documentation) > 0)
                   @foreach($documentation as $doc)
                 
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->

                      <h3 class="timeline-header">{{ $doc['list_name'] }}</h3>
                      
                        @if(count($doc['media_files']) > 0)
                            @foreach($doc['media_files'] as $media)
                              <div class="timeline-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="{{ url('/')}}/public/images/{{$media->user_id}}/{{ $media->product_id }}/{{$media->file}}" width="100%" class="img-thumbnail img-responsive">
                                    </div>
                                    <div class="col-sm-8">
                                        <h4 class="timeline-header">{{ $media->title }}</h4>
                                        <p>{{ $media->description }}</p>
                                    </div>
                                </div>
                              </div>
                              <div class="timeline-footer">
                                <a href="{{ url('/')}}/public/images/{{$media->user_id}}/{{ $media->product_id }}/{{$media->file}}" download class="btn btn-primary btn-xs">Download</a>
                                <!--<a class="btn btn-danger btn-xs">Delete</a>-->
                              </div>
                             <!-- <hr/>-->
                      @endforeach
                        @else
                            <div class="timeline-body">
                               <h>No {{ $doc['list_name'] }} Documents uploaded by Seller. </h5> 
                            </div>
                        
                      @endif
                      
                    </div>
                  </li>
                  
                   @endforeach   
                        @endif
                  
                <!--  <li class="time-label">
                        <span class="bg-red">
                          10 Feb. 2014
                        </span>
                  </li>
                  
                  <li>
                    <i class="fa fa-envelope bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                      <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                      <div class="timeline-body">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                        quora plaxo ideeli hulu weebly balihoo...
                      </div>
                      <div class="timeline-footer">
                        <a class="btn btn-primary btn-xs">Read more</a>
                        <a class="btn btn-danger btn-xs">Delete</a>
                      </div>
                    </div>
                  </li> -->
                  
                
                  <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                  </li>
                </ul>
                
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <table class="table table-striped">
                    <tr>
                        <td width="30%">Name  : </td>
                        <td> {{ @$product->bike_name }}</td>
                    </tr>
                    <tr>
                        <td>  Category Name  : </td>
                        <td> {{ @$product->category->category_name }}</td>
                    </tr>
                    <tr>
                        <td>Brand Name  : </td>
                        <td> {{ @$product->brand->brand_name }}</td>
                    </tr>
                    <tr>
                        <td>Model Name  : </td>
                        <td> {{ @$product->model->model_name }}</td>
                    </tr>
                    <tr>
                        <td>Year  : </td>
                        <td> {{ @$product->year }}</td>
                    </tr>
                    <tr>
                        <td>CC  : </td>
                        <td> {{ @$product->cc_data->cc_name }}</td>
                    </tr>
                    <tr>
                        <td>CV Original  : </td>
                        <td> {{ @$product->cv_original_data->cv_original_name }} ,{{ @$product->other_cv_original}}</td>
                    </tr>
                    <tr>
                        <td>Current CV  : </td>
                        <td> {{ @$product->current_cv }} </td>
                    </tr>
                    <tr>
                        <td>Frame No.  : </td>
                        <td> {{ @$product->frame_no }} </td>
                    </tr>
                    <tr>
                        <td>Plate No. : </td>
                        <td> {{ @$product->plate_no }} </td>
                    </tr>
                    <tr>
                        <td>Country  : </td>
                        <td> {{ @$product->country_data->country_name }} </td>
                    </tr>
                    <tr>
                        <td>State  : </td>
                        <td> {{ @$product->state_data->state_name }} </td>
                    </tr>
                    <tr>
                        <td>City  : </td>
                        <td> {{ @$product->city }} </td>
                    </tr>
                    <tr>
                        <td>Selling Price  : </td>
                        <td> {{ @$product->currency_code }}  {{ @$product->selling_price }}  </td>
                    </tr>
                    
                    
                    
                </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="previous_owners">
                <table class="table table-striped">
                    <tr>
                        <th width="30%">Owner Name  : </th>
                        <th> Registration Date</th>
                    </tr>
                    @if(count($previous_owner) > 0)
                        @foreach($previous_owner as $owner)
    			          <tr>
                            <td>  {{ @$owner->owner_name }}  : </td>
                            <td> {{ @$owner->registration_date }}</td>
                        </tr>
    			        @endforeach
    			        @else
    			        <tr>
    			            <td colspan="2"> No previous Owner</td>
    			        </tr>
			        @endif
                   
                    
                    
                    
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