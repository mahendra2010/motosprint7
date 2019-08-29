




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
    <h3>Logged in</h3>
</div>		
<div class="form-wrapper">
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 mx-auto">
	            <h4 class="formHeading">successfully Logged in</h4>
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
                       

		    	@endif
		    	
		    	<h3> {{ Auth::user()->email }} Successfully Logged In</h3>
		
	 	</div>
	 	</div>
      </div>	
	</div>
	</div>
	@include('common.footer')
	
<!-- to load state on country change -->	


</body>
</html>








