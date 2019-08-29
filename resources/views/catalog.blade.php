<?php
use App\Http\Helpers\ApiCommonHelper as myhelper;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Motoblockchain | Registration</title>
  <!-- end top css/js scripts -->
@include('common.head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ url('/')}}/public/css/color.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/blog-description.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/shop.css">

<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/flaticon.css') }}">
<style type="text/css">
  .small, .automobile-shop-grid-text span.small{width: 100%;font-size: 12px;float: left;color:#242634ed;line-height: 18px;}
  .filter_label{
    padding: 5px;
    margin: 5px;
    width: fit-content;
    background: #f2682f;
    box-shadow: none;
    border-radius: 0;
    color: #fff;
    border: 0;float: left;
    position: relative;
  }
  .filter_label span{padding-right: 10px;
    position: relative;
    top: -2px;
  }
  .alert-dismissible .close {right: 0;
    top: 0;
    left: unset;}
  .filter_label .filter_close{
    display: contents;
    color: #fff;
    padding: 0;
    margin: 0;
  }
   .select2-selection {
  -webkit-box-shadow: 0;
  box-shadow: 0;
  background-color: #fff;
  border: 0;
  border-radius: 0;
  color: #555555;
  font-size: 14px;
  outline: 0;
  min-height: 48px;
  text-align: left;
}

.select2-selection__rendered {
  margin: 10px;
}

.select2-selection__arrow {
  margin: 10px;
}
#loader{position: absolute;width: 100%;z-index: 9;background: rgba(225,225,225,0.8);
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    align-items: center;
  }
#loader > img{    width: 148px !important;height: 150px!important;}
.automobile-main-content{position: relative; padding: 0;}
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
                            <h1>Our Motorcycle Search Results</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{ url('/')}}">Home</a></li>
                            <li class="automobile-color">Search List</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<div class="automobile-main-content">
<!-- Image loader -->
<div id="loader" style="display: none;">
  <img src="{{ url('/')}}/public/images/loader.gif" />
</div>
<!-- Image loader -->
      <!--// Main Section \\-->
      <div class="automobile-main-section pt-5">
        <div class="container">
          <div class="row">

                        <!--// SideBaar \\-->
                        <aside class="col-md-3">
                          <form id="filter_form">
                          <div class="widget widget_categories">
                            <div class="automobile-widget-heading">
                              <h2>Searched By </h2><i class="fa fa-angle-down"></i>
                            </div>
                            <div id="searched_by_key">
                            <?php 
                            if(!empty($_REQUEST['brand'])){
                              $brand  = myhelper::get_brand_name($_REQUEST['brand']);
                            }else{
                              $brand = '';
                            } 
                            if(!empty($_REQUEST['model'])){
                              $model  = myhelper::get_model_name($_REQUEST['model']);
                            }else{
                              $model  = '';
                            } 
                            $from_year = (!empty($_REQUEST['from_year']))? $_REQUEST['from_year'] : '';
                            $to_year = (!empty($_REQUEST['to_year']))? $_REQUEST['to_year'] : '';
                            if($from_year != '' && $to_year != ''){
                              $year = '<div class="alert alert-success alert-dismissible filter_label"><span>From : '.$from_year.' To '.$to_year.'</span><button type="button" active_check="dselect" class="close filter_close" data-dismiss="alert">&times;</button></div>';
                            }else{
                              $year = '';
                            }
                            
                            if($brand !=''){
                                echo '<div class="alert alert-success alert-dismissible filter_label"><span>'.$brand.'</span><button active_check="brand_'.$_REQUEST['brand'].'" type="button" class="close filter_close" data-dismiss="alert">&times;</button></div>'; 
                            }
                            if($model !=''){
                                echo '<div class="alert alert-success alert-dismissible filter_label"><span>'.$model.'</span><button active_check="model_'.$_REQUEST['model'].'" type="button" class="close filter_close" data-dismiss="alert">&times;</button></div>'; 
                            }
                            echo $year;
                            ?>
                           </div>
                               <!--// Widget categories \\-->
                            <div class="widget widget_categories" id="serach_by_brand">
                                <div class="automobile-widget-heading"><h2>Brand</h2><i class="fa fa-angle-down"></i></div>
                                    <ul class="overflow-auto">
                                      @foreach($brands as $brand)
                                      <li>
                                         
                                            <div class="automobile-check widget-check widget-true">
                                                <input name="brand[]" class="search_filter" id="brand_{{$brand->id}}" data-type="brand" value="{{$brand->id}}" <?php if(!empty($_REQUEST['brand'])){ echo ($_REQUEST['brand'] == $brand->id)? 'checked="checked"' : ''; } ?> type="checkbox">
                                                <label for="brand_{{$brand->id}}">{{$brand->brand_name}}</label>
                                            </div>
                                        </li>
                                      @endforeach
                                    </ul>
                            </div>
                            <!--// Widget categories \\-->
                               <!--// Widget categories \\-->
                            <div class="widget widget_categories" id="filter_model">
                                <div class="automobile-widget-heading"><h2>Models</h2><i class="fa fa-angle-down"></i></div>
                                <ul class="overflow-auto">
                                  @foreach($models as $model)
                                    <li>
                                        <div class="automobile-check widget-check widget-true">
                                            <input name="model[]" class="search_filter" id="model_{{$model->id}}" data-type="model" value="{{$model->id}}" type="checkbox" <?php if(!empty($_REQUEST['model'])){ echo ($_REQUEST['model'] == $model->id)? 'checked="checked"' : ''; } ?>>
                                            <label for="model_{{$model->id}}">{{$model->model_name}}</label>
                                        </div>
                                    </li>
                                  @endforeach
                                </ul>
                            </div>
                            <!--// Widget categories \\-->
                            <!--// Widget range \\-->
                           <!--
                            <div class="widget widget_range">
                                <div class="automobile-widget-heading"><h2>shop by price</h2><i class="fa fa-angle-down"></i></div>
                                
                                    <div id="slider-range" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 58%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 58%;"></span></div>
                                    <input type="text" id="amount" readonly="">
                                    <input type="submit" value="clear filters">
                                
                            </div> -->
                            <!--// Widget range \\-->

                            <!--// Widget availability \\-->
                            <div class="widget widget_categories Search_year_filter" style="margin:0px 0px 10px;">
                                <div class="automobile-widget-heading"><h2>From Years</h2><i class="fa fa-angle-down"></i></div>
                                <select id="from_year" name="from_year" data-type="from_year" class="select2 form-control search_filter">
                                  <option value=""> From Year</option>
                                  <?php 
                                  $last= date('Y')-10; 
                                  $now = date('Y')-0; 
                                  ?>
                                  @for ($i = $last; $i <= $now; $i++)
                                            <option <?php if(!empty($_REQUEST['from_year'])){ echo ($_REQUEST['from_year'] == $i)? 'selected="selected"' : ''; } ?> value="{{ $i }}">{{ $i }}</option>
                                   @endfor
                                </select>
                            </div>
                            <!--// Widget availability \\-->
                            <div class="widget widget_categories Search_year_filter" style="margin:0px 0px 10px;">
                                <div class="automobile-widget-heading"><h2>To Years</h2><i class="fa fa-angle-down"></i></div>

                                <select id="to_year" name="to_year" data-type="to_year" class="select2 form-control search_filter">
                                  <option value=""> To Year</option>
                                  <?php 
                                  $last= date('Y')-10;
                                  $now = date('Y')-0; 
                                  ?>
                                  @for($i = $now; $i >= $last; $i--)
                                            <option <?php if(!empty($_REQUEST['to_year'])){ echo ($_REQUEST['to_year'] == $i)? 'selected="selected"' : ''; } ?> value="{{ $i }}">{{ $i }}</option>
                                   @endfor
                                </select>
                            </div>
                          </div>
                          <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                        </form>
                        </aside>
                        <!--// SideBaar \\-->
                        <div class="col-md-9">
                            <div class="automobile-shop-filter">
                                <div class="automobile-shop-filter-nav">
                                    <span>{{count($products)}} results</span>
                                    <!-- <ul class="automobile-number-select">
                                      <li>
                                            <label>Sort by:</label>
                                            <div class="automobile-Color-select">
                                                <select>
                                                   <option value="">Price High To Low</option>
                                                   <option value="color">Price Low To High</option>
                                                </select>
                                            </div>
                                        </li>
                                    </ul> -->
                                    <!-- Nav tabs -->
                                    <!-- <ul class="nav-tabs" role="tablist">
                                      <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="icon-squares2"></i></a></li>
                                      <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="icon-interface-4"></i></a></li>
                                    </ul> -->
                                    <!-- Tab panes -->
                                </div>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div id="shop_grid" class="automobile-shop automobile-shop-grid">
                                              @if(empty($products))
                                             <div class="alert alert-warning alert-dismissible fade show">
                                                  <strong>Not Found !</strong> Motorcycles are not found. <a href="#" class="alert-link">Go to Home Page.</a>.
                                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              </div>
                                              @else
                                            <ul class="row">
                                              @foreach($products as $product)
                                              <li class="col-md-4">
                                                    <figure>
                                                    <a href="{{ url('/')}}/product/{{$product->id}}">
                                              @if(!empty($product->bike_imgs))
                                              <img src="{{ url('/')}}/public/images/{{$product->user_id}}/{{$product->id}}/{{$product->bike_imgs}}" alt="">
                                              @else
                                              <img src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="">
                                              @endif
                                                    </a>
                                                    @if(!empty($product->selling_price))
                                                    <span>sale</span>
                                                    @endif
                                                    </figure>
                                                    <div class="automobile-shop-grid-text">
                                                        <h4 style="margin: 0;"><a class="visit" data-productid="{{$product->id}}" data-userid="{{$product->user_id}}" href="{{ url('/')}}/product/{{$product->id}}">{{$product->bike_name}}</a></h4>
                                                        <time class="small" datetime="{{$product->created_at}}"><strong>Create Date :</strong> {{ date("d M Y h:i A", strtotime($product->created_at)) }}</time>
                                                        <span class="small"><strong>Number of Blockchain Certificates :</strong>{!! myhelper::count_certificate($product->id) !!}</span>
                                                        <span class="small"><strong>Modified :</strong> {!! myhelper::get_modified($product->id) !!}</span>
                                                        <span>
                                                        {{($product->selling_price) ? '$'.$product->selling_price : ''}}
                                                        </span>
                                                    </div>
                                                </li>
                                              @endforeach
                                              
                                            </ul>
                                            @endif 
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="profile">
                                        <div class="automobile-shop automobile-shop-list">
                                             @if(empty($products))
                                             <div class="alert alert-warning alert-dismissible fade show">
                                                  <strong>Not Found !</strong> Motorcycles are not found. <a href="#" class="alert-link">Go to Home Page.</a>.
                                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              </div>
                                              @else
                                              <?php  ?>
                                            <ul class="row">
                                              @foreach($products as $product)
                                                <li class="col-md-12">
                                                    <figure><a href="{{ url('/')}}/product/{{$product->id}}">
                                              @if(!empty($product->bike_imgs))
                                              <img src="{{ url('/')}}/public/images/{{$product->user_id}}/{{$product->id}}/{{$product->bike_imgs}}" alt="">
                                              @else
                                              <img src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="">
                                              @endif
                                            </a><span>sale</span></figure>
                                                    <div class="automobile-shop-list-text">
                                                        <h4><a href="{{ url('/')}}/product/{{$product->id}}">{{$product->bike_name}}</a></h4>
                                                        <span>
                                                        {{($product->selling_price) ? '$'.$product->selling_price : ''}}
                                                        </span>
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
<!-- bootstrap js cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<script type="text/javascript">

  $('.visit').on('click', function(event){

    var product_id = $(this).attr('data-productid');
    var user_id = $(this).attr('data-userid');

    $.ajax({
          url: "{{url('/')}}/visit_product",
          type: 'POST',
          data: {"product_id": product_id, "user_id": user_id, "_token": "{!! csrf_token() !!}"},
          success:function(res){
            console.log(res);
         }
    });

  });

  function do_search(){
    //alert('hii');
        $.ajax({
            url: "{{url('/')}}/search_filter",
            type: 'POST',
            dataType: 'json',
            data: $('#filter_form').serialize(),
            beforeSend: function(){
            $("#loader").show();
            },
            success:function(res){
              console.log(res);
              var dat = JSON.stringify(res);
              var data = JSON.parse(dat);
              if(data.model != ''){
                $('#filter_model').html(data.model);              
              }
              $('#searched_by_key').html(data.filter_key);
              $('.automobile-shop-filter-nav span').text(data.product_count+' results');
              $('#shop_grid').html(data.product_lists);
              $("#loader").hide();
           }
      });
  }
  $('#filter_model').on('click', '.search_filter',do_search);
  $('#serach_by_brand').on('click', '.search_filter',do_search);
  $('.Search_year_filter').on('change', '.search_filter',do_search);

</script>
<script>
$(document).ready(function() {
    $('.select2').select2({theme: "classic"});
    $('#searched_by_key').on('click', '.filter_close',function (){

      var active_check = $(this).attr('active_check');

      if(active_check == 'dselect'){
        $('#from_year').append($("<option selected='selected'></option>").attr("value",'').text('Select'));
        $('#to_year').append($("<option selected='selected'></option>").attr("value",'').text('Select'));
         do_search();
         
      }else{
        $('#'+active_check).trigger('click');
      }
    
  });
});
</script>
</body>
</html>