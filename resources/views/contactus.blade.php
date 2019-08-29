
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Motoblockchain | Registration</title>
  <!-- end top css/js scripts -->
<link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/flaticon.css') }}" rel="stylesheet">

  @include('common.head')

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
                            <h1><span>Contact Us</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li class="automobile-color">Contact Us</li>
                        </ul>
                    </div>
                </div>
            </div>
      </div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d195532.33382855778!2d-3.210060975601107!3d40.02647652861449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4283e5c586a0f9%3A0x8c2785342c376c8f!2s16400+Taranc%C3%B3n%2C+Cuenca%2C+Spain!5e0!3m2!1sen!2sin!4v1561117078393!5m2!1sen!2sin" style="width: 100%;min-width: 100%; max-width: 100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            <!--// Main Section \\-->
            <div class="automobile-main-section" style="padding-top: 20px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-9">
                            <div class="automobile-section-heading">
                                <h2 class="automobile-color">Get In Touch</h2>
                            </div>
                            <div class="automobile-contact-us-text">
                                <p>You can contact us any way that is convenient for you. We are available 24/7 via fax or email. You can also use a quick contact form below or visit our office personally.<strong> We would be happy to answer your questions.</strong></p>
                                <ul>
                                    <li>
                                        <i class="icon-telephone3"></i>
                                        <div class="automobile-contact-info">
                                            <h4>Phone Numbers:</h4>
                                            <span>(012) 345 - 6789</span>
                                            <span>(012) 762 - 8622</span>
                                        </div>
                                    </li>
                                    <li>
                                        <i class="icon-web5"></i>
                                        <div class="automobile-contact-info">
                                            <h4>Email Addresses:</h4>
                                            <a href="mailto:yourdomain@name.com">info@accelerator.com</a>
                                            <a href="mailto:yourdomain@name.com">support@accelerator.com</a>
                                        </div>
                                    </li>
                                </ul>
                            </div> 
                            
                            <div class="automobile-contact-us-form">
                              
                                
                        
                                <div class="automobile-section-heading"><h2 class="automobile-color">Fill The Form</h2>
                               
                                 @if(session('info'))
					
                        					<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              	{{ session('info') }}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                    @elseif(session('success_info'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                              	{{ session('success_info') }}
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                        		@endif
                        		
                                </div>
                                <form action="{{ url('/contact_us')}}" method="post"  class="was-validated">
                                    {{ csrf_field() }}
                                    <ul>
                                        <li>
                                            <input  class="form-control" name="name" placeholder="Your Name" tabindex="0" type="text" required>
                                        </li>
                                         <li>
                                            <input  class="form-control" name="email" placeholder="Your Email" tabindex="0" type="email" required>
                                        </li>
                                         <li >
                                            <input  class="form-control"  name="phone" placeholder="Your Phone" tabindex="0" type="text" required>
                                        </li>
                                        <li >
                                            <input class="form-control"  name="website" placeholder="Your Website (optional)" tabindex="0" type="text">
                                        </li>
                                        
                                        <li class="full-section">
                                            <textarea  name="message" class="form-control" placeholder="Write Your message here" required></textarea>
                                        </li>
                                        <li>
                                            
                                        <input type="submit" style="line-height: inherit;" class="btn-hover color-4" value="CONTACT US">
                        
                                        </li>
                                    </ul>
                                </form>
                            </div>  
                        </div>

                        <aside class="col-md-4 col-lg-3">

                            <!--// Widget social_follow \\-->
                            <div class="widget widget_social_follow">
                                <div class="automobile-section-heading">
                                    <h2 class="automobile-color">Follow Us</h2>
                                </div>
                                <div class="automobile-blog-social">
                                    <ul>
                                        <li><a href="https://www.facebook.com/" class="fa fa-facebook"></a></li>
                                        <li><a href="https://twitter.com/login" class="fa fa-twitter"></a></li>
                                        <li><a href="https://www.rss.com/login" class="fa fa-rss"></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!--// Widget social_follow \\-->

                            <!--// Widget widget_address \\-->
                            <div class="widget widget_address">
                                <div class="automobile-section-heading"><h2 class="automobile-color">Address</h2></div>
                                <i class="icon-pin2"></i>
                                <span>3258 Margaret Street Houston, TX 77026</span>
                            </div>
                            <!--// Widget widget_address \\-->

                            <!--// Widget working_hours \\-->
                            <div class="widget widget_working_hours mb-4 clearfix">
                                <div class="automobile-section-heading mt-4">
                                     <h2 class="automobile-color">Working Hours</h2>
                                </div>
                                <ul>
                                    <li>Monday  <time datetime="2008-02-14 20:00">8:00am - 8:00pm</time></li>
                                    <li>Tuesday <time datetime="2008-02-14 20:00">8:00am - 8:00pm</time></li>
                                    <li>Wednesday  <time datetime="2008-02-14 20:00">8:00am - 8:00pm</time></li>
                                    <li>Thursday  <time datetime="2008-02-14 20:00">8:00am - 8:00pm</time></li>
                                    <li>Friday  <time datetime="2008-02-14 20:00">8:00am - 9:00pm</time></li>
                                    <li>Saturday  <time datetime="2008-02-14 20:00">9:00am - 5:00pm</time></li>
                                    <li>Sunday  <time datetime="2008-02-14 20:00">Closed</time></li>
                                </ul>
                            </div>
                            <!--// Widget working_hours \\-->
                        </aside>
                    </div>
                </div>
            </div>
            <!--// Main Section \\-->
    <div class="clearfix"></div>
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