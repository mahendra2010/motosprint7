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
<title>brhtym |Motoblockchain</title>
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
                            <span>Our Blog</span>
                            <h1>jhghfjh</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{ url('/')}}">Home</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
</li>
                            <li><a href="{{ url('blog')}}">Blog</a> <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
</li>
                            <li class="automobile-color">Single Post</li>
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
                                <form>
                                    <label>Find Your Search:</label>
                                    <input type="text" value="Keyword" onblur="if(this.value == '') { this.value ='Keyword'; }" onfocus="if(this.value =='Keyword') { this.value = ''; }">
                                    <label>
                                        <input type="submit" value="">
                                    </label>
                                </form>
                            </div>
                            <!--// Widget Search \\-->

                            <!--// Widget Contact \\-->

                            <div class="widget widget_contact">
                                <div class="automobile-widget-heading"><h2>Do you have a question?</h2></div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque convallis.</p>
                                <a href="contact-us.html" class="widget-contact-btn automobile-bgcolor">contact us</a>
                            </div>

                            <!--// Widget Contact \\-->

                            <!--// Widget Video Post \\-->
                            <div class="widget widget_video_post">
                                <div class="automobile-widget-heading"><h2>Video posts</h2><i class="fa fa-angle-down"></i></div>
                                <ul>
                                    <li>
                                        <figure><a href="listing-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/video-widget-img1.jpg" alt=""><i class="fa fa-play-circle"></i></a></figure>
                                        <div class="widget-video-post-text">
                                            <h6><a href="listing-detail.html">How to Properly Wash a Tire</a></h6>
                                            <a href="listing-detail.html" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>View Video</a>
                                        </div>
                                    </li>
                                    <li>
                                        <figure><a href="listing-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/video-widget-img2.jpg" alt=""><i class="fa fa-play-circle"></i></a></figure>
                                        <div class="widget-video-post-text">
                                            <h6><a href="listing-detail.html">How to Properly Wash a Tire</a></h6>
                                            <a href="listing-detail.html" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>View Video</a>
                                        </div>
                                    </li>
                                    <li>
                                        <figure><a href="listing-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/video-widget-img3.jpg" alt=""><i class="fa fa-play-circle"></i></a></figure>
                                        <div class="widget-video-post-text">
                                            <h6><a href="listing-detail.html">How to Properly Wash a Tire</a></h6>
                                            <a href="listing-detail.html" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>View Video</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--// Widget Video Post \\-->

                            <!--// Widget Recent Post \\-->
                            <div class="widget widget_recent_post">
                                <div class="automobile-widget-heading"><h2>recent posts</h2><i class="fa fa-angle-down"></i></div>
                                <ul>
                                    <li><a href="blog-detail.html">Is the career in car sales right for me?</a></li>
                                    <li><a href="blog-detail.html">Can I work part time/as a summer job or weekends?</a></li>
                                    <li><a href="blog-detail.html">How to get a job in car sales?</a></li>
                                    <li><a href="blog-detail.html">How do car salespeople get paid?</a></li>
                                </ul>
                            </div>
                            <!--// Widget Recent Post \\-->

                            <!--// Widget Recent Post \\-->
                            <div class="widget widget_archive">
                                <div class="automobile-widget-heading"><h2>Archive</h2><i class="fa fa-angle-down"></i></div>
                                <ul>
                                    <li><a href="404.html"><i class="icon-arrows-1 automobile-color"></i>January, 2016</a></li>
                                    <li><a href="404.html"><i class="icon-arrows-1 automobile-color"></i>February, 2016 </a></li>
                                    <li><a href="404.html"><i class="icon-arrows-1 automobile-color"></i>March, 2016 </a></li>
                                    <li><a href="404.html"><i class="icon-arrows-1 automobile-color"></i>April, 2016</a></li>
                                    <li><a href="404.html"><i class="icon-arrows-1 automobile-color"></i>May, 2016 </a></li>
                                </ul>
                            </div>
                            <!--// Widget Recent Post \\-->

                            <!--// Widget Trading Post \\-->
                            <div class="widget widget_trading_post">
                                <div class="automobile-widget-heading"><h2>top 3 posts</h2><i class="fa fa-angle-down"></i></div>
                                <ul>
                                    <li>
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/trading-post-img1.jpg" alt=""></a><span class="automobile-bgcolor">1</span></figure>
                                        <div class="widget-trading-post-text">
                                            <h6><a href="blog-detail.html">Scariest Car & Truck  Recalls</a></h6>
                                            <a href="blog-detail.html" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>Read More</a>
                                        </div>
                                    </li>
                                    <li>
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/trading-post-img2.jpg" alt=""></a><span class="automobile-bgcolor">2</span></figure>
                                        <div class="widget-trading-post-text">
                                            <h6><a href="blog-detail.html">Toyota Transmission  Help</a></h6>
                                            <a href="blog-detail.html" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>Read More</a>
                                        </div>
                                    </li>
                                    <li>
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/trading-post-img3.jpg" alt=""></a><span class="automobile-bgcolor">3</span></figure>
                                        <div class="widget-trading-post-text">
                                            <h6><a href="blog-detail.html">Ignition Timing and Adjustment DIY</a></h6>
                                            <a href="blog-detail.html" class="video-post-btn automobile-color"><i class="icon-arrows-1"></i>Read More</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--// Widget Trading Post \\-->

                        </aside>
                        <!--// SideBaar \\-->
						
						<div class="col-md-9">
                            <div class="automobile-blog automobile-medium-blog">
                                <ul class="row">
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img1.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Cars,</a>
                                                <a href="404.html">Motors,</a>
                                                <a href="404.html">Functions</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">5</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">More Airbag Recalls to Look  At the vehicle</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img2.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Mechanics,</a>
                                                <a href="404.html">Vehicle</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">21</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">How to Test a Car Stereo’s Amplifier</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img3.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Cars,</a>
                                                <a href="404.html">Motors,</a>
                                                <a href="404.html">Functions</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">5</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">More Airbag Recalls to Look  At the vehicle</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img4.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Mechanics,</a>
                                                <a href="404.html">Vehicle</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">21</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">How to Test a Car Stereo’s Amplifier</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img5.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Cars,</a>
                                                <a href="404.html">Motors,</a>
                                                <a href="404.html">Functions</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">5</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">More Airbag Recalls to Look  At the vehicle</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img6.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Mechanics,</a>
                                                <a href="404.html">Vehicle</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">21</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">How to Test a Car Stereo’s Amplifier</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                    <li class="col-md-12">
                                        <figure><a href="blog-detail.html"><img src="http://webmarce.com/html/accelerator/extra-images/related-blog-img7.jpg" alt=""></a></figure>
                                        <div class="automobile-medium-blog-text">
                                            <div class="automobile-social-tag">
                                                <i class="automobile-color fa fa-folder-open"></i>
                                                <a href="404.html">Cars,</a>
                                                <a href="404.html">Motors,</a>
                                                <a href="404.html">Functions</a>
                                            </div>
                                            <ul class="automobile-blog-post-comment">
                                                <li>
                                                    <i class="automobile-color fa fa-comments-o"></i>
                                                    <a href="404.html">5</a>
                                                </li>
                                            </ul>
                                            <h4><a href="blog-detail.html">More Airbag Recalls to Look  At the vehicle</a></h4>
                                            <p>If your stereo system is giving you the silent for it treatment, you don’t have to participate.</p>
                                            <a href="blog-detail.html" class="automobile-read-btn">read article</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!--// Pagination \\-->
                            <div class="automobile-pagination">
                              <ul class="page-numbers">
                                 <li><a class="previous page-numbers" href="404.html"><span aria-label="Next"><i class="icon-arrows23"></i></span></a></li>
                                 <li><a class="next page-numbers" href="404.html"><span aria-label="Next"><i class="icon-right-arrow"></i></span></a></li>
                              </ul>
                              <span>Page 1 of <small class="automobile-color">14</small></span>
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


</body>
</html>