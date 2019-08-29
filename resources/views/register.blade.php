
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Motoblockchain | Registration</title>
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
         <h3 class="mb-5 loginHeading text-center">  @lang('messages.login_sign_up.create_account') </h3>
         @if(session('info'))
					
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      	{{ session('info') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
		@endif
		
         <form action="{{ url('/user_registration') }}" method="post"  class="was-validated">
             {{ csrf_field() }}
             <div class="form-group user">
              <input type="name" name="name" class="form-control" id="name" minlength="3" placeholder="@lang('messages.login_sign_up.name')" value="{{ old('name') }}"  required>
            </div>
            <div class="form-group user">
              <input type="email" name="email" class="form-control" id="email" placeholder="@lang('messages.login_sign_up.email')"  value="{{ old('email') }}" required>
               {!! $errors->first('email', '<span class="help-block text-danger"> :message </span>') !!}
            </div>
            <div class="form-group pass">
              <input type="password" name="password" class="form-control" id="pwd" placeholder="@lang('messages.login_sign_up.password')" minlength="6" value="{{ old('password') }}" required>
               {!! $errors->first('password', '<span class="help-block text-danger"> :message </span>') !!}
            </div>
            <div class="form-group">
                <label>@lang('messages.login_sign_up.user_type_label')</label><br>
                <input type="radio" name="user_type" value="0"  required>  @lang('messages.login_sign_up.user_type_user') &nbsp; 
                <input type="radio" name="user_type" value="1" required>  @lang('messages.login_sign_up.user_type_seller')
            </div>
             
            
            <button style="font-size:21px" class="giftBtn"> @lang('messages.login_sign_up.sign_up')</button>
          </form>
          <div class="col-sm-12 text-center">
              <span>@lang('messages.login_sign_up.aleady_account') <a class="theme-color" href="{{ url('/login') }}"> @lang('messages.login_sign_up.sign_in')</a></span>
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


<!-- footer start -->
 @include('common.footer')

<!-- footer close -->

</body>
</html>