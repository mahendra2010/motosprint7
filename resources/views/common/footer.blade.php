<footer class="wow fadeInDown">
<div class="container">

    <div class="row">
       <div class="col">
          <a href="{{ url('/')}}"> <img src="{{ url('/')}}/public/frontend/images/MBCBigLogo_white.png"></a>
       </div> 
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-3 footerGrid">
            <h3>Resources</h3>
            <ul class="list-inline">
               <li><a href="{{ url('/') }}">Home</a></li> 
               <li><a href="Home">Find a Motorbike</a></li> 
               <li><a href="Home">Dealers</a></li> 
               <li><a href="Home">Financing</a></li> 
            </ul>
        </div>
        <div class="col-sm-6 col-md-4 footerGrid">
                <h3>Contact Us</h3>
                <ul class="list-inline">
                   <li><a href="callto:67483957304"><img src="{{ url('/')}}/public/frontend/images/telephone.png"> 67483957304</a></li> 
                   <li><a href="mailto:contact@motoblockchain.net"><img src="{{ url('/')}}/public/frontend/images/close-envelope.png"> contact@motoblockchain.net</a></li> 
                   <li><a href="mailto:support@motoblockchain.net"><img src="{{ url('/')}}/public/frontend/images/location.png"> support@motoblockchain.net</a></li> 
                </ul>
            </div>
        <div class="col-sm-6 col-md-3 footerGrid">
                <h3>Follow Us</h3>
                <ul class="list-inline">
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/g+.png"> Google +</a></li> 
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/fb.png"> Facebook</a></li> 
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/twitter.png"> Twitter</a></li> 
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/in.png"> Linkedin</a></li> 
                </ul>
            </div>
            <div class="col-sm-6 col-md-2 footerGrid">
                    <h3>Apps</h3>
                    <ul class="list-inline">
                        <li><a href=""><img src="{{ url('/')}}/public/frontend/images/googleplay.png"> </a></li> 
                        <li><a href=""><img src="{{ url('/')}}/public/frontend/images/app_store.png"></a></li> 
                    </ul>
                </div>
    </div>



</div>
<div class="bottom-footer">
        <div class="container">
            <div class="row">
             <div class="col-sm-6">  
              <p>If you have any question or feedback please Contact Us</p>
            </div>
            <div class="col-sm-6">
                <ul class="row list-inline justify-content-around">
                   <li>( 67483957304 )</li> |
                   <li>support@motoblockchain.net</li> |
                   <li><a href="{{ url('/') }}" style="color:#fff;">Sign Up </a></li> 
                </ul>
                </div>
            </div>  
        </div>
 </div>
</footer>

<!--datepicker js-->
<script src="{{ url('/')}}/public/frontend/js/datepicker/datepicker.js"></script>
<script src="{{ url('/')}}/public/frontend/js/datepicker/lang/datepicker.@lang('messages.datepicker.lang').js"></script>
<!-- bootstrap js cdn -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js"></script>




<script src="{{ url('/')}}/public/frontend/js/wow.js"></script>
<script>
wow = new WOW(
{
animateClass: 'animated',
offset:       100,
callback:     function(box) {
//console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
}
}
);
wow.init();

</script>
<script>
$(window).bind("load resize scroll",function(e) {
    var y = $(window).scrollTop();

$("#valuedBike").filter(function() {
return $(this).offset().top < (y + $(window).height()) &&
$(this).offset().top + $(this).height() > y;
}).css('background-position', '0px ' + parseInt(-y / 6) + 'px');
});
</script>
<script>
jQuery(document).ready(function($) {
"use strict";
$('#logo-slider').owlCarousel( {
		loop: true,
		center: true,
		items: 6,
		margin: 30,
		autoplay: true,
		dots:true,
    nav:true,
		autoplayTimeout: 8500,
		smartSpeed: 450,
  	navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			1170: {
				items: 3
			}
		}
	});
   
});
</script>

<script>
$(document).ready(function(){
  $('#customers-testimonials').owlCarousel( {
		loop: true,
		center: true,
		items: 3,
		margin: 30,
		autoplay: true,
		dots:true,
    navigation: true,
  navigationText: ['<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>','<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>'],
		autoplayTimeout: 8500,
		smartSpeed: 450,
		responsive: {
			0: {
				items: 3
			},
			768: {
				items: 4
			},
			1170: {
				items: 5
			}
		}
	});
	
	$('#onsale_products').owlCarousel( {
		loop: true,
		center: true,
		items: 3,
		margin: 30,
		autoplay: true,
		dots:true,
    navigation: true,
  navigationText: ['<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>','<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>'],
		autoplayTimeout: 8500,
		smartSpeed: 450,
		responsive: {
			0: {
				items: 3
			},
			768: {
				items: 4
			},
			1170: {
				items: 5
			}
		}
	});
	
	$('#recent_search_products').owlCarousel( {
		loop: true,
		center: true,
		items: 3,
		margin: 30,
		autoplay: true,
		dots:true,
    navigation: true,
  navigationText: ['<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>','<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>'],
		autoplayTimeout: 8500,
		smartSpeed: 450,
		responsive: {
			0: {
				items: 3
			},
			768: {
				items: 4
			},
			1170: {
				items: 5
			}
		}
	});
  $('#whatwedo-testimonials').owlCarousel( {
  autoplay: true,
  center: true,
  loop: true,
  navigation: true,
  navigationText: ['<i class="fa fa-chevron-circle-left" aria-hidden="true"></i>','<i class="fa fa-chevron-circle-right" aria-hidden="true"></i>'],
  items: 2,
  responsive : {
    768 : {
      items : 2,
    }
  }
  });

});
</script>
<script>
    $(document).ready(function(){
    $('.fix-loader').delay(1000).fadeOut(500);
    });
    </script>
<script type="text/javascript">
    var lFollowX = 0,
        lFollowY = 0,
        x = 0,
        y = 0,
        friction = 1 / 30;
    
    function moveBackground() {
      x += (lFollowX - x) * friction;
      y += (lFollowY - y) * friction;
      
      translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';
    
      $('.headerBgImage').css({
        '-webit-transform': translate,
        '-moz-transform': translate,
        'transform': translate
      });
    
      window.requestAnimationFrame(moveBackground);
    }
    
    $(window).on('mousemove click', function(e) {
    
      var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
      var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
      lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
      lFollowY = (10 * lMouseY) / 100;
    
    });
    
    moveBackground();
    </script>
    <script>

$(document).ready(function(){
  $(window).scroll(function() {
    if($(this).scrollTop()>500) {
        $( "#header" ).addClass("fixed-me");
        $("#header .logo > img").css('width' , '178px')
    } else {
        $( "#header" ).removeClass("fixed-me");
        $("#header .logo > img").css('width' , '225px')

    }
    
   });
   
   //to hide and show top menu and remove collision on form
   $('.menu-right ul').hide();
    $('.menu-right span.menu').on('click', function(){
    	$('.menu-right ul').toggle();
    });

  });

  
</script>

 <script type="text/javascript">
  //custom user input date
  function date_validate(date_id){
    var date = document.getElementById(date_id);
    
    /*var txt_id = $('#'+date_id);
    var txt_val = txt_id.val();
    var len = txt_val.length;
    if(len<=13)
    {
        $(txt_id).addClass("val_error");
        
    }else{
        $(txt_id). removeClass("val_error");
    } */
    //var date = date_id;
    
        function checkValue(str, max) {
          if (str.charAt(0) !== '0' || str == '00') {
            var num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) num = 1;
            str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
          };
          return str;
        };
        
        date.addEventListener('input', function(e) {
          this.type = 'text';
          var input = this.value;
          if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
          var values = input.split('/').map(function(v) {
            return v.replace(/\D/g, '')
          });
          if (values[1]) values[1] = checkValue(values[1], 12);
          if (values[0]) values[0] = checkValue(values[0], 31);
          var output = values.map(function(v, i) {
            return v.length == 2 && i < 2 ? v + ' / ' : v;
          });
          this.value = output.join('').substr(0, 14);
        });
        
        date.addEventListener('blur', function(e) {
          this.type = 'text';
          var input = this.value;
          var values = input.split('/').map(function(v, i) {
            return v.replace(/\D/g, '')
          });
          var output = '';
          
          if (values.length == 3) {
            var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
            var month = parseInt(values[1]) - 1;
            var day = parseInt(values[0]);
            var d = new Date(year, month, day);
            if (!isNaN(d)) {
              document.getElementById('result').innerText = d.toString();
              var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
              output = dates.map(function(v) {
                v = v.toString();
                return v.length == 1 ? '0' + v : v;
              }).join(' / ');
            };
          };
          this.value = output;
        });
  } 
  </script>

