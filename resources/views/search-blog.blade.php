<?php
use \App\Http\Controllers\BlogController;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="icon" href="{{ url('/')}}/public/frontend/images/fevi.png" sizes="16x16">
<title>Blogs  |Motoblockchain</title>
 <!-- font -->
 <link href="https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700" rel="stylesheet">
 <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- bootstrap cdn css -->
 <!-- slider footer -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- End slider footer -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ url('/')}}/public/frontend/css/style.css">
<link rel="stylesheet" href="{{ url('/')}}/public/frontend/css/animate.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.1/assets/owl.carousel.min.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/style.css">
<link rel="stylesheet" href="{{ url('/')}}/public/css/blog-description.css">

</head>
<body class="animated fadeIn">
<!-- header start -->
     @include('common.header')
<!-- header close -->
  <div class="automobile-main-wrapper">
      <div class="automobile-subheader" style="background: #fff;">
            <div class="automobile-subheader-image">
                <span class="automobile-dark-transparent"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                           <!-- <span>Our Blog</span>-->
                            <h1>Our Blog</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{ url('/')}}">Home</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                             <li><a href="{{ url('/')}}">Blogs</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></li>
                            <li class="automobile-color"> Search Result</li>
                        </ul>
                    </div>
                </div>
            </div>
      </div>
      <!--Content-->
      <div class="automobile-main-content">

			<!--// Main Section \\-->
			<div class="automobile-main-section">
				<div class="container">
					<div class="row">

                        <!--// SideBaar \\-->
                        <aside class="col-md-3">

                          <!--// Widget Search \\-->
                          <div class="widget widget_search">
                              <form  method="GET" >
                                  <label>Find Your Search:</label>
                                 {{ csrf_field() }}
                                  <input type="text" placeholder="Search" name="search_item" id="search_item" required>
                                  <input type="hidden"  name="base_url" id="base_url"  value="{{ url('/')}}" required>
                                  <label>
                                      <input type="submit" id="search_btn" value="">
                                  </label>
                              </form>
                          </div>
        
                          <!--// Widget Video Post \\-->
                          
                          <!--// Widget Video Post \\-->
        
                          <!--// Widget Recent Post \\-->
                          <div class="widget widget_recent_post">
                              <div class="automobile-widget-heading"><h2>Recent Posts</h2><i class="fa fa-angle-down"></i></div>
                              <ul>
                                  @foreach($recent_blogs as $recent)
                                    <li><a href="{{ url('/blog-description'.'/'.$recent->id.'/'.$recent->slug)}}"> {{ $recent->title}}</a></li>
                                  @endforeach
                                  
                              </ul>
                          </div>
                          <!--// Widget Recent Post \\-->
        
                          <!--// Widget Recent Post \\-->
                          <div class="widget widget_archive">
                              <div class="automobile-widget-heading"><h2>TAGS</h2><i class="fa fa-angle-down"></i></div>
                              
                                  @foreach($blog_tags as $tag)
                                    <a href="{{ url('/')}}/search-blog/{{ $tag->id }}"><span class="badge badge-warning">{{ $tag->tag_name}},</span> </a>
                                  @endforeach
                                  
                                 
                              
                          </div>
                          <!--// Widget Recent Post \\-->
        
                          <!--// Widget Trading Post \\-->
                          <div class="widget widget_trading_post">
                              <div class="automobile-widget-heading"><h2>Top 5 posts</h2><i class="fa fa-angle-down"></i></div>
                              <ul>
                                  @php
                                    $i=1;
                                    @endphp
                                 
                                   @foreach($random_blogs as $random)
                                  
                                    <li>
                                      <figure><a href="{{ url('/blog-description'.'/'.$random->id.'/'.$random->slug)}}"><img src="{{url('/')}}/public/images/blog_images/{{$random->id}}/{{$random->blog_img}}" alt=""></a><span class="automobile-bgcolor"> {{ $i++ }} </span></figure>
                                      <div class="widget-trading-post-text">
                                          <p style="margin-block-start: 0em; "><a href="{{ url('/blog-description'.'/'.$random->id.'/'.$random->slug)}}"> {{$random->title }} </a></p>
                                          <p style="margin-block-start: 0em; "><a href="{{ url('/blog-description'.'/'.$random->id.'/'.$random->slug)}}" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>Read More</a></p>
                                      </div>
                                  </li>
                                  
                                  @endforeach
                                  
                                  
                              </ul>
                          </div>
                         
                      </aside>
                        <!--// SideBaar \\-->
						
						<div class="col-md-9">
                            <div class="automobile-blog automobile-medium-blog">
                                <ul class="row">
                                    @if(count($blogs) > 0)
                                        @foreach($blogs as $blog)
                                        <li class="col-md-12">
                                            <figure><a href="{{ url('/') }}/blog-description/{{$blog->id}}/{{$blog->slug}}"><img src="{{ url('/')}}/public/images/blog_images/{{$blog->id}}/{{$blog->blog_img}}" alt=""></a></figure>
                                            <div class="automobile-medium-blog-text">
                                                <div class="automobile-social-tag">
                                                    <i class="automobile-color fa fa-folder-open"></i>
                                                    <?php 
                                                        $tagss = $blog->tags ;
                                                        $myArray = explode(',', $tagss);
                                                        foreach($myArray as $my_Array){ ?>
                                                            
                                                           <a href="{{ url('/')}}/search-blog/{{ $my_Array }}"> {{ @BlogController::tag_name($my_Array) }}, </a>
                                                        <?php
                                                        }
                                                      ?>
                                                
                                                </div>
                                               <ul class="automobile-blog-post-comment">
                                                    <li>
                                                        <i class="automobile-color fa fa-clock-o"></i>
                                                        <small>{{ date(' jS F', strtotime($blog->created_at) )  }}</small> 
                                                    </li>
                                                </ul>
                                                <h4><a href="{{ url('/') }}/blog-description/{{$blog->id}}/{{$blog->slug}}">{{ $blog->title}}</a></h4>
                                                 <p><?php echo substr($blog->blog_content, 0, 100); ?>..</p>
                                                <a href="{{ url('/') }}/blog-description/{{$blog->id}}/{{$blog->slug}}" class="automobile-read-btn">read article</a>
                                            </div>
                                        </li>
                                        
                                        @endforeach
                                        @else
                                         <li class="col-md-12">
                                             <br>
                                            <center><h2>No Blogs Found</h2></center> 
                                         </li>
                                    @endif
                                    
                                    <li class="col-sm-12">
                                        <div class="automobile-section-heading"><h2 class="automobile-color">Related Posts</h2></div>
                                    </li>
                                    
                                    @if(count($recent_blogs))
                                        @foreach($recent_blogs_bottom as $recent)
                                             <li class="col-md-12">
                                                <figure><a href="{{ url('/') }}/blog-description/{{$recent->id}}/{{$recent->slug}}"><img src="{{ url('/')}}/public/images/blog_images/{{$recent->id}}/{{$recent->blog_img}}" alt=""></a></figure>
                                                <div class="automobile-medium-blog-text">
                                                    <div class="automobile-social-tag">
                                                        <i class="automobile-color fa fa-folder-open"></i>
                                                        <?php 
                                                            $tagss = $recent->tags ;
                                                            $myArray = explode(',', $tagss);
                                                            foreach($myArray as $my_Array){ ?>
                                                                
                                                               <a href="{{ url('/')}}/search-blog/{{ $my_Array }}"> {{ @BlogController::tag_name($my_Array) }}, </a>
                                                            <?php
                                                            }
                                                          ?>
                                                    
                                                    </div>
                                                   <ul class="automobile-blog-post-comment">
                                                        <li>
                                                            <i class="automobile-color fa fa-clock-o"></i>
                                                            <small> {{ date(' jS F', strtotime($recent->created_at) )  }}</small>
                                                        </li>
                                                    </ul>
                                                    <h4><a href="#">{{ $recent->title}}</a></h4>
                                                     <p><?php echo substr($blog->blog_content, 0, 100); ?>..</p>
                                                    <a href="{{ url('/') }}/blog-description/{{$recent->id}}/{{$recent->slug}}" class="automobile-read-btn">read article</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                   
                                    
                                </ul>
                            </div>
                            <!--// Pagination \\-->
                            
                                <div class="automobile-pagination">
                                
                                  <span style="padding-top:10px"> <small class="automobile-color">{{ $blogs->links() }}</small></span>
                                </div>
                            
                            <!--// Pagination \\-->
                        </div>

					</div>
				</div>
			</div>
			<!--// Main Section \\-->

		</div>
		<!--// Main Content \\-->
      
      
      <!--End-->
  </div>
<div class="clearfix"></div>

<!-- footer start -->
    @include('common.footer')
<!-- footer close -->

<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.js"></script>
<script>
$('.owl-carousel').owlCarousel({
  autoplay: true,
  autoplayHoverPause: true,
  loop: true,
  margin: 20,
  responsiveClass: true,
  nav: true,
  loop: true,
  responsive: {
    0: {
      items: 1
    },
    568: {
      items: 2
    },
    600: {
      items: 3
    },
    1000: {
      items: 4
    }
  }
})
$(document).ready(function() {
  $('.popup-youtube, .popup-text').magnificPopup({
    disableOn: 320,
    type: 'image',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: true
  });
});
$(document).ready(function() {
  $('.popup-text').magnificPopup({
    type: 'inline',
    preloader: false,
    focus: '#name',
    callbacks: {
      beforeOpen: function() {
        if ($(window).width() < 700) {
          this.st.focus = false;
        } else {
          this.st.focus = '#name';
        }
      },
    buildControls: function() {
      this.contentContainer.append(this.arrowLeft.add(this.arrowRight));
    }

    }
  });
});
</script>

<script>
    $("#search_btn").click(function(event) {
         
          event.preventDefault();
           var search = $('#search_item').val();
           var base_url = $('#base_url').val();
            var url = base_url+"/search-blog/"+search;
             //alert(url);
              window.location.href = url;
             
                
            });
</script>


</body>
</html>