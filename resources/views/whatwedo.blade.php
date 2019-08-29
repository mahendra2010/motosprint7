<!DOCTYPE html>
<html lang="en">
<head>
<title>Motoblockchain | What we Do</title>

  @include('common.head')
<link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/flaticon.css') }}" rel="stylesheet">
    <style>
        .btn-hover {
            width:150px;
            font-size: 20px;
            line-height: 35px;
            height:40px;
            
        }
        .automobile-testimonialfull {
            background-color: #f2f2f2;
            padding: 100px 0px 130px 0px;
        }
        .automobile-fancy-title {
            float: left;
            width: 100%;
            text-align: center;
            margin: 0px 0px 60px;
        }
        .automobile-testimonial-wrap {
            padding: 0px 29px;
            position: relative;
        }
        .owl-carousel .owl-next, .owl-carousel .owl-prev{top: 63%;}
         h4, h5, p{font-size: 17px;}   
         .h3, h3{font-size: 21px;}
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
                            <h1><span>What We Do</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="automobile-color">What We do</li>
                        </ul>
                    </div>
                </div>
            </div>
      </div>
<div class="automobile-main-content">
<div class="automobile-main-section automobile-about-sevicesfull">
        <div class="container">
          <div class="row">
            
            <div class="col-md-12">
                            <div class="automobile-fancy-title">
                                <h2>The Digital Identity of your Motorcycle</h2>
                                <div class="col-md-12">
                                <p>Imagine to be able creating the Digital Identity of your motorcycle, to make your motorcycle grow over
                                    time and leave a fingerprint of her whole life.</p>
                                   
                                </div>
                                
                                  <div class="col-sm-12">
                                      <img src="{{ url('/') }}/public/frontend/images/what_we_do_bikes.jpg" width="100%">
                                       <h4>Now stop imagine it and start doing it!</h4>
                                    <a href="{{ url('/register') }}" class="btn-hover color-4">Join us</a>
                                  </div>
                            </div>
            </div>
                        
                        <div class="row">
                            <div class="col-sm-4 " align="center">
                                 <img src="{{ url('/')}}/public/frontend/images/history_of_bike.png" width="80px">
                                        <div class="automobile-about-list-text">
                                            <h4>History of your motorcycle </h4>
                                            <p>Keep all the documentation of your motorcycle in one place: revisions, modifications, accessories, preparations, KM, etc.</p>
                                </div>
                            </div>
                             <div class="col-sm-4" align="center">
                                <img src="{{ url('/')}}/public/frontend/images/guaranteed_as_unmodifiable.png" width="80px">
                                        <div class="automobile-about-list-text">
                                            <h4>Guaranteed as unmodifiable</h4>
                                            <p>The innovative Blockchain technology guarantees the upload date and the immutability of the stored documentation</p>
                                        </div>
                            </div>
                             <div class="col-sm-4" align="center">
                                <img src="{{ url('/')}}/public/frontend/images/resale_value.png" width="80px">
                                        <div class="automobile-about-list-text">
                                            <h4>Resale value</h4>
                                            <p>Take advantage of all the information stored to create trust in the buyer during the sales process.
                                            Get a fair price for your motorcycle, your accessories and modifications.</p>
                                        </div>
                            </div>
                        </div>
                         <div class="row" style="padding-top:30px">
                             <img src="{{ url('/')}}/public/frontend/images/moto_bike_b.jpg" class="img-fluid">
                        </div>
             
            
              
          </div>
        </div>
      </div>
     
      <div class="automobile-main-section ">
                <div class="container">
                    
                                <div class="row">
                                    <div class="automobile-fancy-title">
                                    <center><h3 class="automobile-color"><b><u>The Problems</u></b></h3></center>
                                    <h4>We asked to several motorcycle owners about problems that occur in the motorcycle second hand market and we discovered:</h4>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4 " align="center">
                                          <img src="{{ url('/')}}/public/frontend/images/lack_of_trust.png" width="150px">
                                                <div class="automobile-about-list-text">
                                                    <p>The lack of trust between buyer and seller in the second hand motorcycle market </p>
                                        </div>
                                    </div>
                                     <div class="col-sm-4" align="center">
                                        <img src="{{ url('/')}}/public/frontend/images/motorcycle_price.png" width="150px">
                                                <div class="automobile-about-list-text">
                                                    <p>A low motorcycle price in private reselling: this happen also if the owner invested</p>
                                                </div>
                                    </div>
                                     <!--<div class="col-sm-3">
                                        <img src="{{ url('/')}}/public/frontend/images/motorcycle_price.png" width="80px">
                                                <div class="automobile-about-list-text">
                                                    <p>Money and time in taking care of his motorcycle</p>
                                                </div>
                                    </div>-->
                                    <div class="col-sm-4" align="center">
                                        <img src="{{ url('/')}}/public/frontend/images/null_value.png" width="150px">
                                                <div class="automobile-about-list-text">
                                                    <p>A low or null value of motorcycle accessories and modifications in private reselling</p>
                                                </div>
                                    </div>
                                </div>
                                
                                <!--Solution-->
                                <div class="row" style="padding-top:40px;">
                                    <div class="automobile-fancy-title">
                                    <center><h3 class="automobile-color"><b><u>The Solution</u></b></h3></center>
                                    <h5>Motoblockchain is the first platform that helps you in
                                    keeping track of the full history of your motorcycles.
                                    Thanks to our platforms now you can store in our database
                                    every invoice or document related with money or time
                                    invested in your motorcycle: proof of modifications, tuning
                                    or added accessories, history of KM, history of
                                    maintenance, modifications, improvements, etc.
                                    All your documentation is saved into Blockchain:</h5>
                                    </div>
                                    
                     
                            <div class="row">
                                <div class="col-md-1" > </div>
                                    <div class="col-md-5" align="center">
                                        
                                            <img src="{{ url('/')}}/public/frontend/images/unmodifiable.png" width="150px">
                                            <h5 class="automobile-color">Unmodifiable:</h5>
                                            <p>Thanks to this process, every document became unmodifiable, hacker proof.</p>
                                    
                                    </div>
                                    <div class="col-md-5" align="center">
                                            <img src="{{ url('/')}}/public/frontend/images/time_stamp.png" width="150px">
                                            <h5 class="automobile-color">Time Stamped:</h5>
                                            <p>Additionally the Blockchain Time Stamp system guarantee the time and date you saved the
                                                documentation. It cannot be modified, ever.</p>
                                       
                                    </div>
                                    <div class="col-md-1" > </div>
                                </div>
                      
                                    
                                </div>
                                
                                
                           
                </div>
            </div>
            
            
            <div class="automobile-main-section automobile-about-sevicesfull" style="padding-top:90px; padding-bottom:20px;">
                <div class="container">
                    <div class="row">
                        <div class="automobile-fancy-title">
                            <div class="row">
                            <div class="col-sm-4" align="right">
                                <img src="{{ url('/')}}/public/frontend/images/what_we_do_1.png" width="150px">
                            </div>
                            <div class="col-sm-4" align="center">
                                <h3 class="automobile-color"><b> <u> What you gain </u> </b></h3>
                            </div>
                            <div class="col-sm-4" align="left">
                                <img src="{{ url('/')}}/public/frontend/images/what_we_do_2.png" width="130px">
                            </div>
                      </div>
                        <h5>When the time for you to sell your motorcycle arrive (soon or lees it will
                            come, but we are sure you will buy a better one soon!), you will take
                            advantage of all the stored information, by gaining trust from buyers as well
                            as reaching a higher sales price.</h5>
                        </div>
                        <div class="col-sm-12">
                            <center><img src="{{ url('/')}}/public/frontend/images/ilu_moto.jpg" width="80%" class="img-responsive"></center>
                        </div>
                        <div class="automobile-fancy-title">
                        <h5>The Digital Identity created helps you recover the love (and the money too!) you invested in your
                            motorcycle during years and it is inhered by the new owner after that the sales ends.</h5>
                        </div>
                    </div>
                    <div class="row">
                        
                        
                        
                    </div>
                </div>
            </div>
            
            <div class="automobile-main-section automobile-about-sevicesfull" style="padding-top:20px; padding-bottom:20px;">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-sm-12">
                            <img src="{{ url('/')}}/public/frontend/images/moto_questions.jpg" width="100%" class="img-responsive">
                        </div>
                      
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="automobile-main-section " style="background-image:url('{{ url('/')}}/public/frontend/images/banner _f.jpg'); background-position: top center;
    padding: 40px 0px 36px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="automobile-call-to-action1">
                                <h2><span class="automobile-color">Sell</span> a Motorcycle ?</h2>
                                <a href="{{ url('/register')}}" class="icon-arrows-1"></a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="automobile-call-to-action1 automobile-call-to-action2">
                                <h2><span>Buy</span> a Motorcycle?</h2>
                                <a href="{{ url('/register')}}" class="icon-arrows-1"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="automobile-main-section automobile-testimonialfull">
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="automobile-fancy-title">
                           <h2>our <span>testimonials</span></h2>
                           <span>See why clients love us.</span>
                        </div>
                        <div id="whatwedo-testimonials" class="owl-carousel">
                                 <?php 
                                 if(count($testimonial)>0)
                                 {
                                     $i=-3;
                                 
                                    foreach($testimonial as $testimonails)
                                    {
                                        $i++;
                                        $slide='';
                                        if($i ==-2 || $i== -1 || $i== 3 || $i==4)
                                        {
                                            
                                           $slick_cloned_class = "automobile-testimonial-layer slick-slide slick-cloned"; 
                                        }
                                        elseif($i==1)
                                        {
                                            $slick_cloned_class = "automobile-testimonial-layer slick-slide slick-current slick-active";
                                            $slide= ' role="option" aria-describedby="slick-slide11" ';
                                        }elseif($i==2)
                                        {
                                            $slick_cloned_class = "automobile-testimonial-layer slick-slide slick-active";
                                            $slide= 'role="option" aria-describedby="slick-slide12"';
                                        }else{
                                            $slick_cloned_class='automobile-testimonial-layer slick-slide';
                                            $slide= 'role="option" aria-describedby="slick-slide12" ';
                                        }
                                        
                                        if($i==1 || $i==2)
                                        {
                                            $hidden ="false";
                                        }else{
                                            $hidden ="true";
                                        }
                                        
                                        
                                    ?>
                                        <div class="item">
                                            <div class="shadow-effect">
                                            <div class="automobile-testimonial">
                                               <figure><img src="{{ url('/')}}/public/images/default_images/default_user.png" alt=""></figure>
                                               <div class="automobile-testimonial-text">
                                                  <h5 class="automobile-color"> {{ $testimonails->client_name }}</h5>
                                                  <span>Purchased a <strong class="automobile-color"> {{ $testimonails->product_name }}</strong></span>
                                                 <!-- <div class="star-rating eighty"><span class="star-rating-box"></span></div>-->
                                               </div>
                                               <p>{{ $testimonails->message}}</p>
                                            </div>
                                            </div>
                                         </div>
                                         <?php
                                    }
                                 }
                                 ?>
                                 
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            
            
</div>
            </div>
            <!--// Main Section \\-->
    <div class="clearfix"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- footer start -->
 @include('common.footer')
<!-- footer close -->
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
                $("#region").append('<option>Select</option>');
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
</body>
</html>