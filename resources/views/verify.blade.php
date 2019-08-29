

<!DOCTYPE html>
<html>
<head>
	<title>MotoBlock Chain</title>
	 <!-- top css/js scripts -->
	@include('common.head')
	<!-- end top css/js scripts -->
</head>
<body>
		
<!-- header start -->
 @include('common.header')
<!-- header close -->

		
<div class="bannerTop">
    <h3> Verification Process</h3>
</div>		
<div class="form-wrapper">
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 mx-auto">
	            <h4 class="formHeading">
	                @if(session('invalid_token'))
	                    Check Your Email and reset password
	                    @elseif(session('info'))
	                    Check Your Email and verify now
	                    @elseif(session('expire_token'))
	                    Token Expired
	                    @else
	                    Unauthorised Access
	                @endif
	                
	                </h4>
	        </div>
	    </div>
      <div>
          <div class="col-md-10 mx-auto">
              <div class="formDesign" align="center">
              @if(session('info'))
    			<h3> {{ session('info') }}</h3>
    			<!--<p>Your successfully Registered .. Please check your mail and verify for the further process</p> -->
    			<p>Please check your mail and verify .</p>
    			<a href="{{ url('/login') }}" class="btn-hover color-4">Sign In</a>
    			
    			@elseif(session('invalid_token'))
    			<h1> {{ session('invalid_token') }} </h1>
    			<a href="{{url('/login') }}">Login</a>
    			
    			@elseif(session('expire_token'))
    			<h1> {{ session('expire_token') }} </h1>
    			@else
    			<h1>Session Expired</h1>
    			<p>Your verfication token is expired</p>
    			</div>
    			
    		@endif
    
    		
    		
	 	</div>
      </div>	
	</div>
	</div>
	@include('common.footer')
	


</body>
</html>