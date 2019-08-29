<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ url('/')}}/public/frontend/images/fevi.png" sizes="16x16">
    <title>Motoblockchain</title>

 <!-- font -->
 <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
 <!-- bootstrap cdn css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="{{ url('/')}}/public/frontend/css/style.css">
<link rel="stylesheet" href="{{ url('/')}}/public/frontend/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css">
<style type="text/css">
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
</style>
</head>
<body class="animated fadeIn">

<!-- loader start -->
 <div class="fix-loader">
    <div class="loader">
     <img src="{{ url('/')}}/public/frontend/images/MBCBigLogo_white.png">
   </div>
  </div>
<!-- loader close -->
<!-- header start -->
     @include('common.header')
<!-- header close -->
<!-- banner start -->
<section class="animated fadeIn" id="banner">
    <div class="banner-img headerBgImage">
        <img class="img-fluid" src="{{ url('/')}}/public/frontend/images/banner.png" style="min-width: 100%;" />
    </div>
</section>
<!-- banner close -->
<!-- love Motorcycle section start -->
<section class="wow fadeInDown" id="loveBike">
   <div class="container"> 
    <div class="row">
        <div class="col-sm-12 text-center">
           <h2 class="sectionHeading topHeading">Do you really love your Motorcycle? prove it! </h2>
        </div>
    </div>
        <div class="row">
            <div class="col-sm-3">
                @if(empty(Auth::user()->id))
              <a href="{{ url('/login') }}" class="btn-hover color-4">Sign In</a>
              @endif
            </div>
            <div class="col-sm-6">
                <a class="lifeBike" href="#">
                    The life of your Motorcycle in one site.
                </a>
            </div>
            <div class="col-sm-3">
                @if(empty(Auth::user()->id))
                   <a href="{{ url('/register') }}" class="btn-hover color-4">Sign Up</a>
                   @endif
            </div>
        </div>
    </div> 
</section>
<!-- love Motorcycle section close -->


<!-- giftMotorcycle section start -->

<section class="wow fadeInUp" id="giftmotorBike">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
               <h2>Now You can gift to your Motorcycle a Digital Identity that prove  <br/> how much you took care of her.</h2>
             <div class="col-sm-8 mx-auto">
               <ul class="list-inline">
               <li>    
               <a class="giftBtn" href="#">I want to gift a Digital Identity To my Motorcycle, for Free <i class="fa fa-angle-right" aria-hidden="true"></i></a>
               </li>
               <li>    
                <a class="giftBtn" href="#">I want to Buy a Motorcycle with Digital Identity <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                </li>
            </ul>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- giftMotorcycle section close -->



<section class="wow fadeInDown" id="valuedBike">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-12">
               <h2 class="sectionHeading">How much is your Motorcycle valued today? </h2>
            </div>
            <div class="col-sm-10 mt-2 mb-2 offset-1" style="font-size: 20px;">
              <strong><p>How much did you paid for your motorcycle and how much your motorcycle is valued today?</p></strong>
              <p>Now think in all the <span class="text-danger">Time</span>, <span class="text-danger">Money</span>and <span class="text-danger">Love</span> you invested in taking 
              care of her until now and add the ones you will invest in the future...</p>
              <p>How much your motorcycle should be valued today, and the day you are going to sell her?</p>
              <p>Discover how you can reach the right value thanks to the Digital Identity technology of Motoblockchain.</p>
            </div>
            <div class="col-sm-10 mx-auto">
                    <ul class="list-inline">
                            <li>  
                                    <div class="btn-group border-ra col">
                                            <a href="{{ url('/register') }}" class="giftBtn">Sign Up</a>
                                            <a href="{{ url('/what-we-do') }}" style="background:#e42324" class="giftBtn">Discover the Digital Identity Technology</a>
                                  </div>
                             </li>
                    </ul>
            </div>
        </div>
    </div>
</section>

<!-- search section start -->
<section class="wow fadeInUp" id="search-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-sm-12">
               <h2 class="sectionHeading" style="font-size:30px;">Search motorcycles, tuning and modifications in Motoblockchain database and contact the owner</h2>
            </div>
            <div class="col-sm-10 mt-2 mb-2 offset-1" style="font-size: 20px;">
              <p style="color:#fff;">You can search in our database of registered motorcycle, you can find the model you love, you can access modifications and tuning from other users, you can contact the owner and discover more about the motorcycle you have, or the one you love and you will buy in the future!</p>
            </div>
      </div>
        <div class="row">
            <div class="col-sm-12 formBg">
                    <ul class="nav nav-pills" role="tablist">
						<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#home">Search</a>
						</li>
						<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#used_motorcycle">Search a Used Motorcycle</a>
						</li>
                    </ul>
                        
                          <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="home" class="container tab-pane active">
                            <div class="row">
                              	<form action="/products" class="col">
                                    <div class="row mt-4 mx-0">
                                       <div class="col-4">
                                           <label>Brand</label>
                                                    <select name="brand" id="brand_id" class="select2 form-control">
                                                        <option value="" >  </option>
                                                       @foreach($brands as $brand)
                                                       <option value="{{$brand->id}}">{{$brand->brand_name}} </option>
                                                       @endforeach
                                                    </select>
                                                  
                                      <!----------------------->
                                       </div>
                                       <div class="col-4">
                                           <label>Model</label>
                                                    <select name="model" id="model_id" class="select2 form-control">
                                                        <option value="" >  </option>
                                                    </select>
                                                 
                                       </div>
                                       <div class="col-2">
                                           <label>From Year</label>
                                                    <select name="from_year" class="select2 form-control">
                                                      <?php $last= date('Y')-10; ?>
                                                      <?php $now = date('Y')-1; ?>
                                                      <option value=""></option>
                                                      @for ($i = $last; $i <= $now; $i++)
                                                      <option value="{{ $i }}">{{ $i }}</option>
                                                      @endfor
                                                    </select>
                                      <!----------------------->
                                       </div>
                                       <div class="col-2">
                                           <label>To Year</label>
                                                    <select name="to_year" class="select2 form-control">
                                                      <?php $last= date('Y')-10; ?>
                                                      <?php $now = date('Y')-1; ?>
                                                      <option value=""></option>
                                                      @for ($i = $last; $i <= $now; $i++)
                                                      <option value="{{ $i }}">{{ $i }}</option>
                                                      @endfor
                                                    </select>
                                      <!----------------------->
                                       </div>
                                    </div>
                                     
                                  	<div class="row mt-4">
                                      <div class="col-sm-4 mx-auto">
                                        <button class="giftBtn">Search</button>
                                      </div>
                                  	</div>
                                 
                                 <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
							</div>
                        </div>
                        <div id="used_motorcycle" class="container tab-pane">
                            <div class="row">
								<div class="text-center container" style="min-height: 100px;line-height:140px;
								"><p class="text-center" style="color:red;">coming soon</p></div>
                            </div>
                        </div>
                    </div>    
            </div>
        </div>
    </div>
</section>
<!-- search section close -->
<!--Products On Sale-->
    <section class="testimonials wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                  <h2 style="color:#000" class="sectionHeading">On Sale Motorcycles  </h2>
                </div>
            </div>
          <div class="row mt-5">
            <div class="col-sm-12">
              <div id="onsale_products" class="owl-carousel">
    
                <!--last addded Products 1 -->
                @foreach($onsales_product as $onsale)
                    <div class="item">
                      <div class="shadow-effect">
                          @if(!empty($onsale->bike_imgs))
                            <img class="img-responsive " src="{{ url('/')}}/public/images/{{$onsale->user_id}}/{{$onsale->id}}/{{$onsale->bike_imgs}}" style="width:100%;height:245px;object-fit: cover;" alt="" />
                            @else
                            <img class="img-responsive " src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="" />
                          @endif
                          
                        
                        <div class="item-details" style="background:#fff; text-align:center">
                        <h4>{{ $onsale->bike_name }} </h4>
                        <h6>{{ $onsale->brand_name }} {{ $onsale->model_name }}</h6>
                        <h5 style="color:#f67302"> {{ $onsale->currency_code }} {{ $onsale->selling_price }} </h5>
                                           
                         </div>
                      </div>
                    </div>
                @endforeach
                
             
              </div>


            </div>
          </div>
          
        </section>
<!--End Onsale product-->

<!-- last motor bike added start -->

<section class="testimonials wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                  <h2 style="color:#000" class="sectionHeading">Last Motorcycles added </h2>
                </div>
            </div>
          <div class="row mt-5">
            <div class="col-sm-12">
              <div id="customers-testimonials" class="owl-carousel">
    
                <!--last addded Products 1 -->
                @foreach($last_added_bike as $last_bike)
                    <div class="item">
                      <div class="shadow-effect">
                          @if(!empty($last_bike->bike_imgs))
                            <img class="img-responsive " src="{{ url('/')}}/public/images/{{$last_bike->user_id}}/{{$last_bike->id}}/{{$last_bike->bike_imgs}}" style="width:100%;height:245px;object-fit: cover;" alt="" />
                            @else
                            <img class="img-responsive " src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="" />
                          @endif
                          
                        
                        <div class="item-details">
                        <h5>{{ $last_bike->bike_name }} </h5>
                            <ul>
                                    <li> Brand : {{ $last_bike->brand_name }}</li> 
                                    <li> Model: {{ $last_bike->model_name }} </li>
                                    <li> Category: {{ $last_bike->category_name }}  </li>
                                   <li>CC : {{ $last_bike->cc_name }} </li>
                                   <li> CV : {{ $last_bike->cv_original_name }} </li>
                                    <li> Mileage/Actual Km: {{ $last_bike->c_mileage }}</li>
                                    
                            </ul>                     
                         </div>
                      </div>
                    </div>
                @endforeach
                
                <!--END OF Last added products 1 -->
               
               <!-- <div class="item">
                  <div class="shadow-effect">
                    <img class="img-responsive " src="{{ url('/')}}/public/frontend/images/image-2.png" alt="">
                    <div class="item-details">
                            <h5>Yamaha R1 2007</h5>
                            <ul>
                                   <li>1000cc, 150CV</li>
                                   <li>  Manillar Renthal</li>
                                    <li>  Contrapesos Manillar</li>
                                    <li>   Torretas Rebajadas</li> 
                                    <li>   Quilla Carbono</li>
                                    <li>   Cúpula Racing </li>
                                    <li>   Cúpula Touring</li>
                                    <li>   Baul Givi  47L</li>   
                            </ul>  
                    </div>
                  </div>
                </div>-->
               
            
              </div>


            </div>
          </div>
          <div class="row">
              <div class="col-sm-12 text-center">
                    <div class="btn-group col-sm-9">
                        <button type="button" class="giftBtn rounded-0">Search</button>
                        <button style="background:#e42324" type="button" class="giftBtn rounded-0">Search a Used Motorcycle</button>
              </div>
          </div>
          </div>
        </section>
        
        
        

<!-- last motor bike added close -->
<!--Recent search product-->
@if(count($recent_search_products) > 0)
     <section class="testimonials wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                  <h2 style="color:#000" class="sectionHeading">Recent Search products </h2>
                
                </div>
            </div>
          <div class="row mt-5">
            <div class="col-sm-12">
              <div id="recent_search_products" class="owl-carousel">
   
                <!--last addded Products 1 -->
                @foreach($recent_search_products as $recent_search)
                    <div class="item">
                      <div class="shadow-effect">
                          @if(!empty($recent_search->bike_imgs))
                            <img class="img-responsive " src="{{ url('/')}}/public/images/{{@$recent_search->userid}}/{{@$recent_search->productid}}/{{@$recent_search->bike_imgs}}" style="width:100%;height:245px;object-fit: cover;" alt="" />
                            @else
                            <img class="img-responsive " src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="" />
                          @endif
                          
                        
                        <div class="item-details" style="background:#fff; text-align:center">
                        <h4>{{ @$recent_search->bike_name }} </h4>
                        <h6>{{ @$recent_search->brand_name }} {{ @$recent_search->model_name }}</h6>
                                           
                         </div>
                      </div>
                    </div>
                @endforeach
                
             
              </div>


            </div>
          </div>
          
        </section>
@endif

<!--Recent Search Product end-->
<!-- blog section start -->

 <section class="wow fadeInUp" id="blog">
     <div class="container">
     <div class="row">
         <div class="col-sm-12 text-center">
             <h1 class="blogHeading">Blog</h1>
         </div>
     </div>
     <div class="row">
        <?php $n = 1; ?>
        @foreach ($blogs as $blog)
        <div class="col-sm-6  <?php echo ($n == 2)? 'circleClass' : ''; ?>">
                     <div class="blogGrid">
                      <img src="{{ url('/')}}/public/images/blog_images/{{$blog->id}}/{{$blog->blog_img}}" class="img-fluid mx-auto d-block img-thumbnail">
                     <a href="{{ url('/') }}/blog-description/{{$blog->id}}/{{$blog->slug}}" style="color:#fff; " > <b><h5>{{$blog->title}}</h5></b></a>
                      <p><?php echo str_limit(strip_tags($blog->blog_content), 90); ?></p>
                     </div>
        </div>
        <?php $n++ ?>
        @endforeach
     </div>
     <div class="text-center"><a href="{{ url('/blog')}}" class="btn-hover color-4">Read More Blog</a></div>
     </div> 
 </section>

<!-- blog section close -->

<!-- logo slider start -->
<section class="wow fadeInDown" id="logos">
    <div class="container">
        <div class="row">
         
<div id="logo-slider" class="owl-carousel">
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/aprilia.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Augusta.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/bmw.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Ducati.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/honda.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/kawasaki.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/suzuki.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/triumph.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/yamaha.png"></div>
    </div>
       
</div>
</div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- footer start -->
    @include('common.footer')
<!-- footer close -->

<!-- bootstrap js cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2({theme: "classic"});
});
</script>

<script type="text/javascript">
    $('#brand_id').change(function(){
    var brand_id = $(this).val();    
    if(brand_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-model-list')}}?brand_id="+brand_id,
           success:function(res){               
            if(res){
                $("#model_id").empty();
                $("#model_id").append('<option value=""></option>');
                $.each(res,function(key,value){
                    $("#model_id").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#model_id").empty();
            }
           }
        });
    }else{
        $("#model_id").empty();
        $("#model_id").append('<option value=""></option>');
    }      
   });
   
</script>

</body>
</html>