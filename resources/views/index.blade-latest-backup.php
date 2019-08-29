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
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- bootstrap cdn css -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ url('/')}}/public/frontend/css/style.css">
<link rel="stylesheet" href="{{ url('/')}}/public/frontend/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css">

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
        <img class="img-fluid" src="{{ url('/')}}/public/frontend/images/banner.png" />
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
               <h2>Now You can gift to your Motorcycle a Digital that prove  <br/> how much you took care of her.</h2>
             <div class="col-sm-8 mx-auto">
               <ul class="list-inline">
               <li>    
               <a class="giftBtn" href="#">I want to gift a Digital To my Motorcycle, for Free <i class="fa fa-angle-right" aria-hidden="true"></i></a>
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
            <div class="col-sm-12 mt-5 mb-5">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                     been the industry's standard dummy text ever since the 1500s, when an unknown printer took 
                     a galley of type and scrambled it to make a type specimen book. It has survived not only five
                      centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release 
                      of Letraset sheets containing Lorem Ipsum passages, and more recently </p>
            </div>
            <div class="col-sm-10 mx-auto">
                    <ul class="list-inline">
                            <li>    
                            @if(empty(Auth::user()->id))
                            <a class="giftBtn" href="{{ url('/register') }}">Sign Up for free</a>
                            @endif
                            
                            </li>
                            <li>  
                                    <div class="btn-group border-ra col">
                                            <button type="button" class="giftBtn">Search</button>
                                            <button style="background:#e42324" type="button" class="giftBtn">Search a Used Motorcycle</button>
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
        <div class="row">
            <div class="col-sm-12 formBg">
                    <ul class="nav nav-pills" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="pill" href="#home">Search Option</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="pill" href="#menu1">By Make</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="pill" href="#menu2">Type</a>
                            </li>
                            <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#menu3">By State</a>
                            </li>
                          </ul>
                        
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div id="home" class="container tab-pane active"><br>
                             <div class="row">
                                 <div class="col">
                                     <div class="row mt-4">
                                       <div class="col">
                                           <label>Type</label>
                                            <input type="text" class="form-control" placeholder="Select Type">
                                       </div>
                                       <div class="col">
                                           <label>Make By</label>
                                            <input type="text" class="form-control" placeholder="Select Make">
                                       </div>
                                     </div>
                                     <div class="row mt-4">
                                         <div class="col">
                                             <label>Zip</label>
                                         <input type="text" class="form-control" placeholder="Enter Zip">
                                        </div>
                                        <div class="col">
                                            <div style="align-items:flex-end" class="row">
                                                <div class="col-6 col-sm-6">
                                                        <label for="sel1">Year</label>
                                                        <select class="form-control" id="sel1">
                                                            <option selected>From Year</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                        </select>
                                                 </div>
                                                <div class="col-6 col-sm-6">
                                                    <select class="form-control" id="sel1">
                                                        <option selected>To Year</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row mt-4">
                                          <div class="col">
                                              <label>Search By Keywords</label>
                                                <input type="text" class="form-control" placeholder="Search By Keywords">
                                          </div>
                                      </div>
                                      <div class="row mt-4">
                                          <div class="col-sm-4 mx-auto">
                                            <button class="giftBtn">Search</button>
                                          </div>
                                      </div>
                                 </div>
                             </div>
                            </div>
                            <div id="menu1" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-4">
                                          <div class="col">
                                              <label>Type</label>
                                               <input type="text" class="form-control" placeholder="Select Type">
                                          </div>
                                          <div class="col">
                                              <label>Make By</label>
                                               <input type="text" class="form-control" placeholder="Select Make">
                                          </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <label>Zip</label>
                                            <input type="text" class="form-control" placeholder="Enter Zip">
                                           </div>
                                           <div class="col">
                                               <div style="align-items:flex-end" class="row">
                                                   <div class="col-6 col-sm-6">
                                                           <label for="sel1">Year</label>
                                                           <select class="form-control" id="sel1">
                                                               <option selected>From Year</option>
                                                               <option>2</option>
                                                               <option>3</option>
                                                               <option>4</option>
                                                           </select>
                                                    </div>
                                                   <div class="col-6 col-sm-6">
                                                       <select class="form-control" id="sel1">
                                                           <option selected>To Year</option>
                                                           <option>2</option>
                                                           <option>3</option>
                                                           <option>4</option>
                                                       </select>
                                                   </div>
                                               </div>
                                           </div>
                                         </div>
                                         <div class="row mt-4">
                                             <div class="col">
                                                 <label>Search By Keywords</label>
                                                   <input type="text" class="form-control" placeholder="Search By Keywords">
                                             </div>
                                         </div>
                                         <div class="row mt-4">
                                             <div class="col-sm-4 mx-auto">
                                               <button class="giftBtn">Search</button>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu2" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-4">
                                          <div class="col">
                                              <label>Type</label>
                                               <input type="text" class="form-control" placeholder="Select Type">
                                          </div>
                                          <div class="col">
                                              <label>Make By</label>
                                               <input type="text" class="form-control" placeholder="Select Make">
                                          </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <label>Zip</label>
                                            <input type="text" class="form-control" placeholder="Enter Zip">
                                           </div>
                                           <div class="col">
                                               <div style="align-items:flex-end" class="row">
                                                   <div class="col-6 col-sm-6">
                                                           <label for="sel1">Year</label>
                                                           <select class="form-control" id="sel1">
                                                               <option selected>From Year</option>
                                                               <option>2</option>
                                                               <option>3</option>
                                                               <option>4</option>
                                                           </select>
                                                    </div>
                                                   <div class="col-6 col-sm-6">
                                                       <select class="form-control" id="sel1">
                                                           <option selected>To Year</option>
                                                           <option>2</option>
                                                           <option>3</option>
                                                           <option>4</option>
                                                       </select>
                                                   </div>
                                               </div>
                                           </div>
                                         </div>
                                         <div class="row mt-4">
                                             <div class="col">
                                                 <label>Search By Keywords</label>
                                                   <input type="text" class="form-control" placeholder="Search By Keywords">
                                             </div>
                                         </div>
                                         <div class="row mt-4">
                                             <div class="col-sm-4 mx-auto">
                                               <button class="giftBtn">Search</button>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <div id="menu3" class="container tab-pane fade"><br>
                                <div class="row">
                                    <div class="col">
                                        <div class="row mt-4">
                                          <div class="col">
                                              <label>Type</label>
                                               <input type="text" class="form-control" placeholder="Select Type">
                                          </div>
                                          <div class="col">
                                              <label>Make By</label>
                                               <input type="text" class="form-control" placeholder="Select Make">
                                          </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col">
                                                <label>Zip</label>
                                            <input type="text" class="form-control" placeholder="Enter Zip">
                                           </div>
                                           <div class="col">
                                               <div style="align-items:flex-end" class="row">
                                                   <div class="col-6 col-sm-6">
                                                           <label for="sel1">Year</label>
                                                           <select class="form-control" id="sel1">
                                                               <option selected>From Year</option>
                                                               <option>2</option>
                                                               <option>3</option>
                                                               <option>4</option>
                                                           </select>
                                                    </div>
                                                   <div class="col-6 col-sm-6">
                                                       <select class="form-control" id="sel1">
                                                           <option selected>To Year</option>
                                                           <option>2</option>
                                                           <option>3</option>
                                                           <option>4</option>
                                                       </select>
                                                   </div>
                                               </div>
                                           </div>
                                         </div>
                                         <div class="row mt-4">
                                             <div class="col">
                                                 <label>Search By Keywords</label>
                                                   <input type="text" class="form-control" placeholder="Search By Keywords">
                                             </div>
                                         </div>
                                         <div class="row mt-4">
                                             <div class="col-sm-4 mx-auto">
                                               <button class="giftBtn">Search</button>
                                             </div>
                                         </div>
                                    </div>
                                </div>
                              </div>
                          </div>    
            </div>
        </div>
    </div>
</section>
<!-- search section close -->

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
                            <img class="img-responsive " src="{{ url('/')}}/public/images/{{$last_bike->user_id}}/{{$last_bike->id}}/{{$last_bike->bike_imgs}}" style="width:100%; height:245px;
    object-fit: cover;" alt="">
                            @else
                            <img class="img-responsive " src="{{ url('/')}}/public/images/default_images/default_bike.png" alt="">
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
                <!--TESTIMONIAL 2 -->
                <div class="item">
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
                </div>
                <!--END OF TESTIMONIAL 2 -->
                <!--TESTIMONIAL 3 -->
                <div class="item">
                  <div class="shadow-effect">
                    <img class="img-responsive" src="{{ url('/')}}/public/frontend/images/image-3.png" alt="">
                    <div class="item-details">
                            <h5>Yamaha FZ1 Fazer 2011</h5>
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
                </div>
                <!--END OF TESTIMONIAL 3 -->
                <div class="item">
                        <div class="shadow-effect">
                          <img class="img-responsive" src="{{ url('/')}}/public/frontend/images/image-3.png" alt="">
                          <div class="item-details">
                                  <h5>Yamaha FZ1 Fazer 2011</h5>
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
                      </div>
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
                     <a href="{{ url('/') }}/blog-description/{{$blog->slug}}" style="color:#fff; " > <b><h5>{{$blog->title}}</h5></b></a>
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
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Yamaha-logo.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Yamaha-logo.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Yamaha-logo.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Yamaha-logo.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Hyundai_Motor.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Yamaha-logo.png"></div>
        <div class="item"><img src="{{ url('/')}}/public/frontend/images/Hyundai_Motor.png"></div>
    </div>
       
</div>
</div>
</section>
<!-- logo slider close -->

<!-- footer start -->
    @include('common.footer')
<!-- footer close -->

<!-- bootstrap js cdn -->

</body>
</html>