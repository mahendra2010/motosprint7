<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Motoblockchain | login</title>
    
   <!-- top css/js scripts -->
	@include('common.head')
	<!-- end top css/js scripts -->
</head>
<body class="animated fadeIn">



<!-- header start -->
 @include('common.header')
<!-- header close -->

<!-- banner start -->

<!-- login section start -->

<section id="loginSectino">
 <div class="container"> 
 <div class="loginwrapper">      
  <div class="row">
      <div class="col-sm-6 d-flex align-items-center justify-content-center">
         <div class="formwrapper">
         <h3 class="mb-5 loginHeading text-center">  @lang('messages.login_sign_up.welcome')</h3>
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
         <form action="{{ url('/user_login') }}" method="post"  class="was-validated"> 
            @if(!empty($_REQUEST['req']))
              <input type="hidden" name="req" value="{{ $_REQUEST['req'] }}" />
            @endif
            @if(!empty($_REQUEST['tab']))
              <input type="hidden" name="req" value="{{ $_REQUEST['tab'] }}" />
            @endif
             {{ csrf_field() }}
            <div class="form-group user">
              <input type="email" name="email" class="form-control" id="email" placeholder="@lang('messages.login_sign_up.email')" value="{{ old('email') }}"  required>
            </div>
            <div class="form-group pass">
              <input type="password" name="password" class="form-control" id="pwd" placeholder="@lang('messages.login_sign_up.password')" minlength="6" value="{{ old('password') }}"  required>
               
            </div>
             
            <div class="form-group ">
                
                <a class="forgorpass "  href="{{ url('forgot-password') }} "> @lang('messages.login_sign_up.forgot_password')</a>
            </div>
            <button type="submit" style="font-size:21px" class="giftBtn">Sign In</button>
          </form>
          <div class="col-sm-12 text-center">
              <span>@lang('messages.login_sign_up.donot_account') <a class="theme-color" href="{{ url('/register') }}">@lang('messages.login_sign_up.sign_up')</a></span>
              <div class="clearfix"></div>
              <!--
              <span class="or">OR</span>
              <div class="clearfix"></div>
              <span>Sign In with Social</span>
              <div class="clerfix"></div>
              <div class="col-sm-8 mx-auto">
              <ul class="list-inline mt-3 signInsocial d-flex justify-content-around">
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/g+.png"></a></li> 
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/fb.png"></a></li> 
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/twitter.png"></a></li> 
                    <li><a href=""><img src="{{ url('/')}}/public/frontend/images/in.png"></a></li> 
              </ul>
            </div>
            -->
          </div> 
        </div>   
      </div>
      <div class="col-sm-6 img-wrapper">
         <img src="{{ url('/')}}/public/frontend/images/login.jpg" class="img-fluid"> 
      </div>
    </div>   
  </div>
</div> 
</section>

<!-- login section close -->


<!-- footer start  with js script-->
 @include('common.footer')

<!-- footer close -->



</body>
</html>