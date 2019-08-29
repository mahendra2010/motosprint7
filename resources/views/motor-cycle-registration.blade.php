<!DOCTYPE html>
<html>
<head>
	<title>MotoBlockChain</title>
	<!-- top css/js scripts -->
	@include('common.head')
	<!-- end top css/js scripts -->
	<style>
	    .privacy{
	        font-size:14px;
	        padding:6px;
	    }
	    .val_error{
	        border: 1px solid red !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E") !important;
	    }
	</style>
	
</head>
<body>
    	<!-- header start -->
 @include('common.header')
<!-- header close -->

<div class="bannerTop">
    <h3>Motorcycle Registration</h3>
     <p class="px-2">Please fill in the Motorcycle data and obtain the Blockchain Certificate proving the Digital Identity of your Motorcycle</p>
</div>
    <div class="form-wrapper">
    	<div class="container">
    	     <div class="row">
	        <div class="col-md-12 mx-auto">
	            <h4 class="formHeading">Add Motorcycle Details</h4>
	           
	        </div>
	    </div>
			
	
	
	<div class="col-md-12 mx-auto paddingLess">
              <div class="formDesign">
               
            @if(session('fail_info'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      	{{ session('fail_info') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
	    	@endif
	    	
			<form method="post" action="{{ url('/step_1_reg_insert') }}" enctype="multipart/form-data" class="was-validated add_moter_cycle_form"  autocomplete="off">
				{{ csrf_field() }}
			   @include('common.add_motorcycle_form') 
			</form>
			</div>
		</div>	
	</div>
</div>	
<!-- footer start  with js script-->
 @include('common.footer')
<!-- footer close -->
</body>
</html>