<?php
use App\Http\Helpers\ApiCommonHelper as myhelper;
use \App\Http\Controllers\Shop as controller;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Motoblockchain | Product detail </title>
  <!-- end top css/js scripts -->
@include('common.head')
<link rel="stylesheet" href="{{ url('/')}}/public/css/jquery.magnify.css">

<link rel="stylesheet" href="{{ url('/')}}/public/css/slick-slider.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/fancybox.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/mediaelementplayer.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/color.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/shop.css">

<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/flaticon.css') }}">
<style type="text/css">
    .automobile-shop-title > small.notify{left: 4px; position: relative;}
    .automobile-shop-title > small a{color: #fff;}
    .alert-dismissable .close, .alert-dismissible .close {
    left: inherit;
    right: 0;
    top: 0px;
}
.img_container{width: 100%;
    border: 1px solid #dee2e6;
    text-align: center;
    padding: 40px 0px 20px 0px !important;}
.img_container small{position: absolute;    top: 15px;    right: 15px;}
.img_container small a{background: #fa6a2f;padding:4px 9px;color:#fff !important;border-radius: 6px;    cursor: pointer;}
.doc_title{padding: 0 16px;}
.doc_title a{float: right;cursor: pointer;}
.doc_title a i, .doc_title a i.fa{color:#fa6a2f;}
.nav-pills .nav-link {
    border: 1px solid #fa6a2f;
    color: #fa6a2f;
    margin-bottom: 1px;
    border-radius: 0;
    }
    .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
    background-color: #fa6a2f;
    }
    .nav-link.active::after{border:0;}
    .featured_section{border-top: 2px solid #fa6a2f;padding: 20px 0;border-bottom: 2px solid #fa6a2f;}
    /* Tooltip */
  .ask_to_access{position: absolute;
    top: 14px;
    left: 7px;
    line-height: 15px;
    font-size: 15px;
    text-align: center;
    width: 76%;}
.magnify-modal .is-grab img.magnify-image{left: 0 !important;}
.magnify-maximize .is-grab{text-align: center;}
.magnify-maximize .is-grab img.magnify-image{left: 0 !important; right: 0 !important;}
/*.fancybox-image{transform: rotate(90deg);} */
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
                            <span>Welcome to</span>
                            <h1>Motoblockchain Database</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#">Shop</a></li>
                            <li class="automobile-color">Grid</li>
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

                        <div class="col-md-12">
                            <div class="automobile-shop-wrap">
                                <div class="automobile-shop-slide">
                                  <div class="automobile-shop-thumb">
                                      <div class="automobile-images-thumb-layer ex1 magnify"><span>
                                        @if(!empty($datas->bike_imgs))
                                        <a data-magnify="gallery" href="{{ url('/')}}/public/images/{{$datas->user_id}}/{{$datas->id}}/{{$datas->bike_imgs}}">
    
                                            <img src="{{ url('/')}}/public/images/{{$datas->user_id}}/{{$datas->id}}/{{$datas->bike_imgs}}" alt="">
                                        </a>
                                        @else
                                            <img src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="">
                                        @endif
                                        @if(!empty($datas->selling_price))
                                            <small>sale</small>
                                        @endif
                                        </span>
                                        </div>
                                        <!-- category id : 3 for for main photo of photo galary or album. -->
                                        <?php 
                                        $medias = myhelper::get_product_media($datas->id, 3); 
                                        if(count($medias)>0){
                                            foreach($medias as $media){ ?>
                                                <div class="automobile-images-thumb-layer ex1 magnify">
                                                    <span>
                                                        <a data-magnify="gallery" href="{{ url('/')}}/public/images/{{$datas->user_id}}/{{$datas->id}}/{{$media->file}}">
                                                            <img src="{{ url('/')}}/public/images/{{$datas->user_id}}/{{$datas->id}}/{{$media->file}}" alt="">
                                                        </a>
                                                        <small>sale</small>
                                                    </span>
                                                </div>
                                            <?php }
                                        }
                                        ?>
                                  </div>
                                  <div class="automobile-shop-thumb-list">
                                      <div class="automobile-images-list-layer"><span>
                                        @if(!empty($datas->bike_imgs))
                                        <img src="{{ url('/')}}/public/images/{{$datas->user_id}}/{{$datas->id}}/{{$datas->bike_imgs}}" alt="">
                                        @else
                                        <img src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="">
                                        @endif
                                    </span></div>
                                    <?php
                                     if(count($medias)>0){
                                        foreach($medias as $media){ ?>
                                            <div class="automobile-images-list-layer"><span><img src="{{ url('/')}}/public/images/{{$datas->user_id}}/{{$datas->id}}/{{$media->file}}" alt=""></span></div>
                                        <?php }
                                    }
                                    ?>
                                  </div>
                                </div>
                                <div class="automobile-shop-summery">
                                    <div class="automobile-shop-title">
                                        <h2>{{$datas->bike_name}}</h2>
                                        <span>{{($datas->selling_price) ? '$'.$datas->selling_price : ''}}</span>
                                        <small class="notify"><a id="notify_me" href="javascript:void(0)">Notify Me</a></small><small><a id="save_product" href="javascript:void(0)">Save</a></small>
                                    </div>

                                    <ul class="brand-info">
                                        <li>Brand: <span>{{$datas->brand_name}}</span></li>
                                        <li>Model: <span>{{$datas->model_name}}</span></li>
                                        <li>Year: <span>{{$datas->year}}</span></li>
                                        <li>Time of registration :<span> {{ date("d M Y h:i A", strtotime($datas->created_at)) }}</span></li>
                                    </ul>      
                                    <p> {{ strip_tags($datas->description) }}</p>
                                    <input type="hidden" id="product_id" value="{{ $datas->id }}" />
                                    <input type="hidden" id="seller_id" value="{{ $datas->user_id }}" />
                                </div>                                
                            </div>
                            <!--// Tabs \\-->
                            <div id="request_msg">
                                
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" style="display: none;" id="btn_doc_req" data-toggle="modal" data-target="#req_msg">
    Open modal
  </button>
  <!-- The Modal -->
  <div class="modal fade" id="req_msg">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Document  Request</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div id="model_info"></div>
            @if(@Auth::user()->id)
           <div id="form_content">
               <div id="hidden_group"></div>
               <div class="form-check">
                <label class="form-check-label">
                    <input type="checkbox" id="access" style="display: block;" name="access" class="form-check-input"> Ask access to private document</label>
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
              </div>
            </div>  
            @else
            <?php
            $product_id = (!empty($datas->id))? '?req=product/'.$datas->id : '';
            $login_url = url('/').'/login'.$product_id;
            echo 'Login is Required <em> : Please Login <a href="'.$login_url.'">Click Here</a>';
            ?>
          @endif
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          @if(@Auth::user()->id)
          <button type="button" class="btn btn-primary send_request">Send</button>
          @endif
        </div>
        
      </div>
    </div>
  </div>

                            </div>
<div class="clearfix"></div>
    <div class="row featured_section">
                          <div class="col-3 p-0">
                                <!-- Nav tabs -->
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                              <a class="nav-link active" data-toggle="pill" href="#all_photo" role="tab" aria-selected="true">All photos</a>
                              <a class="nav-link" data-toggle="pill" href="#all_photo_by_date" role="tab" aria-selected="false">Motorcycle photos by date</a>
                              <a class="nav-link" data-toggle="pill" href="#tuning_components" role="tab" aria-selected="false">Tuning Components</a>
                              <a class="nav-link" data-toggle="pill" href="#motor_accessories" role="tab" aria-selected="false">Motorcycle Accessories</a>
                               <a class="nav-link" data-toggle="pill" href="#replacement" role="tab" aria-selected="false">Replacement</a>
                                <a class="nav-link" data-toggle="pill" href="#invoice_receipt" role="tab" aria-selected="false">Invoice and Receipt</a>
                                <a class="nav-link" data-toggle="pill" href="#documentation" role="tab" aria-selected="false">Documentation</a>
                                <a class="nav-link" data-toggle="pill" href="#mileage" role="tab" aria-selected="false">Mileage</a>
                                <a class="nav-link" data-toggle="pill" href="#profile" role="tab" aria-selected="false">Contact seller</a>
                            </div>
</div>
                          <div class="col-9">
                                <!-- Tab panes -->
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="all_photo" role="tabpanel" aria-labelledby="all_photo">
                                        <?php 
                                        $al = myhelper::get_media_files($datas->id);
                                        echo controller::document_files($datas->id, $datas->user_id, $al);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="all_photo_by_date" role="tabpanel" aria-labelledby="all_photo_by_date">
                                        <?php 
                                        $pd = myhelper::get_media_files($datas->id, array(4,5,6));
                                        echo controller::document_files($datas->id, $datas->user_id, $pd);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="tuning_components" role="tabpanel" aria-labelledby="tuning_components">
                                        <?php 
                                        $tu = myhelper::get_media_files($datas->id, array(8));
                                        echo controller::document_files($datas->id, $datas->user_id, $tu);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="motor_accessories" role="tabpanel" aria-labelledby="motor_accessories">
                                        <?php 
                                        $ac = myhelper::get_media_files($datas->id, array(7));
                                        echo controller::document_files($datas->id, $datas->user_id, $ac);
                                        ?>
                                    </div>
                                     <div class="tab-pane fade" id="replacement" role="tabpanel" aria-labelledby="replacement">
                                        <?php 
                                        $re = myhelper::get_media_files($datas->id, array(9));
                                        echo controller::document_files($datas->id, $datas->user_id, $re);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="invoice_receipt" role="tabpanel" aria-labelledby="invoice_receipt">
                                        <?php 
                                        $in = myhelper::get_media_files($datas->id, array(1,2));
                                        echo controller::document_files($datas->id, $datas->user_id, $in);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="documentation" role="tabpanel" aria-labelledby="documentation">
                                        <?php 
                                        $do = myhelper::get_media_files($datas->id, array(13));
                                        echo controller::document_files($datas->id, $datas->user_id, $do);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="mileage" role="tabpanel" aria-labelledby="mileage">
                                        <?php 
                                        $mi = myhelper::get_media_files($datas->id, array(10));
                                        echo controller::document_files($datas->id, $datas->user_id, $mi);
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile">
                                        <div class="comments-area">
                                          <!--// coments \\-->
                                          <ul class="comment-list">
                                               @if(count($contact_sellers) > 0)
                                                    @foreach($contact_sellers as $contact_seller)
                                                        @if($contact_seller->sender_id == @Auth::user()->id)
                                                            <li>
                                                                <div class="thumb-list">
                                                                         <figure>
                                                                             @if($contact_seller->profile_pic)
                                                                                <img alt="" src="{{ url('/')}}/public/images/{{$contact_seller->sender_id}}/{{$contact_seller->profile_pic}}">
                                                                                @else
                                                                                <img alt="" src="{{ url('/') }}/public/images/default_images/default_user.png">
                                                                             @endif
                                                                             
                                                                            </figure>
                                                                         <div class="text-holder">
                                                                            <h6>{{ $contact_seller->name }} </h6>
                                                                            <time class="post-date automobile-color" datetime="2008-02-14 20:00">{{ date(' jS F Y', strtotime($contact_seller->created_at) )  }}</time><br/>
                                                                            <p>{{ $contact_seller->message }}  </p>
                                                                         </div>
                                                                    </div>
                                                                <!-- .children -->
                                                             </li>
                                                             @else
                                                             <li>
                                                                <ul class="children">
                                                                   <li>
                                                                      <div class="thumb-list">
                                                                         <figure>
                                                                             @if($contact_seller->profile_pic)
                                                                                <img alt="" src="{{ url('/')}}/public/images/{{$contact_seller->sender_id}}/{{$contact_seller->profile_pic}}">
                                                                                @else
                                                                                <img alt="" src="{{ url('/') }}/public/images/default_images/default_user.png">
                                                                             @endif
                                                                             
                                                                         </figure>
                                                                         <div class="text-holder">
                                                                            <h6>{{ $contact_seller->name }} </h6>
                                                                            <time class="post-date automobile-color" datetime="2008-02-14 20:00">{{ date(' jS F Y', strtotime($contact_seller->created_at) )  }}</time><br/>
                                                                            <p>{{ $contact_seller->message }}  </p>
                                                                         </div>
                                                                      </div>
                                                                   </li>
                                                                   <!-- #comment-## -->
                                                                </ul>
                                                                
                                                             </li>
                                                        @endif
                                                         
                                                         <!-- #comment-## -->
                                                         
                                                    @endforeach
                                                    @else
                                                    <li>
                                                            <div class="thumb-list">
                                                                     <h3>Send Message To seller and wait for  reply</h3>
                                                                </div>
                                                            <!-- .children -->
                                                         </li>
                                                 @endif
                                            
                                             <!-- #comment-## -->
                                          </ul>
                                          <!--// coments \\-->
                                          <!--// comment-respond \\-->
                                          <div class="comment-respond">
                                             <div class="automobile-section-heading"><h2 class="automobile-color">Ask Questions</h2></div>
                                                 <p class="automobile-full-form">
                                                   <textarea name="comment" id="message" placeholder="Your Comment" class="commenttextarea"></textarea>
                                                </p>
                                                <p class="form-submit"><input id="ask_to_seller" class="btn automobile-read-btn pull-right btn-lg" type="submit" value="Submit"></p>
                                          </div>
                                          <!--// comment-respond \\-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            </div>

                            <!--// Tabs \\-->
                            <div class="automobile-section-heading"><h2 class="automobile-color">Related Products</h2></div>
                            <div class="automobile-shop automobile-shop-grid">
                                <ul class="row">
                                    @if(count($related_products)>0)
                                        @foreach($related_products as $related_product )
                                        <li class="col-md-3">
                                            <figure><a href="{{ url('/')}}/product/{{ $related_product->id}}">
                                                @if(!empty($related_product->bike_imgs))
                                                    <img src="{{ url('/')}}/public/images/{{$related_product->user_id}}/{{$related_product->id}}/{{$related_product->bike_imgs}}" alt="">
                                                @else
                                                    <img src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="">
                                                @endif
                                                <span>Read Details</span></a>
                                                 @if(!empty($related_product->selling_price))
                                                 <span>sale</span>
                                                 @endif
                                                
                                                </figure>
                                            <div class="automobile-shop-grid-text">
                                                <h4><a href="{{ url('/')}}/product/{{ $related_product->id}}">{{$related_product->bike_name}}</a></h4>
                                                <span> @if(!empty($related_product->selling_price))
                                                {{$related_product->currency_code}} {{$related_product->selling_price}}
                                                @endif
                                                </span>
                                               <!-- <a href="#" class="automobile-cart-box fa fa-shopping-cart"></a>
                                                <a href="#" class="fa fa-heart-o"></a>-->
                                            </div>
                                        </li>
                                        @endforeach
                                    
                                    @endif
                                    
                                    
                                    
                                    
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--// Main Section \\-->

        </div>
<div class="clearfix"></div>
<!-- footer start -->
 @include('common.footer')
<!-- footer close -->

<script type="text/javascript" src="{{ url('/')}}/public/js/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/slick.slider.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/fancybox.pack.js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/isotope.min.js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/mediaelement-and-player.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/functions.js"></script>
<script type="text/javascript" src="{{ url('/')}}/public/js/jquery.magnify.js"></script>
 
 <script type="text/javascript">
 //To hide div after 5 sec
     function dismiss_message()
     {
         setTimeout(function() {
            $('.alert-dismissible').fadeOut('fast');
        }, 5000);
     }
     
  $('#save_product').on('click', function(event){

    var product_id = $('#product_id').val();

    $.ajax({
          url: "{{url('/')}}/save_product",
          type: 'POST',
          data: {"product_id": product_id, "_token": "{!! csrf_token() !!}"},
          success:function(res){
            if(res == 1){
                $(".automobile-shop-title").before('<div class="alert alert-success alert-dismissible">Save Successfully. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            }else if(res == 2){
                $(".automobile-shop-title").before('<div class="alert alert-success alert-dismissible">Save Successfully. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            }else if(res == 3){
                <?php 
                $product_id = (!empty($datas->id))? '?req=product/'.$datas->id : '';
                $login_url = url('/').'/login'.$product_id;
                ?> 
                $(".automobile-shop-title").before('<div class="alert alert-danger alert-dismissible">Login is Required <em> : Please Login <a href="{{$login_url}}"> Click Here.</a>. </em><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
            }
         }
    });
    
    dismiss_message();
    
    
  });

    $('#notify_me').on('click', function(event){
        var product_id = $('#product_id').val();
        $.ajax({
              url: "{{url('/')}}/save_product",
              type: 'POST',
              data: {"product_id": product_id, "noti":'notify_me', "_token": "{!! csrf_token() !!}"},
              success:function(res){
                if(res == 1){
                    $(".automobile-shop-title").before('<div class="alert alert-success alert-dismissible">Notify alert Save Successfully. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                }else if(res == 2){
                    $(".automobile-shop-title").before('<div class="alert alert-success alert-dismissible">Notify alert Updated Successfully. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                }else if(res == 3){
                <?php 
                $product_id = (!empty($datas->id))? '?req=product/'.$datas->id : '';
                $login_url = url('/').'/login'.$product_id;
                ?>
                    $(".automobile-shop-title").before('<div class="alert alert-danger alert-dismissible">Login is Required <em> : Please Login <a href="{{$login_url}}"> Click Here.</a>. </em><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                }
             }
        });
        
        dismiss_message();
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('.automobile-shop-tabs li a').on('click', function(){
        	$('#photos_by_date').hide();
        	$('#tuning_photo').hide();
        	$('#accessories_photo').hide();
        	$('#profile').hide();
            $('.automobile-shop-tabs li').removeClass('active');
            $(this).parent().addClass('active');
            var href = $(this).attr('href');
            var tid = href.substring(1, href.length);
            $('#'+tid).show();
        });
        // ask to seller
        $('#ask_to_seller').on('click', function(event){
            var product_id = $('#product_id').val();
            var seller_id = $('#seller_id').val();
            var question = $('#message').val();
            if(question != ''){
                $.ajax({
                      url: "{{url('/')}}/ask_to_seller",
                      type: 'POST',
                      data: {"product_id": product_id, "seller_id":seller_id, "question":question , "_token": "{!! csrf_token() !!}"},
                      success:function(res){
                        //alert(res);
                        if(res == 1){
                            $("p.form-submit").after('<div class="clearfix"></div><div class="alert alert-success alert-dismissible">Your Message has send Successfully. <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                            $('#message').val('');
                        }else {
                            <?php 
                            $product_id = (!empty($datas->id))? '?req=product/'.$datas->id : '';
                            $login_url = url('/').'/login'.$product_id;
                            ?>
                            $("p.form-submit").after('<div class="clearfix"></div><div class="alert alert-danger alert-dismissible">Login is Required <em> : Please Login <a href="{{$login_url}}"> Click Here.</a>. </em><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                        }
                     }
                });
                
                dismiss_message();
                
            }else{
                $('#message').css("border", "2px solid red");
            }
          event.preventDefault();  
        });
        $("#message").keyup(function(){
            $("input").css("border", "0px solid red");
        });

    });
</script>
<script type="text/javascript">
        //
        function request_media(media_id, type){
            $('#req_msg .modal-body #model_info').hide();
            $('#btn_doc_req').trigger('click');
            $('#req_msg .modal-body #form_content').show();
            $('#req_msg .send_request').show();

            var input_group = '<input type="hidden" id="c_media_id" value="'+media_id+'" /><input type="hidden" id="c_type" value="'+type+'" />';
            $('#req_msg .modal-body #hidden_group').html(input_group);
        }

        $('.send_request').on('click', function(){
            $('#req_msg .modal-body #model_info').hide();
            $('#req_msg .modal-body #form_content').show();
            var th = this;
            var product_id = $('#product_id').val();
            var seller_id = $('#seller_id').val();
            var media_id = $('#c_media_id').val();
            var type = $('#c_type').val();
            var private = $('input[name="access"]:checked').length > 0;
            var comment = $('#comment').val();
            //+'comment:'+comment+'type:'+type+'media_id:'+media_id+'seller_id'+seller_id+'product_id:'+product_id
            //alert(private);
            $.ajax({
                  url: "{{url('/')}}/request_media",
                  type: 'POST',
                  data: {"product_id": product_id, "media_id":media_id,"seller_id":seller_id, "type":type, "private":private, "comment":comment, "_token": "{!! csrf_token() !!}"},
                  success:function(res){
                    //alert(res);
                    $(th).hide();
                    $('#req_msg .modal-body #form_content').hide();
                    $('#req_msg .modal-body #model_info').show();
                    $('#req_msg .modal-body #model_info').html(res);
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