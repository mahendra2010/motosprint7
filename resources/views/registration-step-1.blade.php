<!DOCTYPE html>
<html>
<head>
	<title>MotoblockChain</title>
	 <!-- top css/js scripts -->
	@include('common.head')
	<!-- end top css/js scripts -->
	<style>
	    .privacy{
	        font-size:14px;
	        padding:6px;
	    }
	</style>
</head>
<body>
<!-- header start -->
 @include('common.header')
<!-- header close -->

		
<div class="bannerTop">
    <h3>Registration Form</h3>
    <p class="px-2">Welcome to Motoblockchain, in order to Access your account you first need to fill in the user registration details</p>
</div>		
<div class="form-wrapper">
	<div class="container">
	    <div class="row">
	        <div class="col-md-12 mx-auto">
	            <h4 class="formHeading">User Registration</h4>
	        </div>
	    </div>
      <div>
          <div class="col-md-12 mx-auto paddingLess">
               
              <div class="formDesign">
         	<form method="post" action="{{ url('/reg_step_1_insert') }}" enctype="multipart/form-data" autocomplete="off" class="was-validated">
				{{ csrf_field() }}
			  <fieldset>
			     @if(session('info'))
    					
        					<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              	{{ session('info') }}
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
        		@endif
        				
			    
			    <input type="hidden" name="user_id" value="{{ @Auth::user()->id }}"> 
			    <div class="row">
			    <div class="form-group col-md-4">
			      <label for="exampleInputEmail1">Name</label> <span class="required-mark">*</span> <span class="pull-right privacy"> <input type="checkbox" id="private_name" name="private_name"> Private (use alias)</span>
			      <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name" minlenght="3" value="{{ @Auth::user()->name }}" required>
			      
			      
			    </div>
			   
				    <div class="form-group col-md-4">
				      <label for="surname1"> First Surname </label><span class="required-mark">*</span>  <span class="pull-right privacy"> <input type="checkbox" name="private_surname1"> Private</span>
				      <input type="text" name="surname1" class="form-control" id="surname1" placeholder="Enter First Surname" minlength="3" value="{{ old('surname1') }}" required> 
				      
				      
				    </div>
				    <div class="form-group col-md-4">
				      <label for="surname2">Second Surname</label> 
				      <input type="text" name="surname2" class="form-control" id="surname2" placeholder="Second Surname" value="{{ old('surname2') }}" >
				    </div>
				 </div>
			    <div class="row">
			        <div class="col-sm-12 col-md-4">
    			        <label for="date_of_birth">Date of Birth </label><span class="required-mark">*</span>  <span class="pull-right privacy"> <input type="checkbox" name="private_date_of_birth"> Private</span>
    			      <input type="text" name="date_of_birth" class="form-control" id="date_of_birth"  value="{{ old('date_of_birth') }}"  placeholder="dd/mm/yyyy" onkeyup="date_validate(this.id)"   required>
    			     
    			    </div>
			        <div class="form-group col-md-4">
    			      <label for="nickname">Alias </label> 
    			      <input type="text" name="nickname" class="form-control" id="nickname"  placeholder="Enter NickName " value="{{ old('nickname') }}" >
    			      
    			    </div>
    			    <div class="col-sm-12 col-md-4">
    			        <label for="customFile">Choose Profile Photo</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input btn" id="customFile" name="profile_pic" >
                        <label class="custom-file-label" for="customFile">Choose Avatar</label>
                        </div> 
    			    </div>
    			    
			    </div>
			    <div class="row">
                  <div class="form-group col-md-4">
                      <label for="country">Country</label><span class="required-mark">*</span>
                      <select class="form-control" name="country" id="country" required>
                            <option value=""> Select Country</option>
                           @foreach($country as $key => $cnt)
    		                  <option value="{{ $key }}"> {{ $cnt }}</option>
    		                @endforeach
                          </select>
                         
                  </div>
                  <div class="form-group col-md-4">
                    <label for="region">Region</label><span class="required-mark">*</span>
                    <select class="form-control" name="region" id="region" required >
                            
                     </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control"  placeholder="Enter City" value="{{ old('city') }}" >
                </div>
              </div>
			    
				<div class="row">   
			    <div class="form-group col-md-4">
			      <label for="dni">National ID Number</label> <span class="required-mark">*</span>  <span class="pull-right privacy"> <input type="checkbox" name="private_dni"> Private</span>
			      <input type="text" name="dni" class="form-control" id="dni" minlength="14"  placeholder="Enter national id number" value="{{ old('dni') }}" required>
			      
			      
			    </div>
			    <div class="form-group col-md-4">
			      <label for="dni_expiry_date">National ID Expiry Date </label> <span class="required-mark">*</span>   
			      <!--<input type="text" name="dni_expiry_date" class="form-control" id="dni_expiry_date" placeholder="Choose Date" value="{{ old('dni_expiry_date') }}"  data-language="@lang('messages.datepicker.lang')" onkeydown="return false;" required>-->
			      <input type="text" name="dni_expiry_date" class="form-control" id="dni_expiry_date"  value="{{ old('dni_expiry_date') }}"  placeholder="dd/mm/yyyy" onkeyup="date_validate(this.id)"  required>
			      
			    </div>
			    <div class="form-group col-md-4">
			     
			      <div class="row">
			          <div class="col-sm-12".>
			             <label> ADD National ID Alarm </label>
			          </div>
			          <div class="col-sm-12">
			              <div class="input-group mb-3">
                              
                               <select class="form-control" name="alarm_expiry_dni">
    			                  <option value=""> Select </option>
    			                  <option value="1"> 1 </option>
    			                  <option value="2"> 2 </option>
    			                  <option value="3"> 3 </option>
    			                  <option value="4"> 4 </option>
    			                  <option value="5"> 5 </option>
    			                  <option value="6"> 6 </option>
    			                  <option value="7"> 7 </option>
    			                  <option value="8"> 8 </option>
    			                  <option value="9"> 9 </option>
    			                  <option value="10"> 10 </option>
    			                  <option value="11"> 11 </option>
    			                  <option value="12"> 12 </option>
    			              </select>
                              
                                    <select name="alarm_expiry_dni_days" class="form-control">
                			            <option value=""> Select </option>
                			            <option value="days"> Days </option>
                			            <option value="weeks"> Weeks </option>
                			</select>
                            </div>
			          </div>
			          
			          
			          
			      </div>
			     
			    </div>
			    
			 
			   </div>
			    
			    <div class="row">
			        <div class="form-group col-md-4">
    			        <label for="motorcycle_licence_typology">Motorcycle Licence:Typology</label><span class="required-mark">*</span>   <span class="pull-right privacy"> <input type="checkbox" name="private_motorcycle_licence_typology">Private</span>
                         <select class="form-control" name="motorcycle_licence_typology" onchange="licent_toplogy(this.value)" id="motorcycle_licence_typology" required>
                            <option value=""> Select </option>
                           <option value="A"> A </option>
                           <option value="A1"> A1 </option>
                           <option value="AM"> AM </option>
                           <option value="M1"> M1 </option>
                           <option value="M2"> M2 </option>
                           <option value="other"> Other </option>
                          <option value="no licence"> No license </option>
                          </select>
                          
    			    </div>
    			    <div class="form-group col-md-4"  style="display:none" id="other_licence_div">
    			        <label>Other</label><span class="required-mark">*</span> 
    			        <input type="text" name="m_other_licence_typology" id="m_other_licence_typology" class="form-control" placeholder="Enter other licence toplogy">
    			    </div>
    			    <div class="form-group col-md-4">
    			        
    			    </div>
    			    
			        
			    </div>
			    <div class="row" id="licence_detail_div" style="display:none">
                    <div class="form-group col-md-4">
    			        <label for="m_licence_no">Motorcycle Licence Number</label><span class="required-mark">*</span> <span class="pull-right privacy"> <input type="checkbox" name="private_motorcycle_licence_date"> Private</span>
                        <input type="text" name="m_licence_no" class="form-control" id="m_licence_no" placeholder="Enter Motorcycle licence number" value="{{ old('m_licence_no') }}" >
                        
                          
    			    </div>	
    			    <div class="form-group col-md-4">
    			         <label for="m_licence_expiry_date">Motorcycle Licence Expiry Date </label><span class="required-mark">*</span>  
    			      <input type="text" name="m_licence_expiry_date" class="form-control" id="m_licence_expiry_date"  value="{{ old('m_licence_expiry_date') }}" placeholder="dd/mm/yyyy" onkeyup="date_validate(this.id)"  >
    			      
    			    </div>
    			    <div class="form-group col-md-4">
    			       <div class="row">
    			           <div class="col-sm-12">
    			               <label>ADD Motorcycle License Alarm</label>
    			           </div>
    			          <div class="col-sm-12">
			              <div class="input-group mb-3">
                              
                               <select class="form-control" name="alarm_expiry_licence">
    			                  <option value=""> Select </option>
    			                  <option value="1"> 1 </option>
    			                  <option value="2"> 2 </option>
    			                  <option value="3"> 3 </option>
    			                  <option value="4"> 4 </option>
    			                  <option value="5"> 5 </option>
    			                  <option value="6"> 6 </option>
    			                  <option value="7"> 7 </option>
    			                  <option value="8"> 8 </option>
    			                  <option value="9"> 9 </option>
    			                  <option value="10"> 10 </option>
    			                  <option value="11"> 11 </option>
    			                  <option value="12"> 12 </option>
    			              </select>
                              
                                    <select name="alarm_expiry_licence_days" class="form-control">
                			            <option value=""> Select </option>
                			            <option value="days"> Days </option>
                			            <option value="weeks"> Weeks </option>
                			</select>
                            </div>
			          </div>
    			       </div>
    			    </div>
    			    
			    </div>
			    
			  
			  <div class="row">
			      <div class="col-sm-4 mx-auto">
			    <button style="font-size: 21px;" type="submit" class="giftBtn">Submit</button>
			    </div>
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
<script type="text/javascript">
    $('#country').change(function(){
    var country_id = $(this).val();    
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+country_id,
           success:function(res){               
            if(res){
                $("#region").empty();
                $("#region").append('<option value="">Select</option>');
                $.each(res,function(key,value){
                    $("#region").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#region").empty();
            }
           }
        });
    }else{
        $("#region").empty();
        
    }      
   });
   
  function  licent_toplogy(val){
       if(val=='other')
       {
           $("#other_licence_div").show();
           $('#m_other_licence_typology'). attr("required","required");
       }else{
            $("#other_licence_div").hide();
            $('#m_other_licence_typology'). removeAttr("required","required");
       }
       if(val=='no licence' || val=='')
       {
           $("#licence_detail_div").hide();
           //$("a"). removeAttr("href");
           $('#m_expendition_date'). removeAttr("required","required");
           $('#m_licence_no'). removeAttr("required","required");
           $('#m_licence_expiry_date'). removeAttr("required","required");
       }
       else{
           $("#licence_detail_div").show();
           $('#m_expendition_date'). attr("required","required");
           $('#m_licence_no'). attr("required","required");
           $('#m_licence_expiry_date'). attr("required","required");
       }
   }
   
   //when user select private usename
   $('#private_name').click(function(){
            if($(this).prop("checked") == true){
                $('#nickname'). attr("required","required");
            }
            else if($(this).prop("checked") == false){
                $('#nickname'). removeAttr("required","required");
            }
        });
   
   
   
</script>

<script>
//datepicker

  $( function() {
        $( "#date_of_birth, #dni_expendition_date, #dni_expiry_date, #m_expendition_date, #m_licence_expiry_date" ).datepicker({
            dateFormat: 'dd/mm/yyyy',
            autoClose: true,
           
        });
  } ); 
  
  //to open alarm for dni expiry
   $('#add_dni_expiry_date').click(function() {
        $("#myModal").modal();
    });
    
    //to open alarm for dni expiry
   $('#add_m_licence_expiry_date').click(function() {
        $("#m_licence_expiry_Modal").modal();
    });
  </script>
  
  

</body>
</html>