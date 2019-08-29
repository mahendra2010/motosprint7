<?php
use App\Http\Helpers\ApiCommonHelper as myhelper;
use \App\Http\Controllers\UserController;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Motoblockchain </title>
  <!-- end top css/js scripts -->
<link rel="stylesheet" href="{{ url('/')}}/public/css/jquery.magnify.css">
<link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/color.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/flaticon.css') }}" rel="stylesheet">
  @include('common.head')
  <style>
.col-sm-12 .automobile-color{padding: 3px 7px;width: 100%;float: right;padding-top: 10px;border-bottom: 2px solid #dc3545;padding-bottom: 4px;margin-bottom: 20px;font-size: 25px;font-family: fantasy;}
.btn-hover {width: 100px;font-size: 18px;line-height: 0px;height: 36px;}
.nav-pills .nav-link {border: 1px solid #fa6a2f;color: #fa6a2f;margin-bottom: 1px;border-radius: 0;}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {background-color: #fa6a2f;}
.nav-link.active::after{border:0;}
.view_0{border-bottom: 1px solid #cccccca3;background: #28a74512;font-weight: bold;cursor: pointer;font-size: x-small;padding: 18px;}
.view_1{padding: 18px;}
.view_1 a, .view_0 a{display: inherit;}
.spend_group{padding: 0 15px 0px 30px;}
.spend_group label{font-size: 14px;}
#document_add .col-form-label{text-align: right;}

.checkcontainer {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.checkcontainer input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
position: absolute;
    top: 17px;
    left: 5px;
    height: 30px;
    width: 30px;
    background-color: #fa6a2f;
    border: 4px solid #c1b5b5c7;
}

/* On mouse-over, add a grey background color */
.checkcontainer:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.checkcontainer input:checked ~ .checkmark {
  background-color: #fa6a2f;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.checkcontainer input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.checkcontainer .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.automobile-shop-grid figure > span, .automobile-images-thumb-layer span small {
    -webkit-transform: rotate(-33deg);
    -moz-transform: rotate(-33deg);
    -ms-transform: rotate(-33deg);
    -o-transform: rotate(-33deg);
    transform: rotate(-33deg);
}
.automobile-shop-grid figure > span {
color: #ffffff;
    font-size: 15px;
    left: -10px;
    position: absolute;
    text-align: center;
    text-transform: uppercase;
    top: 12px;
    width: 79px;
    z-index: 1;
}
.c_alert{width: 100%;position: relative;display: inline;margin: 0;padding: 9px 12px 12px;}
.c_alert .close{position: initial;top: 0;right: 0;padding: initial;color: inherit;}
  </style>

</head>
<body class="animated fadeIn">
<!-- header start -->
 @include('common.header')
<!-- header close -->

      <div class="automobile-subheader">
            <div class="automobile-subheader-image">
                <span class="automobile-dark-transparent"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <span>Welcome To MotoBlockchain</span>
                            <h1><span>{{ @$user_detail->name }}</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/my-profile')}}">Account</a></li>
                            <li class="automobile-color">My profile</li>
                        </ul>
                    </div>
                </div>
            </div>
      </div>

    <div class="automobile-main-content">

      <!--// Main Section \\-->
      <div class="automobile-main-section">
        <div class="container">
          <div class="row">
            <!--// SideBaar \\-->
            <aside class="col-md-3">
                <!--// Widget account_links \\-->
                <div class="widget widget_account_links">
                    <ul class="nav nav-tabs">
<?php 
$requested_doc = '';
$inrequested_doc = '';
$active= '';
if(!empty($_GET['tab'])){
    $t = $_GET['tab'];
    if($t == 'requested_doc'){
        $requested_doc = 'active';
        $inrequested_doc = 'in active';
    }else{
        $active = 'active';
    }
}else{
    $active = 'active';
}
?>
                        <li class="<?php if(empty($_GET['tab'])){ echo $active; } ?>">
                            <a href="#about-us" data-toggle="tab" >My Profile  <i class="icon-right-arrow"></i></a>
                        </li>
                        @if(@$user_detail->user_type ==1)
                        
                         @if($display==1)
                             <li>
                                <a  data-toggle="modal" data-target="#bike_modal" >Add Motorcycle <i class="icon-right-arrow"></i></a>
                            </li>
                            @else
                            <li>
                                <a href="#add-bike" data-toggle="tab"   >Add Motorcycle <i class="icon-right-arrow"></i></a>
                            </li>
                        @endif
                        <li>
                            <a href="#my-vehicles" data-toggle="tab" >My Motorcycles <i class="icon-right-arrow"></i></a>
                        </li>
                        @endif
                         
                        <li>
                            <a href="#my-orders" data-toggle="tab" >My Orders   <i class="icon-right-arrow"></i></a>
                        </li>
                        <li>
                            <a href="#profile-setting" data-toggle="tab">Profile Settings <i class="icon-right-arrow"></i></a>
                        </li>
                        <li>
                            <a href="#search_bikes" data-toggle="tab" > Search Motorcycles  <i class="icon-right-arrow"></i></a>
                        </li>
                        @if(@$user_detail->user_type ==1)
                        <li class="<?php if((!empty($_GET['tab'])) =='users_contact_u'){ echo 'active'; } ?>">
                            <a href="#users_contact_u" data-toggle="tab" > Users contacted You <i class="icon-right-arrow"></i></a>
                        </li>

                        <li class="{{$requested_doc}}">

                            <a href="#requested_doc" data-toggle="tab">Document Request <i class="icon-right-arrow"></i></a>

                        </li>
                        <li>
                            <a href="#my_doc" data-toggle="tab">My Document <i class="icon-right-arrow"></i></a>
                        </li>
                        @endif
                        <li>
                            <a href="#setting" data-toggle="tab">Setting <i class="icon-right-arrow"></i></a>
                        </li>
                        <li class="logout">
                            <a href="{{ url('/logout') }}">Logout <i class="icon-arrow4"></i></a>
                        </li>
                    </ul>
                </div>
                <!--// Widget account_links \\-->
            </aside>
            <!--// SideBaar \\-->
            <div class="col-md-9">
                <div class="tab-content">
                    <?php 
                        if(!empty($_GET['setting']))
                        {
                            $active_class ='fade';
                        }else{
                            $active_class ='in active';
                        }
                    ?>
                    <div class="tab-pane <?php if(empty($_GET['tab'])){ echo 'active'; } ?>" id="about-us">
                      <div class="row">
                        @if(session('info'))
                        <div class="alert alert-success alert-dismissible fade show row" style="width: 100%;" role="alert">
                        {{ session('info') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @elseif(session('fail_info'))
                        <div class="alert alert-danger alert-dismissible fade show row" style="width: 100%;" role="alert">
                        {{ session('fail_info') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        @endif
                      </div>
                       <div class="basic_info">
                            <div class=" row">
                                <div class="col-sm-12">
                           
                            
                                        <div class="automobile-account-user">
                                            <figure>
                                                <?php
                                                    if(!empty(@$user_detail->profile_pic))
                                                    {
                                                        $user_id = @$user_detail->id;
                                                        $profile_pic = @$user_detail->profile_pic;
                                                       ?>
                                                       
                                                       <img src="<?=asset('/') ?>public/images/<?= $user_id ?>/<?=$profile_pic ?>" alt="">
                                                       <?php
                                                    }else{
                                                     echo '<img src="/public/images/default_images/default_user.png" alt="">';
                                                    }
                                                ?>
                                                
                                               
                                            </figure>
                                            <div class="automobile-account-user-text">
                                                <h5>{{ @$user_detail->name }}</h5>
                                                <p> @if(@$user_detail->user_type==0)
                                                        Buyer
                                                    @else
                                                        Owner
                                                    @endif</p>
                                                <label class="file-uplode">
                                                    <span><i class="icon-photo"></i>Upload</span>
                                                </label>
                                            </div>
                                        </div>
                                </div>
                                <div class="col-sm-12">
                                    <h2 class="automobile-color" style="padding-top:30px">Basic Information</h2>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-4">
                                    <label><span>Name </span><span> {{ @$user_detail->name }} </span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>First Surname </span> <span> {{ @$user_detail->surname1 }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>Second Surname </span><span> {{ @$user_detail->surname2 }}</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label><span>Date of Birth  </span><span> {{ @$user_detail->date_of_birth }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>Alias </span><span> {{ @$user_detail->nickname }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>Email </span><span> {{ @$user_detail->email }}</span></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label><span>Country </span><span> {{ @@$user_detail->country_data->country_name }} </span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>Region </span><span>{{ @@$user_detail->state_data->state_name }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>City </span> <span>{{ @$user_detail->city }}</span></label>
                                </div>
                            </div>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label><span>National ID Number </span><span> {{ @$user_detail->dni }} </span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>National ID Expiry Date </span><span>{{ @$user_detail->dni_expiry_date }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span> National  ID Alarm </span> <span>{{ @$user_detail->alarm_expiry_dni }}</span></label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-4">
                                    <label><span> Liecence Typology </span><span> {{ @$user_detail->motorcycle_licence_typology }}</span> </label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>Other MotorCycle Typology  </span><span>{{ @$user_detail->m_other_licence_typology }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                   
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label><span>Licence Number </span><span> {{ @$user_detail->m_licence_no }} </span></label>
                                </div>
                                <div class="col-sm-4">
                                    <label><span>Liecence Expiry Date </span><span>{{ @$user_detail->m_licence_expiry_date }}</span></label>
                                </div>
                                <div class="col-sm-4">
                                     <label><span>Motorcycle License Alarm </span><span>{{ @$user_detail->alarm_expiry_licence }}</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="my-vehicles">
                        <div class="automobile-account automobile-account-list">
                            <ul class="row">
                                <?php 
                                    //print_r($user_listing );
                                    if(!empty($user_listing)){

                                        $status= '<span>Uncomplete</span>';
                                        $expired_class="automobile-vehicle-expired";
                                        $message='Please complete Your Documentation Process Via App';

                                        foreach($user_listing as $list){
                                            $chk_st = (!empty($list->upload_step_status)) ? $list->upload_step_status : '';

                                            if(strpos($chk_st, ',')){
                                                $cst = explode(',', $chk_st);

                                                if($cst >= 4){
                                                    $status= '<span>Complete</span>';
                                                    $message="";
                                                }
                                            }       
                                            ?>
                                             <li class="col-md-12 <?= $expired_class ?>"> 
                                                <marquee width="100%" class="text-danger">{{ $message }}</marquee> 
                                                <div class="automobile-vehicle-account">
                                                    <figure>
                                                        <?php 
                                                        $v_link ='/view-bike/'.encrypt(@$list->id);
                                                        if(!empty(@$list->bike_imgs)){
                                                            ?>
                                                            <a href="<?php echo $v_link; ?>"><img src="{{ url('/')}}/public/images/<?= @$list->user_id ?>/<?= @$list->id ?>/<?= @$list->bike_imgs ?>" class="img-responsive zoom" alt=""></a>
                                                        <?php
                                                            
                                                        }else{ 
                                                            ?>
                                                            <a href="#"><img src="{{ url('/')}}/public/images/default_images/default_bike.png"  alt=""></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </figure>
                                                    <div class="automobile-vehicle-wrap">
                                                        <div class="automobile-vehicle-account-text">
                                                            <?php 
                                                               echo $status;
                                                               $link ='/edit-bike/'.encrypt(@$list->id);
                                                            ?>
                                                           
                                                            <h5><a href="<?php echo $v_link; ?>"> <?= @$list->bike_name ?>,<small> <?= @$list->category->category_name ?></small></a></h5>
                                                            <p><?= @$list->brand->brand_name ?>, <?= @$list->model->model_name ?></p>
                                                            <time datetime="2008-02-14 20:00">CC : <?= @$list->cc_data->cc_name ?>, CV Original : <?= @$list->cv_original_data->cv_original_name  ?></time>
                                                        </div>
                                                        <ul class="automobile-vehicle-social">
                                                            <li><a href="<?php echo $link; ?>" class="icon-tool6"></a></li>
                                                            <li><a href="JavaScript:void(0);" class="icon-delete" onclick="return removeme(<?php echo '\''.encrypt(@$list->id).'\''; ?>);"></a></li>     
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                        }
                                        
                                    }else{
                                        
                                        echo '<li class="col-md-12"> 
                                             <div class="automobile-vehicle-account">
                                               <h3>No Motercycles Uploaded Yet</h3>
                                             </div>
                                        </li>';
                                    }
                                ?>
                               
                            <!--
                                <li class="col-md-12"> 
                                    <div class="automobile-vehicle-account">
                                        <figure>
                                            <a href="#"><img src="http://webmarce.com/html/accelerator/extra-images/my-vehicles-2.jpg" alt=""></a>
                                        </figure>
                                        <div class="automobile-vehicle-wrap">
                                            <div class="automobile-vehicle-account-text">
                                                <span>Active</span>
                                                <h5><a href="#">2010 BMW 528i xDrive Sedan</a></h5>
                                                <time datetime="2008-02-14 20:00">Expires in 11/07/2016</time>
                                            </div>
                                            <ul class="automobile-vehicle-social">
                                                <li><a href="#" class="icon-tool6"></a></li>
                                                <li><a href="#" class="icon-delete"></a></li>      
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-md-12 automobile-vehicle-expired"> 
                                    <div class="automobile-vehicle-account">
                                        <figure>
                                            <a href="#"><img src="http://webmarce.com/html/accelerator/extra-images/my-vehicles-4.jpg" alt=""></a>
                                        </figure>
                                        <div class="automobile-vehicle-wrap">
                                            <div class="automobile-vehicle-account-text">
                                                <span>Expired</span>
                                                <h5><a href="#">2015 Toyota Prius C One</a></h5>
                                                <time datetime="2008-02-14 20:00">Expired in 6/05/2016</time>
                                            </div>
                                            <ul class="automobile-vehicle-social">
                                                <li><a href="#" class="icon-tool6"></a></li>
                                                <li><a href="#" class="icon-delete"></a></li>      
                                            </ul>
                                        </div>
                                    </div>
                                </li>-->
                            </ul>
                        </div>
                    </div>
                    
                    
                    <div class="tab-pane fade" id="my-orders">
                        <div class="col-sm-12">
                                    <h2 class="automobile-color" style="padding-top:30px">My Orders</h2>
                        </div>
                        MY ORDER PAGE
                        <!--
                        <div class="automobile-account">
                            <h2 class="text-center">Thanks for your order</h2>
                            <div class="block-center">
                                <p>You'll receive an email when your items are shipped. If you have any questions, Call us 1-800-1234-5678.</p>
                                <input type="submit" style="line-height: inherit; font-size: 17px;" class="btn-hover color-4" value="View order status">
                            </div>
                            <div class="container" style="padding-bottom: 20px;">
                                <div class="row">
                                     <div class="col-sm-6">
                                         <strong>SUMMARY:</strong>
                                         <br />
                                         Order #:   945645546<br />
                                        Order Date: Oct 21, 2017<br />
                                        Order Total:    $80.67
                                     </div>
                                     <div class="col-sm-6">
                                         <strong>SHIPPING ADDRESS:</strong>
                                         <br />
                                         Andry Petrin<br />
                                        78 Somewhere St<br />
                                        Somewhere, Canada 99743
                                     </div>
                                </div>
                            </div>

                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col"></th>
                                  <th scope="col">Name</th>
                                  <th scope="col">QTY</th>
                                  <th scope="col">PRICE</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <th scope="row">1</th>
                                  <td><a href="#"><img src="http://webmarce.com/html/accelerator/extra-images/my-vehicles-1.jpg" alt=""></a></td>
                                  <td>2016 Aston Martin V8 Vantage Coupe</td>
                                  <td>1</td>
                                  <td>$10</td>
                                </tr>
                                <tr>
                                  <th scope="row">2</th>
                                  <td><a href="#"><img src="http://webmarce.com/html/accelerator/extra-images/my-vehicles-3.jpg" alt=""></a></td>
                                  <td>2016 Aston Martin V8 Vantage Coupe</td>
                                  <td>3</td>
                                  <td>$100</td>
                                </tr>
                                <tr>
                                  <th scope="row">3</th>
                                  <td><a href="#"><img src="http://webmarce.com/html/accelerator/extra-images/my-vehicles-4.jpg" alt=""></a></td>
                                  <td>2016 Aston Martin V8 Vantage Coupe</td>
                                  <td>2</td>
                                  <td>$1000</td>
                                </tr>
                              </tbody>
                            </table>
                            <table style="width: 500px;" class="table borderless" align="right">
                                    <tr>
                                        <td class="no-border">Subtotal (3 items):</td>
                                        <td class="no-border">$40.57</td>
                                    </tr>
                                    <tr>
                                        <td class="no-border">Flat-rate Shipping:</td>
                                        <td class="no-border"><strong>FREE</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="no-border">Discount:</td>
                                        <td class="no-border">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="no-border"><strong>Order Total:</strong></td><td class="no-border"><strong>$40.57</strong></td>
                                    </tr>
                            </table>
                        </div>
                        -->
                        
                        
                    </div>
                    <div class="tab-pane fade" id="profile-setting">
                        
                <form method="post" action="{{ url('/update_user_profile') }}" enctype="multipart/form-data" autocomplete="off" class="was-validated">
                    {{ csrf_field() }}
                    <div class="row">
                            <div class="automobile-account-user">
                                            <figure>
                                                <?php
                                                    if(!empty(@$user_detail->profile_pic))
                                                    {
                                                        $user_id    =   @$user_detail->id;
                                                        $profile_pic    =   @$user_detail->profile_pic;
                                                       ?>
                                                       
                                                       <img src="{{ url('/')}}/public/images/<?= $user_id ?>/<?=$profile_pic ?>" id="profile_pic_preview" alt="">
                                                       <?php
                                                    }else{
                                                        ?>
                                                     <img src="{{ url('/')}}/public/images/default_images/default_user.png" id="profile_pic_preview" alt="">
                                                     <?php
                                                    }
                                                ?>
                                            </figure>
                                            <div class="automobile-account-user-text">
                                                <h5>{{ @$user_detail->name }}</h5>
                                                <p> @if($user_detail->user_type==1)
                                                        Owner
                                                        @else
                                                            Buyer
                                                    @endif
                                               </p>
                                                <label class="file-uplode" style="color:#000; display:none">
                                                    <input type="file" name="profile_pic" id="profile_pic">
                                                    <span><i class="icon-photo" style="color:#000"></i>Upload</span>
                                              </label>
                                     </div>
                             </div>
                        </div>
                        <div class="row">
                            <div class="automobile-section-heading">
                                            <h2 class="automobile-color">Basic Information</h2>
                          </div>
                        </div>
                    <div class="row">
    			    <div class="form-group col-md-4">
    			      <label for="exampleInputEmail1">Name</label> 
    			      <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" minlenght="3" value="{{ @$user_detail->name }}" readonly required>
    			      
    			      
    			    </div>
    			   
    				    <div class="form-group col-md-4">
    				      <label for="surname1"> First Surname </label>
    				      <input type="text" name="surname1" class="form-control" id="surname1" placeholder="Enter First Surname" minlength="3" value="{{ @$user_detail->surname1 }}" readonly required> 
    				      
    				      
    				    </div>
    				    <div class="form-group col-md-4">
    				      <label for="surname2">Second Surname</label> 
    				      <input type="text" name="surname2" class="form-control" id="surname2" placeholder="Second Surname" value="{{ @$user_detail->surname2 }}" readonly >
    				    </div>
    				 </div>
                        
                        
                        <div class="row">
    			        <div class="col-sm-4">
        			        <label for="date_of_birth">Date of Birth </label>
        			      <input type="text" name="date_of_birth" class="form-control" id="date_of_birth"  value="{{ @$user_detail->date_of_birth }}"  placeholder="dd/mm/yyyy" onkeyup="date_validate(this.id)"  readonly required>
        			     
        			    </div>
    			        <div class="form-group col-md-4">
        			      <label for="nickname">Alias </label> 
        			      <input type="text" name="nickname" class="form-control" id="nickname"  placeholder="Enter NickName " value="{{ @$user_detail->nickname }}" readonly>
        			      
        			    </div>
        			    <div class="col-sm-4">
        			       
        			    </div>
    			    
			    </div>
			    <div class="row">
                  <div class="form-group col-md-4">
                      <label for="country">Country</label>
                      <select class="form-control" name="country" id="country" required disabled>
                         
                            <option value="{{ @$user_detail->country }}">{{ @$user_detail->country_data->country_name }} </option>
                           @foreach($country as $key => $cnt)
    		                  <option value="{{ $key }}"> {{ $cnt }}</option>
    		                @endforeach
                          </select>
                         
                  </div>
                  <div class="form-group col-md-4">
                    <label for="region">Region</label>
                    
                    <select class="form-control" name="region" id="region" required  disabled>
                            <option value="{{ @$user_detail->region }}"> {{ @$user_detail->state_data->state_name }}</option>
                     </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control"  placeholder="Enter City" value="{{ @$user_detail->city }}"  readonly>
                </div>
              </div>
			    
				<div class="row">   
			    <div class="form-group col-md-4">
			      <label for="dni">National ID Number</label> 
			      <input type="text" name="dni" class="form-control" id="dni" minlength="14"  placeholder="Enter national id number" value="{{ @$user_detail->dni }}" required readonly>
			    </div>
			    <div class="form-group col-md-4">
			      <label for="dni_expiry_date">National ID Expiry Date </label>
			     
			      <input type="text" name="dni_expiry_date" class="form-control" id="dni_expiry_date"  value="{{ @$user_detail->dni_expiry_date }}"  placeholder="dd/mm/yyyy" onkeyup="date_validate(this.id)"  required  >
			      
			    </div>
			    <div class="form-group col-md-4">
			     
			      <div class="row">
			      </div>
			     
			    </div>
			    
			 
			   </div>
			    
			    <div class="row">
			        <div class="form-group col-md-4">
    			        <label for="motorcycle_licence_typology">Motorcycle Licence:Typology</label>
                         <select class="form-control" name="motorcycle_licence_typology" onchange="licent_toplogy(this.value)" id="motorcycle_licence_typology" required disabled>
                            <option value="{{ @$user_detail->motorcycle_licence_typology }}"> {{ @$user_detail->motorcycle_licence_typology }} </option>
                           <option value="A"> A </option>
                           <option value="A1"> A1 </option>
                           <option value="AM"> AM </option>
                           <option value="M1"> M1 </option>
                           <option value="M2"> M2 </option>
                           <option value="other"> Other </option>
                          <option value="no licence"> No license </option>
                          </select>
                          
    			    </div>
    			    <?php
    			        if(@$user_detail->motorcycle_licence_typology=='other')
    			        {
    			            $display='block';
    			        }else{
    			            $display='none';
    			        }
    			    ?>
    			    <div class="form-group col-md-4"  style="display:<?= $display ?>" id="other_licence_div">
    			        <label>Other</label>
    			        <input type="text" name="m_other_licence_typology" id="m_other_licence_typology" value="{{ @$user_detail->m_other_licence_typology }}" class="form-control" placeholder="Enter other licence toplogy" readonly>
    			    </div>
    			    <div class="form-group col-md-4">
    			        
    			    </div>
    			    
			        
			    </div>
			    <div class="row" id="licence_detail_div" style="">
                    <div class="form-group col-md-4">
    			        <label for="m_licence_no">Motorcycle Licence Number</label>
                        <input type="text" name="m_licence_no" class="form-control" id="m_licence_no" placeholder="Enter Motorcycle licence number" value="{{ @$user_detail->m_licence_no }}" readonly >
                        
                          
    			    </div>	
    			    <div class="form-group col-md-4">
    			         <label for="m_licence_expiry_date"> Licence Expiry Date </label>
    			      <input type="text" name="m_licence_expiry_date" class="form-control" id="m_licence_expiry_date"  value="{{ @$user_detail->m_licence_expiry_date }}" placeholder="dd/mm/yyyy" onkeyup="date_validate(this.id)"  >
    			      
    			    </div>
    			    <div class="form-group col-md-4">
    			        
    			    </div>
    			    
			    </div>
                        
                        <div class="row">
                            <input type="submit" style="line-height: inherit;" class="btn-hover color-4" value="Update">
                        </div>
                        
                     </form>   
                        
                    </div>
                    
                   
                    
                    <div class="tab-pane fade" id="search_bikes">
                        <div class="automobile-account automobile-favorite-list">
                            <ul class="row">
                                <div class="col-sm-12">
                                    <h2 class="automobile-color" style="padding-top:20px">Search Save Results</h2>
                                </div>
                                <div class="col-sm-12" id="search_bike_remove_status">
                                  </div>
                                @if(count($search_bikes)>0)
                                    @foreach($search_bikes as $search_bike)
                                            <li class="col-sm-12" id="search_div_{{ @$search_bike->search_bike_id }}">
                                               <div class="automobile-favorite-list-wrap alert">
                                                        @if(!empty($search_bike->search_bike_data->bike_imgs))
                                                            <figure><a href="{{ url('/')}}/product/{{ $search_bike->product_id}}"><img src="{{url('/')}}/public/images/{{ $search_bike->user_id}}/{{$search_bike->product_id}}/$search_bike->search_bike_data->bike_imgs" alt=""></a></figure>
                                                            @else
                                                            <figure><a href="{{ url('/')}}/product/{{ $search_bike->product_id}}"><img src="{{url('/')}}/public/images/default_images/default_bike.png" alt=""></a></figure>
                                                        @endif
                                                        
                                                        <div class="automobile-favorite-list-text">
                                                            <h5><a href="{{ url('/')}}/product/{{ $search_bike->product_id}}">{{ @$search_bike->bike_name }}, {{ @$search_bike->brand_name }},{{ @$search_bike->model_name }},{{ @$search_bike->year }} </a></h5>
                                                            <ul>
                                                                @if(!empty($search_bike->selling_price))
                                                                <li>{{ $search_bike->currency_code }} {{  $search_bike->selling_price }}</li>
                                                                @endif
                                                                
                                                                <li>{{ @$search_bike->cc_name }}</li>
                                                            </ul>
                                                            <span><strong>Mileage:</strong> {{ @$search_bike->c_mileage }} {{ @$search_bike->c_mileage_type }} </span>
                                                            <button type="button" id="{{ @$search_bike->search_bike_id }}" class="close" onclick="remove_search_bike(this.id)">
                                                                <span aria-hidden="true"><i class="fa fa-times"></i>Remove</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                           </li>
                                        
                                        @endforeach
                                    @else
                                        <li class="col-sm-12">
                                               <div class="automobile-favorite-list-wrap alert">
                                                   <h3>No Search Motorcycles</h3>
                                                </div>
                                        </li>
                                @endif
                                
                            </ul>
                        </div>
                    </div>                    
                    <?php 
                        if(!empty($_GET['setting']))
                        {
                            $active_class ='in active';
                        }else{
                            $active_class ='fade';
                        }
                    ?>
                    @if(@$user_detail->user_type ==1)
                    <div class="tab-pane  {{($inrequested_doc)? $inrequested_doc : $active_class}}" id="requested_doc">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px"> Document Request Approval:</h2>
                            </div>
                        </div>
                        <?php $dc = 0; ?>
                        @foreach($reqs_medias as $req)
                        <div class="row view_{{$req->view}}" data-id="{{$req->req_id}}" style="border-bottom: 1px solid #cccccca3;position: relative;">
                          @if($req->view == 0)
                          <div class="automobile-shop-grid">
                            <figure><span>New</span></figure>
                          </div>
                          @endif
                            <div class="col-lg-5 px-0 align-items-center d-flex">
                                <div class="user_detail">
                                    <div class="row">
                                        <?php $profile = myhelper::get_user_profile($req->user_id); ?>
                                        <div class="col-lg-2 px-0">
                                            @if(!empty($profile->profile_pic))
                                            <img class="img-fluid rounded-circle" src="{{ url('/')}}/public/images/{{$req->user_id}}/{{$profile->profile_pic}}" />
                                            @else
                                            <img class="img-fluid rounded-circle" src="{{url('/')}}/public/images/default_images/default_user.png" />
                                            @endif
                                        </div>
                                        <div class="col-lg-10 pr-0">
                                            <div class="col-lg-12 pl-0">{{ @$profile->name}}</div>
                                            <em>(<a href="mailto:{{@$profile->email}}">{{ @$profile->email}}</a>)</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 pr-0 align-items-center d-flex">
                              @if($req->privacy == 0) 
                               <p> ...has Contacted you regarding this document, please reply him. </p>
                              @else
                              <!-- @if($req->type == 'doc_title') {{'title'}} @endif -->
                                <p> ...has requested access to the private  document. </p>
                              @endif  
                            </div>
                            <div class="col-lg-2 pt-3 text-center">
                                <button class="btn btn-sm btn-success" style="margin:0px;position: absolute;background: #fa6a2f;border: 0;border-radius: 0;" data-toggle="modal" data-target="#document_{{$dc}}"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                @if(!empty($req->file))
                                <img class="img-fluid rounded" src="{{ url('/')}}/public/images/{{$user_detail->id}}/{{$req->id}}/{{$req->file}}" />
                                @else
                                <img class="img-fluid rounded" src="{{ url('/')}}/public/images/default_images/default_bike.png" />
                                @endif
                                <div class="">{{$req->title}}</div>
                            </div>
                            <div class="col-lg-3 pr-0 align-items-center d-flex">
                                <div class="row-lg-6 px-1">
                                    <button id="req_approv_{{$req->media_id}}" onclick="return request_media_approve(<?php echo $req->media_id; ?>, 1)" class="btn btn-sm btn-success"><span>@if($req->status == 1) {{'Already Approved'}} @else {{'Approve'}} @endif</span></button>
                                </div>
                                <div class="row-lg-6 px-1">
                                    <button id="req_dis_approv_{{$req->media_id}}" onclick="return request_media_approve(<?php echo $req->media_id; ?>, 0)" class="btn btn-sm btn-danger"><span>Disapprove / Cancel</span></button>
                                </div>
                            </div>
                            @if($req->comment)
                            <div class="col-lg-12">
                            <p><strong> Comment :</strong>{{$req->comment}} <a style="float: right;    cursor: pointer;" class="text-info" onclick="return reply_link(<?php echo $req->req_id; ?>)">reply</a></p>
                            <div id="reply_container_{{$req->req_id}}" style="display: none;">
                                <textarea class="col-lg-12" rows="5" id="comment_{{$req->req_id}}">{{$req->answer}}</textarea>
                                 <button class="btn btn-sm btn-success pull-right" 
                                 onclick="return reply_to_user(<?php echo $req->req_id; ?>, <?php echo '\''.@$profile->name.'\''; ?>,<?php echo '\''.@$profile->email.'\''; ?>, <?php echo '\''.$req->comment.'\''; ?>)" style="margin-top: 20px;">Reply</button>
                            </div>
                            </div>
                            @endif
                        </div>
                        <!-- Modal -->
                        <div id="document_{{$dc}}" class="modal fade">
                          <div class="modal-dialog modal-xl">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="position: absolute;">Document Request Edit.</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                    
                                    <div class="col-lg-7">
                                        @if(!empty($req->file))
                                            <img class="img-fluid" src="{{ url('/')}}/public/images/{{$user_detail->id}}/{{$req->id}}/{{$req->file}}" />
                                        @else
                                            <img class="img-fluid" src="{{ url('/')}}/public/images/default_images/default_bike.png" />
                                        @endif
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="col-lg-12" id="msg_{{$dc}}"></div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input id="doc_title_{{$dc}}" type="text" class="form-control" placeholder="Document Title" value="{{$req->title}}">
                                            </div>
                                        </div>

                                        <div class="form-group">  
                                            <div class="col-sm-12">
                                                <textarea id="doc_desc_{{$dc}}" class="form-control" placeholder="Document Title">{{$req->description}}</textarea> 
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="inputAddress2">Document Privacy</label>
                                                <select id="doc_privacy_{{$dc}}" class="form-control" style="width: 50%;">
                                                    <option>Select</option>
                                                    <option value="0" <?php if($req->privacy == 0) echo 'selected'; ?>>public document</option>
                                                    <option value="1" <?php if($req->privacy == 1) echo 'selected'; ?>>public title Only</option>
                                                    <option value="2" <?php if($req->privacy == 2) echo 'selected'; ?>>private document</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input type="hidden" id="doc_id_{{$dc}}" value="{{$req->doc_id}}" />
                                <button type="button" class="btn btn-success edit_doc" id="{{$dc}}">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php $dc++; ?>
                        @endforeach
                    </div>
                    <div class="tab-pane  <?= $active_class ?> " id="my_doc">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px">My Document
<button class="btn btn-default pull-right" style="background: #fa6a2f; color: #fff;" data-toggle="modal" data-target="#document_add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </h2>

                            </div>
                        </div>
                        <div class="row">
                          <div class="col-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link active" data-toggle="pill" href="#all_photo" role="tab" aria-selected="true">All photos</a>
                              <a class="nav-link" data-toggle="pill" href="#all_photo_by_date" role="tab" aria-selected="false">Motorcycle photos by date</a>
                              <a class="nav-link" data-toggle="pill" href="#tuning_components" role="tab" aria-selected="false">Tuning Components</a>
                              <a class="nav-link" data-toggle="pill" href="#motor_accessories" role="tab" aria-selected="false">Motorcycle Accessories</a>
                               <a class="nav-link" data-toggle="pill" href="#replacement" role="tab" aria-selected="false">Replacement</a>
                                <a class="nav-link" data-toggle="pill" href="#invoice_receipt" role="tab" aria-selected="false">Invoice and Receipt</a>
                                <a class="nav-link" data-toggle="pill" href="#documentation" role="tab" aria-selected="false">Documentation</a>
                                <a class="nav-link" data-toggle="pill" href="#mileage" role="tab" aria-selected="false">Mileage</a>
                            </div>
                          </div>
                          <div class="col-9">
                            <div class="tab-content" id="v-pills-tabContent">
                              <div class="tab-pane fade show active" id="all_photo" role="tabpanel" aria-labelledby="all_photo">
                                <?php 
                                $user_id = (@$user_detail->id) ? @$user_detail->id : '';
                                echo UserController::document_tab($user_id); ?>
                              </div>
                              <div class="tab-pane fade" id="all_photo_by_date" role="tabpanel" aria-labelledby="all_photo_by_date">
                                <?php echo UserController::document_tab($user_id,array(4,5,6),'updated_at'); ?>
                              </div>
                              <div class="tab-pane fade" id="tuning_components" role="tabpanel" aria-labelledby="tuning_components"><?php echo UserController::document_tab($user_id,array(8),'updated_at'); ?>
                              </div>
                              <div class="tab-pane fade" id="motor_accessories" role="tabpanel" aria-labelledby="motor_accessories"><?php echo UserController::document_tab($user_id,array(7),'updated_at'); ?>
                              </div>
                              <div class="tab-pane fade" id="replacement" role="tabpanel" aria-labelledby="replacement"><?php echo UserController::document_tab($user_id,array(9),'updated_at'); ?></div>
                              <div class="tab-pane fade" id="invoice_receipt" role="tabpanel" aria-labelledby="invoice_receipt"><?php echo UserController::document_tab($user_id,array(1,2),'updated_at'); ?></div>
                              <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation"><?php echo UserController::document_tab($user_id,array(13),'updated_at'); ?></div>
                              <div class="tab-pane fade" id="mileage" role="tabpanel" aria-labelledby="mileage"><?php echo UserController::document_tab($user_id,array(10),'updated_at'); ?></div>
                            </div>
                          </div>
                        </div>
                    </div>
                    @endif
                    <div class="tab-pane  <?= $active_class ?> " id="setting">
                        <div class=" row ">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px"> Email Subscription:</h2>
                            </div>
                            <div class="col-sm-12" id="set_email_subscription_div">
                                
                            </div>
                            <form method="post" id="set_email_subscription_form" action="{{ url('/set_email_subscription') }}" >
                                 {{ csrf_field() }}
                                <div class="form-group">
                                    <h5>Cancel/Modify email subscription:</h5>
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" name="email_subscription"  value="once_a_week" <?php echo ($user_detail->email_subscription=='once_a_week')?'checked':'' ?> > Once a Week
                                </div>
                                <div class="col-sm-12">
                                     <input type="radio" name="email_subscription" value="once_a_month" <?php echo ($user_detail->email_subscription=='once_a_month')?'checked':'' ?> > Once a Month
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" name="email_subscription" value="no_email" <?php echo ($user_detail->email_subscription=='no_email')?'checked':'' ?>> No email (only account related)
                                </div>
                               
                                 <div class="col-sm-6">
                                    <input type="submit" id="set_email_subscription_btn"  class=" btn-hover pull-right color-4 " value="Save">
                                </div>
                                <div class="col-sm-6">  </div>
                                
                          </form>
                        </div>
                        
                        <div class=" row ">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px"> Email Notify Products</h2>
                                <p>You Will get Email Notification of these products when new products added</p>
                            </div>
                            <div class="col-sm-12" id="notify_product_table">
                                
                            </div>
                            <table class="table table-bordered" >
                                <thead>
                                    <th>Motorcycle</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @if(count($notify_products)>0)
                                        @foreach($notify_products  as $notify_product)
                                        <tr id="product_notify_tr_{{$notify_product->id}}">
                                            <td><a href="{{ url('/')}}/product/{{$notify_product->product_id}}">{{ @$notify_product->search_bike_data->bike_name }}</a></td>
                                            <td><a href="{{ url('/')}}/product/{{$notify_product->product_id}}">{{ myhelper::get_brand_name(@$notify_product->search_bike_data->brand_id) }}</a></td>
                                            <td><a href="{{ url('/')}}/product/{{$notify_product->product_id}}">{{ myhelper::get_model_name(@$notify_product->search_bike_data->model_id) }}</a></td>
                                            <td><a href="javascript:void(0)" id="{{$notify_product->id}}" onclick="delete_notify_product(this.id)"><i class="fa fa-trash-o" style="font-size:22px;color:red"></i></a></td>
                                        </tr>
                                        
                                        @endforeach
                                        @else
                                        
                                        <tr>
                                            <td colspan="4"> No Notify Products Available</td>
                                            
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                        
                        
                        
                        <div class=" row ">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px"> Change Password</h2>
                            </div>
                            <div class="col-sm-12" id="change_password_msg_div">
                            </div>
                        </div>
                       <form method="post" id="change_password_form" action="" class="was-validated">
                           <br/>
                           {{ csrf_field() }}
                           <div class="row">
                               <div class="col-sm-6">
                                   <div class="form-group">
                                       <input type="text" name="old_password" class="form-control" placeholder="Old Password">
                                   </div>
                               </div>
                               <div class="col-sm-6">
                                   <div class="form-group">
                                       <input type="text" name="current_password" class="form-control" placeholder="Current Password">
                                   </div>
                               </div>
                           </div>
                           <div class="row">
                               <div class="col-sm-8">
                                </div>
                                <div class="col-sm-4">
                                    <input type="submit"  class=" btn-hover pull-right color-4 " value="Change">
                                </div>
                            
                        </div>
                       </form>
                       
                       <div class=" row " style="padding-bottom:20px;">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px">Cancel Motorcycle data :</h2>
                            </div>
                            
                         
                               <div class="col-sm-5">
                                  <p>You want to cancel motorcycle data ?</p>
                                </div>
                                <div class="col-sm-7">
                                    <button type="button" data-toggle="modal" data-target="#cancel_motorcycle_modal"  class=" btn-hover  color-4 "  style="margin:0px" value="Cancel">Cancel</button>
                                </div>
                        
                      </div>
                      
                      <div class=" row " style="padding-bottom:20px;">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px">Cancel My  Account :</h2>
                            </div>
                            
                         
                               <div class="col-sm-5">
                                  <p>You want to cancel your Account ?</p>
                                </div>
                                <div class="col-sm-7">
                                    <button type="button" data-toggle="modal" data-target="#cancel_my_account_modal"  class=" btn-hover  color-4 "  style="margin:0px" value="Cancel">Cancel</button>
                                </div>
                        
                      </div>
                    
                </div>

                    <!--Add New Bike-->
                    <div class="tab-pane fade" id="add-bike">
                        
                        <form method="post" action="{{ url('/add-motor-cycle') }}" enctype="multipart/form-data" class="was-validated" autocomplete="off"> 
            			
            				{{ csrf_field() }}
            			  @include('common.add_motorcycle_form') 
            			</form>
                        
                    </div>
                    <!--End of add new bike-->
                    <div class="tab-pane fade <?php if((!empty($_GET['tab'] )) =='users_contact_u'){ echo 'active show'; } ?>" id="users_contact_u">
                      <div class="row">
                        @if(session('info_c'))
                        <div class="alert alert-success alert-dismissible fade show row c_alert" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session('info_c') }}</div>
                        @elseif(session('fail_info_c'))
                        <div class="alert alert-danger alert-dismissible fade show row c_alert" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session('fail_info_c') }}</div>
                        @endif
                      </div>
                         <div class="row">
                            <div class="col-sm-12">
                                <h2 class="automobile-color" style="padding-top:10px">Contact the user request</h2>
                            </div>
                            </div>
                        
                        <div class="comments-area">
                          <!--// coments \\-->
                          <ul class="comment-list">
                              @if(count($contact_seller)>0)
                                @foreach($contact_seller as $contact)
                                    <li style="position: relative;">
                                        <div class="thumb-list">
                                          <div class="automobile-shop-grid">
                                           <figure>
                                            <?php 
                                            $uid = (!empty(@Auth::user()->id))? @Auth::user()->id : 0;
                                            $pid = (!empty($contact->product_id))? $contact->product_id : 0;
                                            $sid = (!empty($contact->sender_id))? $contact->sender_id : 0;
                                            $check_new = myhelper::check_new($pid, $sid, $uid);
                                            ?>
                                            @if($check_new <= 0)
                                            <span>New</span>
                                            @endif
                                            </figure></div>
                                            <figure>
                                               @if(!empty($contact->profile_pic))
                                                 <img alt="" src="{{ url('/')}}/public/images/{{ $contact->userid}}/{{ $contact->profile_pic}}">
                                                 @else
                                                 <img alt="" src="{{url('/')}}/public/images/default_images/default_user.png">
                                                @endif
                                           </figure>
                                           <div class="text-holder">
                                              <a class="comment-reply-link automobile-color"  onclick="reply_user({{$contact->cid}},{{$contact->sender_id}},{{$contact->product_id}})" href="javascript:void(0)">Reply</a>
                                              <h6> {{ $contact->name}} {{ $contact->surname1}}</h6>
                                              <time class="post-date automobile-color" datetime="2008-02-14 20:00">{{ date(' jS \of F Y ', strtotime($contact->create_date) )	 }}</time><br/>
                                              <p><br/>{{ $contact->message}}</p>
                                           </div>
                                        </div>
                                     </li>
                                     
                                @endforeach
                                @else
                                <li>
                                        <div class="thumb-list">
                                            No Users Contacted You..
                                        </div>
                                </li>
                              @endif
                              </ul>
                         
                        </div>
                        
                    </div>
                    
                </div>
            </div>
          </div>
        </div>
      </div>
      <!--// Main Section \\-->
    
      
      <!--Modal for one bike alert-->
      <!-- // document_add -->
        <div id="document_add" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" enctype="multipart/form-data" id="add_document_frm">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="position: absolute;">Add New Document</h4>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                             <div class="col-lg-12" id="add_doc_msg"></div>
                            <div class="col-lg-5">
                                <div class="form-group row">
                                    <label for="add_doc_product" class="col-sm-4 col-form-label">Product</label>
                                    <div class="col-sm-8">
                                        <select id="add_doc_product" name="add_doc_product" class="form-control" required>
                                            <option value="">Select</option>
                                            @foreach($user_listing as $list)
                                            <option value="{{$list->id}}">{{@$list->bike_name}}</option>
                                            @endforeach
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="add_doc_title" class="col-sm-4 col-form-label">Title</label>
                                    <div class="col-sm-8">
                                        <input id="add_doc_title" name="add_doc_title" type="text" class="form-control" placeholder="Document Title" required />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="add_doc_file" class="col-sm-4 col-form-label">Image</label>
                                    <div class="col-sm-8">
                                        <input  style="padding: 0;" name="add_doc_file" id="add_doc_file" type="file" class="form-control" accept="image/*" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group row">
                                    <label for="add_doc_desc" class="col-sm-4 col-form-label">Description</label> 
                                    <div class="col-sm-8">
                                        <textarea id="add_doc_desc" name="add_doc_desc" class="form-control" placeholder="Document Description" required></textarea> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="add_doc_image_category" class="col-sm-4 col-form-label">Image Category</label>
                                    <div class="col-sm-8">
                                        <select id="add_doc_image_category" name="add_doc_image_category" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="6">Photos of Motorcycle</option>
                                            <option value="1">Photos of Mileage</option>
                                            <option value="2">Photos of Frame number</option>
                                            <option value="4">Photos of Plate number</option>
                                            <option value="7">Photos of Motorcycle before</option>
                                            <option value="8">Photos of Motorcycle on working</option>
                                            <option value="9">Photos of Motorcycle after</option>
                                            <option value="10">Photos of Motorcycle accessory</option>
                                            <option value="11">Photos of Tunning component</option>
                                            <option value="12">Photos of Replacement: oil,pads</option>
                                        </select>
                                    </div> 
                                </div>
                                <div class="form-group row">
                                    <label for="add_doc_privacy" class="col-sm-4 col-form-label">Privacy</label>
                                    <div class="col-sm-8">
                                        <select id="add_doc_privacy" name="add_doc_privacy" class="form-control" required>
                                            <option value="">Select</option>
                                            <option value="0">public document</option>
                                            <option value="1">public title Only</option>
                                            <option value="2">private document</option>
                                        </select>
                                    </div> 
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="hidden" name="user_id" value="{{$user_id}}" />
                        <button type="submit" value="save" name="add_document_btn" class="btn btn-success" id="add_document_btn">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
      <!-- // End document_add -->

      <!-- Modal -->
        <div id="bike_modal" class="modal fade" role="dialog">
          <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="position: absolute;"> Important Message</h4>
              </div>
              <div class="modal-body">
                <p>Please Complete  Your First Motercycle  Documentation  Process via App. After completing first Motercycle You are able to add more Motercycles</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      <!--End Modal-->
      
      <!-- Modal -->
        <div id="contact_user_modal" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg" id="chat_content_body">
            <!-- Modal content-->
            
                <!---->
                <!---->
          </div>
        </div>
        
        <!-- Modal -->
        <div id="cancel_motorcycle_modal" class="modal fade" role="dialog">
          <div class="modal-dialog " >
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="display:block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-danger">Important</h4>
              </div>
              <div class="modal-body">
                  
                  <div class="col-sm-12" id="cancel_all_motorcycle_div">
                <p>“Dear {{ @$user_detail->name}}, you are free to cancel your motorcycle from our Database. All documentation and motorcycle data will be cancelled."
                <p>
                "Please contact us at info@motoblockchain.es for more information about Digital Identity transmission”</p> <br/>
           
                Are you sure you want to cancel all motorcycle data? <br/>
                </div>
                
                <div class="row">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-danger btn-sm " data-dismiss="modal"> No </button> 
                            <button id="cancel_all_motorcycle_data" onclick="cancel_motorcycle_data('{{ encrypt($user_detail->id) }}')" class="btn btn-primary btn-sm pull-right"> Yes</button>
                        </div>
                        <div class="col-sm-1"></div>
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
        <!--End modal-->
        
         <!-- Modal -->
        <div id="cancel_my_account_modal" class="modal fade" role="dialog">
          <div class="modal-dialog " >
        
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header" style="display:block;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-danger">Important</h4>
              </div>
              <div class="modal-body">
                  
                  <div class="col-sm-12" id="cancel_all_account_div">
                <p>“Dear {{ @$user_detail->name}}, you are free to cancel your account data, including the motorcycle  from our Database.
                All documentation and motorcycle data will be cancelled."
                <p>
                "Please contact us at info@motoblockchain.es for more information about Digital Identity transmission”</p> <br/>
           
                Are you sure you want to cancel your Account and data? <br/>
                </div>
                
                <div class="row">
                        <div class="col-sm-8"></div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-danger btn-sm " data-dismiss="modal"> No </button> 
                            <button id="cancel_my_acount_data" onclick="cancel_my_acount_data('{{ encrypt($user_detail->id) }}')" class="btn btn-primary btn-sm pull-right"> Yes</button>
                        </div>
                        <div class="col-sm-1"></div>
                    
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
        
          </div>
        </div>
        <!--end modal-->
 <!-- Choose Related Invoice Model box -->
<div id="related_invoice" class="modal fade">
  <div class="modal-dialog modal-xl">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="position: absolute;">Choose related documents</h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
              <form name="related_invoice" id="related_invoice_form">
                <?php echo UserController::document_list_checkbox($user_id,array(1,2,7,8,9),'updated_at'); ?>
              </form>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success save_related_invoice">Save</button>
        <button type="button" class="btn btn-default close_related_invoice" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>     
 <!-- End Choose Related Invoice Model box -->
    </div>
    <div class="clearfix"></div>
<!-- footer start -->
 @include('common.footer')
<!-- footer close -->
<script type="text/javascript" src="{{ url('/')}}/public/js/jquery.magnify.js"></script>
 <script>
     function cancel_motorcycle_data(id){
      //alert(id);
      $.ajax({
              url: "{{url('/')}}/cancel_motorcycle_data", 
              type: 'POST',
              data: {"id": id,  "_token": "{!! csrf_token() !!}"},
              success:function(res){
                  console.log(res);
                //alert(res);
                if(res == 1){
                    $("#cancel_all_motorcycle_div").before('<div class="alert alert-success alert-dismissible">Successfully Cancelled All motorcycle data ... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                  dismiss_message();
                }else {
                    $("#cancel_all_motorcycle_div").before('<div class="alert alert-danger alert-dismissible"> No Motorcycle found on your account ... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                dismiss_message();
                }
             }
        });
        
    }
    
    function cancel_my_acount_data(id)
     {
      //alert(id);
      $.ajax({
              url: "{{url('/')}}/cancel_my_acount_data", 
              type: 'POST',
              data: {"id": id,  "_token": "{!! csrf_token() !!}"},
              success:function(res){
                  console.log(res);
                //alert(res);
                if(res == 1){
                    $("#cancel_all_account_div").before('<div class="alert alert-success alert-dismissible">Successfully Cancelled Your Account ... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                  dismiss_message();
                }else {
                    $("#cancel_all_account_div").before('<div class="alert alert-danger alert-dismissible"> Failed  !! Please try Again ... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                dismiss_message();
                }
             }
        });
        
    }
 //To hide div after 5 sec
     function dismiss_message()
     {
         setTimeout(function() {
            $('.alert-dismissible').fadeOut('fast');
        }, 5000);
     }
     
     //set email preference
     $( "#set_email_subscription_form" ).submit(function( event ) {
         event.preventDefault();
         var form = $(this);
         $.ajax({
              url: "{{url('/')}}/set_email_subscription", 
              type: 'POST',
              data: form.serialize(),
              success:function(res){
                  console.log(res);
                //alert(res);
                if(res == 1){
                    $("#set_email_subscription_div").html('<div class="alert alert-success alert-dismissible">You have successfully modified your email preferences.. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                  dismiss_message();
                }else {
                    $("#set_email_subscription_div").html('<div class="alert alert-danger alert-dismissible"> Failed !!! Please try Again<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                dismiss_message();
                }
             }
        });
          
        });
        
        //change Password
         $( "#change_password_form" ).submit(function( event ) {
         event.preventDefault();
         var form = $(this);
         $.ajax({
              url: "{{url('/')}}/change_user_password", 
              type: 'POST',
              data: form.serialize(),
              success:function(res){
                  console.log(res);
                //alert(res);
                if(res == 1){
                    $("#change_password_msg_div").html('<div class="alert alert-success alert-dismissible">Password Successfully changed.. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                  dismiss_message();
                }else {
                    $("#change_password_msg_div").html('<div class="alert alert-danger alert-dismissible"> Old Password Not Matched... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                dismiss_message();
                }
             }
        });
          
        });
 //to delete notify products
     function delete_notify_product(id)
     {
          $.ajax({
              url: "{{url('/')}}/delete_notify_product",
              type: 'POST',
              data: {"id": id,  "_token": "{!! csrf_token() !!}"},
              success:function(res){
               // alert(res);
                if(res == 1){
                    $('#product_notify_tr_'+id).hide();
                    $("#notify_product_table").append('<div class="alert alert-success alert-dismissible">Successfully Removed... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                  dismiss_message();
                }else {
                    $("#notify_product_table").append('<div class="alert alert-danger alert-dismissible"> Failed !!! Please try Again<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                dismiss_message();
                }
             }
        });
     }
         //reply user who contacted seller
       function reply_user(id, sid, pid)
       {
           var id = id;
           var sender_id  = sid;
           var product_id = pid;
           $.ajax({
               type:'POST',
               url:'{{ url('/')}}/get_contact_users_chat',
               data:{
                   "id" : id,
                   "sender_id" : sender_id,
                   "product_id" : product_id,
                   "_token": "{!! csrf_token() !!}"
                   },
            
               success:function(res) {
                  
                  $("#chat_content_body").html(res);
                  $('#contact_user_modal').modal();
                  $('#chat_content').animate({scrollTop: $('#chat_content').prop("scrollHeight")}, 500);
               }
            });
       }
       
      
    </script>
<!-- to load state on country change -->	
	<script type="text/javascript">
    $('#country').change(function(){
    var country_id = $(this).val();    
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+country_id,
           success:function(res){               
            if(res){
                $("#region").empty();
                $("#region").append('<option value="">Select</option>');
                $.each(res,function(key,value){
                    $("#region").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#region").empty();
            }
           }
        });
    }else{
        $("#region").empty();
        
    }      
   });
   
  function  licent_toplogy(val){
       if(val=='other')
       {
           $("#other_licence_div").show();
           $('#m_other_licence_typology'). attr("required","required");
       }else{
            $("#other_licence_div").hide();
            $('#m_other_licence_typology'). removeAttr("required","required");
            $('#m_other_licence_typology').val('');
       }
       if(val=='no licence' || val=='')
       {
           $("#licence_detail_div").hide();
           //$("a"). removeAttr("href");
           $('#m_expendition_date'). removeAttr("required","required");
           $('#m_licence_no'). removeAttr("required","required");
           $('#m_licence_expiry_date'). removeAttr("required","required");
       }
       else{
           $("#licence_detail_div").show();
           $('#m_expendition_date'). attr("required","required");
           $('#m_licence_no'). attr("required","required");
           $('#m_licence_expiry_date'). attr("required","required");
       }
   }
   
   
  
   
   
   
</script>

<script>
//datepicker

  $( function() {
        $( "#date_of_birth, #dni_expendition_date, #dni_expiry_date, #m_expendition_date, #m_licence_expiry_date" ).datepicker({
            dateFormat: 'dd/mm/yyyy',
            autoClose: true,
           
        });
  } ); 
  
  //to open alarm for dni expiry
   $('#add_dni_expiry_date').click(function() {
        $("#myModal").modal();
    });
    
    //to open alarm for dni expiry
   $('#add_m_licence_expiry_date').click(function() {
        $("#m_licence_expiry_Modal").modal();
    });
  </script>
  <script type="text/javascript">
      $('.nav-tabs li').on('click', function(){
        $('.nav-tabs li').removeClass('active');
        $(this).toggleClass('active');
      });
  </script>
  <script type="text/javascript">

      function removeme(gid){
        $.ajax({
            url: "remove_bike/"+gid,
            type: 'GET',
            data: {"id": gid},
             beforeSend: function(){
                $(this).text('processing...');
            },
            success:function(res){
                //var obj = jQuery.parseJSON(res);

                if(res == 1){
                    var class_1 = $(this).parent().css('border','2px solid red');
                    console.log(class_1);
                }else{
                    alert(2);
                }

            }
        });

      }
      
      function remove_search_bike(id){
          var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: "<?= url('/') ?>/remove_search_bike/"+id,
            type: 'GET',
            data: {
                "id": id,
                "_token" : token,
            },
             beforeSend: function(){
                $(this).text('processing...');
            },
            success:function(res){
                //var obj = jQuery.parseJSON(res);
                //alert(id);
                if(res == 1){
                    $('#search_div_'+id).hide();
                    $("#search_bike_remove_status").append('<div class="alert alert-success alert-dismissible">Successfully Removed... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                //$(this).closest(".seach_div_res").hide();
                dismiss_message();

                    console.log('success');
                }else{
                    $("#search_bike_remove_status").append('<div class="alert alert-success alert-dismissible">Failed ... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                    dismiss_message();
                    
                }

            }
        });

      }
  </script>
  
  <script>
      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('#profile_pic_preview').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#profile_pic").change(function(){
            readURL(this);
        });
  </script>

  <script type="text/javascript">
        function reply_link(id){
            $('#reply_container_'+id).show();
        }

        function reply_to_user(id, name, email, question){

            var answer = $('#comment_'+id).val();
            $th = this;
            //alert("id"+ id+"name"+name+"email"+email+"question"+question+"answer"+answer);
            $.ajax({
                  url: "{{url('/')}}/reply_to_user",
                  type: 'POST',
                  data: {"id": id, "name":name, "email":email, "question":question, "answer":answer, "_token": "{!! csrf_token() !!}"},
                  success:function(res){
                    if(res == 1){
                        $('#reply_container_'+id).hide();
                    }                
                 }
            }); 
        }
        //
        function request_media_approve(media_id, status){
            $.ajax({
                  url: "{{url('/')}}/request_media_approve",
                  type: 'POST',
                  data: {"media_id": media_id, "status":status, "_token": "{!! csrf_token() !!}"},
                  success:function(res){

                    if(res == 1){
                        //$('#req_dis_approv_'+media_id).hide();
                        $('#req_approv_'+media_id+' span').text('Approved');
                    }
                    if(res == 0){
                        //$('#req_approv_'+media_id).hide();
                        $('#req_dis_approv_'+media_id+' span').text('Cancelled');
                    }

                    
                 }
            });
        }
        ////////////////////
        $('.edit_doc').on('click', function(){

            var fid     = $(this).attr('id');
            var title   = $('#doc_title_'+fid).val();
            var desc    = $('#doc_desc_'+fid).val();
            var privacy = $('#doc_privacy_'+fid).val();
            var doc_id = $('#doc_id_'+fid).val();

            var model_category = $('#model_category_'+fid).val();
            var data_container = '';

            if(model_category == 1 || model_category == 2){

                var currency_invoice    = $('#currency_invoice_'+fid).val();
                var spend_invoice       = $('#spend_invoice_'+fid).val();
                var spend_acces         = $('#spend_acces_'+fid).val();
                var spend_tuning        = $('#spend_tuning_'+fid).val();
                var spend_replace       = $('#spend_replace_'+fid).val();
                var user_id             = $('#model_userid_'+fid).val();
                var product_id          = $('#model_productid_'+fid).val();
                var related_media = $('#related_media').val();

                data_container = {"title": title, "desc":desc,"privacy":privacy, "doc_id":doc_id,"model_category":model_category,"currency_invoice":currency_invoice,"spend_invoice":spend_invoice,"spend_acces":spend_acces,"spend_tuning":spend_tuning,"spend_replace":spend_replace,"user_id":user_id,"product_id":product_id,"related_media":related_media,"_token": "{!! csrf_token() !!}"}

            }else{
                data_container = {"title": title, "desc":desc,"privacy":privacy, "doc_id":doc_id,"model_category":model_category, "_token": "{!! csrf_token() !!}"};
            }
            
            $.ajax({
                  url: "{{url('/')}}/update_doc",
                  type: 'POST',
                  data: data_container,
                  success:function(res){
                    console.log(res);
                    if(res == 1){
                        $('#msg_'+fid).html('<div class="alert alert-success" role="alert">Document Updated Successfully..</div>');
                    }
                    if(res == 0){
                        $('#msg_'+fid).html('<div class="alert alert-danger" role="alert">Try again..</div>');
                    }

                 }
            });
        });
        $('.view_0').on('click', function(){
            var id = $(this).attr('data-id');
            var th = this;
            $.ajax({
                  url: "{{url('/')}}/view_doc",
                  type: 'POST',
                  data: {"id": id, "_token": "{!! csrf_token() !!}"},
                  success:function(res){
                    if(res == 1){
                        $(th).css({"border-bottom": "1px solid #cccccca3","background": "none","font-weight": "normal", "cursor": "default", "font-size": "inherit", "padding": "18px"});
                    }
                 }
            });
        });
        
        //save_related_invoice
        $('.save_related_invoice').on('click', function(e){

          var checked =$('#related_invoice_form .related_check').serializeArray();

          $.ajax({
                  url: "{{url('/')}}/related_invoice",
                  type: 'POST',
                  data: {"related_invoice": checked, "_token": "{!! csrf_token() !!}"},
                  success:function(res){
                    $('.show .modal-body .col-lg-7 #related_invoice_date').html(res);
                    $(".close_related_invoice").click();

                 }
            });

        });
        $(".close_related_invoice").on('click', function(){
         setTimeout(function(){ $('body').addClass('modal-open'); }, 1000);
        });
        //add_document_btn
        $("#add_document_frm").on('submit', function(event){
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{url('/')}}/add_document",
                headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
                },
                type:"POST",
                data:formData,
                processData: false,
                contentType: false,
                success:function(res){
                    $('#add_doc_msg').html(res);
                    $("#add_document_frm").trigger("reset");
                },
                error:function(error){
                    console.log(error);
                }
            });
        });

    </script>
<script>
var defaultOpts = {
  draggable: true,
  resizable: true,
  movable: true,
  keyboard: true,
  title: true,
  modalWidth: 320,
  modalHeight: 320,
  fixedContent: true,
  fixedModalSize: false,
  initMaximized: false,
  gapThreshold: 0.02,
  ratioThreshold: 0.1,
  minRatio: 0.05,
  maxRatio: 16,
  headToolbar: ['maximize', 'close'],
  footToolbar: ['zoomIn', 'zoomOut', 'prev', 'fullscreen', 'next', 'actualSize', 'rotateRight'],
  multiInstances: true,
  initEvent: 'click',
  initAnimation: true,
  fixedModalPos: false,
  zIndex: 1090,
  dragHandle: '.magnify-modal',
  progressiveLoading: true
};

var vm = new Vue({
  el: '.magnify',
  data: {
    options: defaultOpts
  },
  updated: function () {
    $('[data-magnify]').magnify(this.options);
  }
});

</script>
</body>
</html>