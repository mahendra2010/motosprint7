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
<title>{{$blogs->title}} |Motoblockchain</title>
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
                            <h1>{{$blogs->title}}</h1>
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
      <div class="automobile-main-content" style="background: #fff;">
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
                        <a href="{{ url('/')}}/search-blog/{{ $tag->id }}"><span class="badge badge-warning"> {{ $tag->tag_name}}</span></a>
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
                  <figure class="automobile-single-post-thumb">
                      <!--<img src="http://webmarce.com/html/accelerator/extra-images/blog-single-post-thumb.jpg" alt="">-->
                      <img src="{{ url('/')}}/public/images/blog_images/{{$blogs->id}}/{{$blogs->blog_img}}" alt="" style="max-height: 470px; object-fit: cover;">
                      </figure>
                  <div class="automobile-single-post-tag">
                      <div class="automobile-social-tag">
                          <i class="automobile-color fa fa-folder-open"></i>
                          <?php 
                            $tagss = $blogs->tags ;
                            $myArray = explode(',', $tagss);
                            foreach($myArray as $my_Array){ ?>
                                
                               <a href="{{ url('/')}}/search-blog/{{ $my_Array }}"> {{ @BlogController::tag_name($my_Array) }}, </a>
                            <?php
                            }
                          ?>
                         
                      </div>
                      <ul class="automobile-blog-post-comment">
                          <li>
                              <i class="automobile-color fa fa-comments-o"></i>
                              <a href="void:javascript(0)">{{ count($blog_comments) }} Comments</a>
                          </li>
                      </ul>
                  </div>
                  <div class="automobile-rich-editor">
                      <time datetime="2008-02-14 20:00" style="font-size: 35px;">{{ date(' jS ', strtotime($blogs->created_at) )  }}<span>{{ date('F', strtotime($blogs->created_at) )   }}</span></time>
                      <div class="automobile-blog-heading">
                          <h3>{{$blogs->title}}</h3>
                      </div>
                      <?php echo $blogs->blog_content; ?>
                  </div>
                  <div class="automobile-post-tags">
                      <div class="automobile-social-tag">
                          <i class="automobile-color fa fa-folder-open"></i>
                           <?php 
                            $tagss = $blogs->tags ;
                            $myArray = explode(',', $tagss);
                            foreach($myArray as $my_Array){ ?>
                                
                               <a href="{{ url('/')}}/search-blog/{{ $my_Array }}"> {{ @BlogController::tag_name($my_Array) }}, </a>
                            <?php
                            }
                          ?>
                      </div>
                      <div class="automobile-blog-social">
                          <span>Share On:</span>
                          <?php  $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                           
                          ?>
                          <ul>
                              <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?= $actual_link ?>" target="_blank" class="fa fa-facebook"></a></li>
                              <li><a href="http://twitter.com/share?text=@motoblockchain&url=<?= $actual_link ?>" target="_blank" class="fa fa-twitter"></a></li>
                              <li><a href="https://wa.me/?text=<?=$actual_link?>" class="fa fa-whatsapp" target="_blank"></a></li>
                          </ul>
                      </div>
                  </div>

<div class="clearfix"></div>
<div class="owl-carousel" style="padding-bottom: 20px;">
    @foreach($blog_gallery as $gallery)
        <div class="item">
            <a class="popup-youtube" href="{{ url('/')}}/public/images/blog_images/{{$gallery->blog_id}}/{{ $gallery->img_name}}">
            <img src="{{ url('/')}}/public/images/blog_images/{{$gallery->blog_id}}/{{ $gallery->img_name}}"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
      </div>
    @endforeach  
</div> 
<div class="clearfix"></div>
                  
                  <div class="automobile-section-heading"><h2 class="automobile-color"> Author</h2></div>
                  <div class="automobile-admin-post">
                      <figure><a href="void:javascript(0)"><img src="{{url('/')}}/public/images/default_images/default_user.png" alt=""></a></figure>
                      <div class="automobile-admin-post-text">
                          <h6><a href="void:javascript(0)">{{ $blogs->posted_by }}</a></h6>
                          <p>Lead Blog Writer at Motoblogchain</p>
                      </div>
                  </div>
                  
                  <div class="automobile-section-heading"><h2 class="automobile-color">Related Posts</h2></div>
                  <div class="automobile-blog automobile-medium-blog">
                      <ul class="row">
                          @foreach($related_blogs as $related_blog)
                            <li class="col-md-12">
                              <figure><a href="{{ url('/blog-description'.'/'.$related_blog->id.'/'.$related_blog->slug)}}"><img src="{{ url('/')}}/public/images/blog_images/{{$related_blog->id}}/{{$related_blog->blog_img}}" alt=""></a></figure>
                              <div class="automobile-medium-blog-text">
                                  <div class="automobile-social-tag">
                                      <i class="automobile-color fa fa-folder-open"></i>
                                      <?php 
                                        $tagss = $related_blog->tags ;
                                        $myArray = explode(',', $tagss);
                                        foreach($myArray as $my_Array){ ?>
                                            
                                           <a href="{{ url('/')}}/search-blog/{{ $my_Array }}"> <?php echo BlogController::tag_name($my_Array) ?>, </a>
                                        <?php
                                        }
                                      ?>
                                  </div>
                                  <ul class="automobile-blog-post-comment">
                                    <li>
                                        <i class="automobile-color fa fa-clock-o"></i>
                                        <small>{{ date(' jS F', strtotime($related_blog->created_at) )  }}</small>
                                    </li>
                                  </ul>
                                  <h4><a href="{{ url('/blog-description'.'/'.$related_blog->id.'/'.$related_blog->slug)}}">{{ $related_blog->title}}</a></h4>
                                  <p><?php echo str_limit(strip_tags($related_blog->blog_content), 100); ?></p>
                                  <a href="{{ url('/blog-description'.'/'.$related_blog->id.'/'.$related_blog->slug)}}" class="automobile-read-btn">read article</a>
                              </div>
                          </li>
                          @endforeach
                          
                          
                      </ul>
                  </div>
                  <div class="comments-area">
                      <!--// comment-respond \\-->
                    <div class="comment-respond">
                       <div class="automobile-section-heading"><h2 class="automobile-color">Leave a Comment</h2>
                       
                       </div>
                       
                       <form  method="post" id="comment_form">
                           <input type="hidden" name="blog_id" id="blog_id" value="{{ $blogs->id }}">
                           
                           {{ csrf_field() }}
                          <p>
                             <input type="text" name="name" id="name" placeholder="Your Name" class="form-control">
                             <span class="text-danger err_msg" id="err_name"></span>
                          </p>
                          <p>
                             <input type="email" name="email" id="email" placeholder="Your email">
                             <span class="text-danger err_msg" id="err_email"></span>
                          </p>
                          <p class="automobile-full-form">
                             <input type="text" name="website" id="website" placeholder="Your website">
                             <span class="text-danger err_msg" id="err_website"></span>
                          </p>
                          <p class="automobile-full-form">
                             <textarea name="comment"  id="comment" placeholder="Your Comment" class="commenttextarea"></textarea>
                             <span class="text-danger err_msg" id="err_comment"></span>
                          </p>
                          <p class="form-submit"><input class="automobile-bgcolor" id="comment_btn" type="submit" value="Submit"></p>
                       </form>
                     
                    </div>
                      <p id="comment_message" class="err_msg"></p>
                    <!--// comment-respond \\-->
                    <!--// coments \\-->
                    <div class="automobile-section-heading"><h2 class="automobile-color">Comments ({{ count($blog_comments) }} )</h2></div>
                    <ul class="comment-list" id="comment_list">
                        @if(count($blog_comments)>0)
                            @foreach($blog_comments as $blog_comment)
                           
                                <li>
                                  <div class="thumb-list">
                                     <figure><img alt="" src="{{url('/')}}/public/images/default_images/default_user.png"></figure>
                                     <div class="text-holder">
                                        <h6>{{ $blog_comment->name }}</h6>
                                       <time class="post-date automobile-color" datetime="2008-02-14 20:00">{{ date(' jS \of F Y ', strtotime($blog_comment->created_at) )	 }} </time><br/>
                                        <p style="margin-block-start: -1em;">{{ $blog_comment->comment }}</p>
                                     </div>
                                  </div>
                                  <!-- .children -->
                               </li>
                              
                            
                            @endforeach
                        
                        @endif
                       
                       <!-- #comment-## -->
                       
                       <!-- #comment-## -->
                    </ul>
                    <!--// coments \\-->
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!--// Main Section \\-->
      </div>
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

<script type="text/javascript">

$(document).ready(function()
{
      $("#search_btn").click(function(event) {
         
          event.preventDefault();
           var search = $('#search_item').val();
           var base_url = $('#base_url').val();
            var url = base_url+"/search-blog/"+search;
             //alert(url);
              window.location.href = url;
             
                
            });
      
      function isValidEmailAddress(emailAddress) {
            var expr = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                return expr.test(emailAddress);
        }
     
            
    $("#comment_btn").click(function(event) {
        event.preventDefault();
        var name = $('#name').val();
        var email = $('#email').val();
        var website = $('#website').val();
        var comment = $('#comment').val();
        var blog_id = $('#blog_id').val();
        
        setTimeout(function() {
              $('.err_msg').fadeOut('fast');
              }, 4000); 
              
        if(name=='')
        {
            $('#name').focus();
            $('#err_name').text('Please Enter Name');
            return false;
            
        }
        else if(email=='')
        {
            $('#email').focus();
            $('#err_email').text('Please Enter Email');
             return false;
        }else if(!isValidEmailAddress(email)){
             $('#email').focus();
            $('#err_email').text('Please Enter Valid mail address');
             return false;
        }
       /* else if(empty(website))
        {
            $('#website').focus();
        }*/
        else if(comment=='')
        {
            $('#comment').focus();
            $('#err_comment').text('Please Enter Comment');
             return false;
        }else{
       //var token = $("meta[name='csrf-token']").attr("content");
           $.ajax({
               type:'POST',
               url:'{{ url('/')}}/insert_comment',
               data:{
                   "name" : name,
                   "email" : email,
                   "website" : website,
                   "comment" : comment,
                   "blog_id" : blog_id,
                   "_token": "{!! csrf_token() !!}"
                   },
             beforeSend: function(){
                        $('#comment_btn').text('processing...');
                    },
               success:function(res) {
                  //$("#msg").html(data.msg);
                  console.log(res);
                  $("#comment_form")[0].reset();
                  var obj = jQuery.parseJSON(res);
                        //var obj = JSON.parse(res);
                         if(obj.result=="TRUE")
                        {
                          $("#comment_message").text(obj.message);
                          $("#comment_message").addClass("text-success");
                         
                        // $("#comment_list").append("<li> <div class='thumb-list'> <figure><img alt='' src='{{url("/")}}/public/images/default_images/default_user.png'></figure> <div class='text-holder'> <h6> "+obj.name+"</h6> <time class='post-date automobile-color' datetime='2008-02-14 20:00'> NOW </time><br/>  <p style='margin-block-start: 0em;'>"+obj.comment+"</p> </div> </div> </li>");
                         
                        }else if(obj.result=="FALSE"){ 
                           
                            $("#comment_message").text(obj.message);
                            $("#comment_message").addClass("text-danger");
                        }
                     
                 
               }
            });
            
        }
      });
      
     
                
                
});
    
</script>
</body>
</html>