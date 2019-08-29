

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
    <h3> Not Authorised</h3>
</div>		
<div class="form-wrapper">
	<div class="container">
	    
      
          <div class="col-md-10 mx-auto">
              <div class="formDesign" align="center">
                
                      <h1>403 </h1>
                      <h3>Not Authorised User</h3>
               
                  <div class="row">
                      <div class=" col-sm-4 ">
                         </div>
    			     <div class=" col-sm-4 ">
    			         <a href="{{ url('/')}}" style="font-size: 21px;" type="button" class="giftBtn">Go To Home</a>
    			     </div>
    			     <div class=" col-sm-4 ">
                         </div>
    			    
    			   
    			
    			   
    			 </div>
    			  <div class="row">
    			      <div class=" col-sm-4 ">
                         </div>
                         <div class=" col-sm-4 ">
                       
    			        <a href="{{ url()->previous() }}" style="font-size: 21px;" type="button" class="giftBtn">Go Back</a>
    			          </div>
    			     <div class=" col-sm-4 ">
                         </div>
    			 </div>
              
    		</div>
    			
    
         </div>	
	</div>
	</div>
	@include('common.footer')
	


</body>
</html>