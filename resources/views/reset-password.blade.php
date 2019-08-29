

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
    <h3>Reset Password Form</h3>
</div>		
<div class="form-wrapper">
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 mx-auto">
	            <h4 class="formHeading">Reset Password</h4>
	        </div>
	    </div>
      <div>
          <div class="col-md-10 mx-auto">
              <div class="formDesign">
                	@if(session('success_info'))
    					
        					<div class="alert alert-success alert-dismissible fade show" role="alert">
                              	{{ session('success_info') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                        <br>
                               <h4 align="center">Please login with new credentials......</h4>
        				<center><a href="{{ url('/login') }}"  class="btn-hover color-4">Sign In</a></center>
                         
                            
                  
         
			 
			  	@elseif(!empty($err_msg))
				<h4 align="center"> {{ $err_msg }} </h4>
				<center>	<a href="{{ url('/login') }}" align="center" class="btn-hover color-4">Sign In</a> </center>
				@else
				<form action="{{ url('/generate_new_password') }}" method="post">
			  {{ csrf_field() }}
			  <fieldset>
			    <legend>Generate   New Password</legend>
			    <input type="hidden" name="user_id" value="{{ $user_id }}"> 
			     <input type="hidden" name="token" value="{{ $token }}"> 
			    <div class="form-group ">
			    	
			      <label for="staticEmail" class=" col-form-label">New Password</label>
			      
			        <input type="password" name="new_password" class="form-control" id="staticEmail" Placeholder="Enter New Password" value="{{ old('new_password') }}">
			        {!! $errors->first('new_password', '<span class="help-block text-danger"> :message </span>') !!}
			   
			    </div>
			    
			    <div class="form-group">
			      <label for="exampleInputPassword1">Confirm Password</label>
			      <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="confirm  Password" value="{{ old('confirm_password') }}">
			      {!! $errors->first('confirm_password', '<span class="help-block text-danger"> :message </span>') !!}
			    </div>
			    
			    <button type="submit" class="btn btn-primary">Submit</button>
			  </fieldset>
			</form>

			@endif
		
	 	</div>
	 	</div>
      </div>	
	</div>
	</div>
	@include('common.footer')
	
<!-- to load state on country change -->	


</body>
</html>








