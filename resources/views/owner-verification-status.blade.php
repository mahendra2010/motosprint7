

<!DOCTYPE html>
<html>
<head>
	<title>MotoBlockchain</title>
	 <!-- top css/js scripts -->
	@include('common.head')
	<!-- end top css/js scripts -->
	<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->

    
	<style>
	    .bs-wizard {margin-top: 30px;}

    /*Form Wizard*/
  
    .bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
    .bs-wizard > .bs-wizard-step + .bs-wizard-step {}
    .bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
    .bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #49b293; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
    .bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
    .bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
    .bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #49b293;}
    .bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
    .bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
    .bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
    .bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #bbd0e0;}
    .bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
    .bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
    .bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
    .bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
    /*END Form Wizard*/
	</style>
</head>
<body>
		
<!-- header start -->
 @include('common.header')
<!-- header close -->


<div class="bannerTop">
    <h3>Registration Status</h3>
</div>
    <div class="form-wrapper">
    	<div class="container">
    	     <div class="row">
	        <div class="col-md-12 mx-auto">
	            <h5 class="formHeading"> One more step and you will reach your first Blockchain Certificate</h5>
	        </div>
	    </div>
			
	
	
	<div class="col-md-12 mx-auto">
              <div class="formDesign" >
               
                <div class="row bs-wizard" style="padding-top:60px; padding-bottom:60px">
                
                <div class="col-sm-2 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum"> Step 1 </div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="void:javascript(0)" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><p>Completed Registration & Email verification </p></div>
                </div>
                
                <div class="col-sm-2 bs-wizard-step complete"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum"> Step 2 </div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="void:javascript(0)" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><p> Completed Profile Information  </p> </div>
                </div>
                
                <div class="col-sm-2 bs-wizard-step active"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="void:javascript(0)" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><p>Completed Motorcycle Information </p></div>
                </div>
                
                <div class="col-sm-3 bs-wizard-step disabled"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="void:javascript(0)" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center"><p style="color:#000;"> Please complete your <br/>documentation upload process by <br/> using the mobile App</p></div>
                </div>
                <div class="col-sm-3 bs-wizard-step  " align="center"><!-- active -->
                 <img src="{{ url('/')}}/public/frontend/images/race_flag.png" width="55px">
             
               <div class="bs-wizard-info text-center"> <p style="color:#000;"> Blockchain certificate</p></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-12">
                    <center><h3 class="mb-5 loginHeading text-center">Download App</h3></center>
                </div>
               
                    <div class="col-sm-2" >
                        
                    </div>
                    <div class="col-sm-4">
                     <center>  <a href=""> <img src="{{ url('/')}}/public/frontend/images/app_store.png" class="img-responsive" width="50%" align="center"></a></center>
                        
                    </div>
                    <div class="col-sm-4" >
                       <center>  <a href=""> <img src="{{ url('/')}}/public/frontend/images/googleplay.png" class="img-responsive" width="50%" align="center"> </a></center>
                    </div>
                    <div class="col-sm-2">
                        
                    </div>
                
            </div>
			
			</div>
		</div>	
	</div>
</div>	


		
	@include('common.footer')
	


</body>
</html>