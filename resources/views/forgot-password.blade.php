

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
    <h3>Registration Form</h3>
</div>		
<div class="form-wrapper">
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 mx-auto">
	            <h4 class="formHeading">Forgot Password</h4>
	        </div>
	    </div>
      <div>
          <div class="col-md-10 mx-auto">
              <div class="formDesign">
                  
                  
         	<form method="post" action="{{ url('/forgot_pass') }}"  >
				{{ csrf_field() }}
			  <fieldset>
			    
			    <div class="row">
			        <div class="col-md-2"></div>
			    <div class="form-group col-md-8">
    			      @if(session('info'))
    					
        					<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              	{{ session('info') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
        				@endif
			    	
			      <label for="staticEmail" class=" col-form-label">Your Registered Email</label>
			            <div class="form-group">
			                <input type="text" name="email" class="form-control" id="staticEmail" Placeholder="Enter Email">
    			               {!! $errors->first('email', '<span class="help-block text-danger"> :message </span>') !!}
    			      
			            </div>
			            <div class="form-group">
			                 <button style="font-size: 20px;" type="submit" class="btn-hover color-4 pull-right">Submit</button>
			            </div>
    			        
    			    </div>
    			    <div class="col-md-2"></div>
			   
				  </div>
				  
				
			  </fieldset>
			</form>
	 	</div>
	 	</div>
      </div>	
	</div>
	</div>
	@include('common.footer')
	
<!-- to load state on country change -->	


</body>
</html>