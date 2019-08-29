<fieldset>
			    
			     <!-- <input type="hidden" name="user_id" value="{{ @session()->get('auth_user_id') }}"> -->
			   <input type="hidden" name="user_id" value="{{ @Auth::user()->id }}"> 
			    
			    
			    <div class="row">
				    <div class="form-group col-sm-4">
				        <label for="bike_name">Motocycle Name </label>
				        <input type="text" name="bike_name" class="form-control" id="bike_name" placeholder="Enter Motocycle Name"  > 
				    </div>
				   <div class="col-sm-4">
			        	<label>Add Images of bike</label>
    			     <div class="input-group control-group increment " >
    		          <input type="file" name="bike_imgs" class="form-control"  style="padding:2px" >
    		          
    		        </div>
    		        
    		       
			    </div>
				    <div class="form-group col-sm-4">
				        <label for="category_id">Category </label> <span class="pull-right privacy" style="font-size: 14px; padding-top: 6px;"> <input type="checkbox" id="circuit_dedicated" name="circuit_dedicated"> Circuit dedicated Motorcycle</span>
    				      <select  class="form-control" name="category_id" id="category_id" required>
    					   <option value=""> Select Category </option>
    					   @foreach($category as $key => $cat)
    		                  <option value="{{$key}}"> {{ $cat }}</option>
    		                @endforeach
    					   
    					</select>
				    </div>
				</div>
			   <div class="row">
				    <div class="form-group col-sm-4">
				      <label for="exampleInputEmail1"> Brand Name </label>
				      <select  class="form-control" name="brand_id" id="brand_id" required>
					   <option value=""> Select Brand </option>
					   @foreach($brands as $key => $brand)
		                  <option value="{{$key}}"> {{ $brand }}</option>
		                @endforeach
                        <option value="other">Other</option>
					</select>
                    <div id="brand_other_input"></div>
				     
				      
				    </div>
				    <div class="form-group col-sm-4">
				      <label for="exampleInputPassword1">Model</label>
				      <select  name="model_id" id="model_id" class="form-control" required>
						  
						</select>
                        <div id="model_other_input"></div>
				    </div>
				     <div class="form-group col-sm-4">
				         <label for="year"> Year </label>
				          <select  class="form-control" name="year" id="year" required>
    					   <option value=""> Select Year </option>
    					   @for($i=date('Y')-10; $i<=date('Y');$i++)
    		                  <option value="{{ $i }}"> {{ $i }}</option>
    		                @endfor
    					</select>
				     </div>
				  </div>
				 <div class="row">
				     <div class="form-group col-sm-4">
				         <label for="bike_cc"> CC  </label>
				          <select  class="form-control" name="bike_cc" id="bike_cc" required>
    					   <option value=""> Select cc up to </option>
    					    @foreach($cc as $key => $cc_name)
    		                  <option value="{{$key}}"> {{ $cc_name }}</option>
    		                @endforeach
    					   
    					   
    					   
    					</select>
				     </div>
				     <div class="form-group col-sm-4">
				         <label for="cv_original">CV Original</label> 
				         <select name="cv_original" class="form-control"  id="cv_original" required>
				             <option value=""> Select </option>
				             @foreach($cv_original as $key => $cv_name)
    		                  <option value="{{$key}}" data-id="{{ $cv_name }}"> {{ $cv_name }}</option>
    		                @endforeach
				         </select>
				         <input type="text" name="other_cv_original" id="other_cv_original" class="form-control" style="display:none" placeholder="Enter Other CV Original">
        			     
				     </div>
				     <div class="form-group col-sm-4"  id="other_cv_original_div">
				        <label for="current_cv">Current CV </label>
        			      <input type="text" name="current_cv" class="form-control" id="current_cv" placeholder="Enter Current CV"  > 
        			      <input type="file" name="current_cv_image" class="form-control" id="current_cv_image"   style="padding:2px">
				     </div>
				 </div>
				 <div class="row">
				     <div class="form-group col-sm-4">
				         <label for="frame_no">Frame Number</label>
    				        <input type="text" name="frame_no" class="form-control" id="frame_no" placeholder="Enter frame no" value="{{ old('frame_no') }}" required >
    				      <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload  Documentation Image</button>
    				     
				     </div>
				     <div class="form-group col-sm-4">
				      <label for="frame_no_2">Frame Number</label>
				        <input type="text" name="frame_no_2" class="form-control" id="frame_no_2" placeholder="Enter frame no" value="{{ old('frame_no_2') }}"  required>
				      <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload Motorcycle Image</button>
				      <span class="err_msg text-danger" ></span>
				    </div>
				    <div class="form-group col-sm-4">
				         <label for="plate_no"> Plate number</label>
				          <input type="text" name="plate_no"  placeholder="Enter plate no"  class="form-control" id="plate_no"  required>
				          <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload Plate No. Image</button>
        			      
				     </div>
				    
				     
				 </div>
				 
				  <div class="row">
                  <div class="form-group col-md-4">
                      <label for="country_a_m">Country</label><span class="required-mark">*</span>
                      <select class="form-control" name="country" id="country_a_m" required>
                            <option value=""> Select Country</option>
                           @foreach($country as $key => $cnt)
    		                  <option value="{{ $key }}"> {{ $cnt }}</option>
    		                @endforeach
                          </select>
                         
                  </div>
                  <div class="form-group col-md-4">
                    <label for="region_a_m">Region</label><span class="required-mark">*</span>
                    <select class="form-control" name="region" id="region_a_m" required >
                            
                     </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control"  placeholder="Enter City" value="{{ old('city') }}" >
                </div>
              </div>
				 <hr/>
				 <div class="row" style="padding-top:10px">
				     <div class="col-sm-12" style="background:#ee953e; border-radius:10px; color:#fff;padding:5px ">
				         <h4 align="center" style="" > OWNERS & MILEAGE</h4>
				     </div>
				</div>
				 <div class="row" style="padding-top:10px; " >
				      <div class="form-group col-sm-8">
        			        <label >New or Used Motorbike *</label></br>
        			      <input type="radio" name="new_or_used" class="new_or_used " id="new_or_used_n" value="0" value="{{ old('new_or_used') }}" required > <label for="new_or_used_n">  Bought the Motorcycle New &nbsp; &nbsp; </label>
        			      <span class="radioBtns">
        			          <input type="radio" name="new_or_used" class="new_or_used " id="new_or_used_u" value="1" value="{{ old('new_or_used') }}" required> <label for="new_or_used_u"> Bought the Motorcycle Used </label>
        			      </span>
        			       
        			    
        			      
        			    </div>
        			    <div class="form-group col-sm-4">
        			        <label > Are you selling it? Selling price</label></br>
        			        <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <select class="custom-select" name="currency_code" id="inputGroupSelect01">
                                    <option value="">Select</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="INR">INR</option>
                                    
                                  </select>
                              </div>
                              <input type="number" class="form-control" name="selling_price" placeholder="Enter Price"  >
                            </div>
        			      
        			    </div>
        		</div>
        		<div class="row input_fields_wrap" style="display:none;" id="previous_owner_div" >
        		    <div class="col-sm-12 input-group">
				    <div class="form-group col-sm-4">
			        	<label> Owner Name</label>
    		          <input type="text" name="owner_name[]"  id="owner_name" placeholder="1 Owner name" class="form-control"   >
			       </div>
				     <div class="form-group col-sm-4">
				        <!-- <span id="result1" style="display:none"></span>-->
				             <span id="reg_err_msg" class="text-danger"></span>
				         <label for="first_reg_date">Registration Date (dd/mm/yyyy)</label> 
                             <input type="text" name="first_reg_date[]" class="form-control date_txt" onkeyup="date_validate_reg(this.id)" id="date_1"   placeholder="dd/mm/yyyy"  > 
				     </div>
				     <div class="form-group col-sm-4"><br/>
                            <button class=" btn btn-primary add_field_button">Add More Owners</button>
				     </div>
				    </div>
				</div>
				<hr/>
				<div class="row ">
				    <div class="input-group">
				    <div class="form-group col-sm-4">
				        <label>MHP or KM</label> 
				        <!--<input type="text" name="c_mileage" class="form-control" placeholder="MPH & KM/h">-->
				        <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <select class="custom-select" name="c_mileage_type" id="inputGroupSelect01" required>
                                    <option value="MHP">MPH</option>
                                    <option value="KM">KM</option>
                                    
                                  </select>
                              </div>
                              <input type="number" class="form-control" name="c_mileage" placeholder="Enter here"  required>
                        </div>
				    </div>
				    <div class="form-group col-sm-4">
				         <label>Current Mileage Image (From App)</label>
				       <!-- <input type="file" name="milege_image" id="milege_image" class="form-control"    style="padding:0px" disabled >  -->
				       <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload Mileage Image</button>
				      
				        
				    </div>
				    <div class="form-group col-sm-4">
				     <label>Current Mileage Date (From App) </label>
				        <input type="date" name="current_mileage_date" id="current_mileage_date" class="form-control" disabled >
				    </div>
				</div>
				</div>
				
				<hr/>
				<div class="row" style="padding-top:10px;  padding-bottom:10px;">
				     <div class="col-sm-12" style="background:#ee953e; border-radius:10px; color:#fff;padding:5px ">
				         <h4 align="center" style="" > ALARMS</h4>
				     </div>
				</div>
			
				<div class="row" style="padding-top:10px">
				    <div class="form-group col-sm-4">
				        <label>Add alarm for MHP or KM every</label><br/>
				        <input type="text " name="set_alarm_mileage" id="set_alarm_mileage" class="form-control" onfocus="open_mileage_alarm()" placeholder="Activate alarm every " onkeydown="return false;" >
				    </div>
				    <div class="form-group col-sm-4">
				        <label>Add alarm for assurance</label><br/>
				        <input type="text" id="add_alarm_assurance" name="add_alarm_assurance" class=" form-control" placeholder="dd/mm/yyyy"  onkeyup="date_validate(this.id)"   >
				    </div>
				    <div class="form-group col-sm-4">
				        <label>Add alarm for chain lube every</label><br/>
				        <input type="text" name="set_alarm_chain_lube" id="set_alarm_chain_lube" class="form-control" onfocus="open_chain_lube_alarm()" placeholder="set alarm every"    >
				    </div>
				</div>
				
				<div class="row">
    			    <!-- The Modal -->
                    <div class="modal" id="add_alarm_mileage_modal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                    
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Activate alarm every</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                    
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <select name="add_alarm_mileage" id="add_alarm_mileage" class="form-control">
                			            <option value=""> Select </option>
                			            <option value="1 Month"> 1 Month </option>
                			            <option value="2 Months"> 2  Months</option>
                			            <option value="3 Months"> 3  Months</option>
                			            <option value="4 Months"> 4  Months</option>
                			            <option value="5 Months"> 5 Months </option>
                			            <option value="6 Months"> 6  Months</option>
                			            <option value="7 Months"> 7 Months </option>
                			            <option value="8 Months"> 8  Months</option>
                			            <option value="9 Months"> 9 Months </option>
                			            <option value="10 Months"> 10 Months </option>
                			            <option value="11 Months"> 11  Months</option>
                			            <option value="12 Months"> 12  Months</option>
                			        </select>
                                    
                                </div>
                                <!--<div class="col-sm-4">
                                    <select name="add_alarm_mileage_month" id="add_alarm_mileage_month" class="form-control">
                                        <option value="">Select</option>
                			            <option value="Months"> Months </option>
                			        </select>
                                    
                                </div>-->
                                <div class="col-sm-6">
                                    <select name="add_alarm_mileage_days" id="add_alarm_mileage_days" class="form-control">
                			            <option value="">Select  </option>
                			            <option value="Monday"> Monday </option>
                			            <option value="Tuesday"> Tuesday </option>
                			            <option value="Wednesday"> Wednesday </option>
                			            <option value="Thursday"> Thursday </option>
                			            <option value="Friday"> Friday </option>
                			            <option value="Saturday"> Saturday </option>
                			            <option value="Sunday"> Sunday </option>
                			        </select>
                                    
                                </div>
                                
                            </div>
                            
                          </div>
                    
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" id="alarm_mileage_btn" class="btn btn-danger" data-dismiss="modal">Set</button>
                            <!--<button type="button" id="alarm_mileage_btn" class="btn btn-danger" >Set</button>-->
                          </div>
                    
                        </div>
                      </div>
                    </div>
    			    
			    </div>
			    
			    <!--Alarm for chain lube-->
			    <div class="row">
    			    <!-- The Modal -->
                    <div class="modal" id="add_alarm_chain_lube_modal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                    
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Activate alarm every</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                    
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <select name="add_alarm_chain_lube" id="add_alarm_chain_lube" onchange="checkdays(this.value)" class="form-control">
                			            <option value=""> Select </option>
                			            <option value="1" > 1 </option>
                			            <option value="2 "> 2  </option>
                			            <option value="3 "> 3  </option>
                			            <option value="4 "> 4  </option>
                			            <option value="5 "> 5  </option>
                			            <option value="6 "> 6  </option>
                			            <option value="7 "> 7  </option>
                			            <option value="8 "> 8  </option>
                			            <option value="9 "> 9  </option>
                			            <option value="10 "> 10  </option>
                			            <option value="11 "> 11  </option>
                			            <option value="12 "> 12  </option>
                			        </select>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <select name="add_alarm_chain_lube_month"  id="add_alarm_chain_lube_month" class="form-control">
                                        <option value=""> Select</option>
                			            <option value="Weeks"> Weeks </option>
                			            <option value="Months"> Months </option>
                			        </select>
                                    
                                </div>
                                <div class="col-sm-4">
                                    <select name="add_alarm_chain_lube_days" id="add_alarm_chain_lube_days" class="form-control">
                			            <option value="">Select  Days </option>
                			            <option value="Monday"> Monday </option>
                			            <option value="Tuesday"> Tuesday </option>
                			            <option value="Wednesday"> Wednesday </option>
                			            <option value="Thursday"> Thursday </option>
                			            <option value="Friday"> Friday </option>
                			            <option value="Saturday"> Saturday </option>
                			            <option value="Sunday"> Sunday </option>
                			        </select>
                                    
                                </div>
                                
                            </div>
                            
                          </div>
                    
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button" id="alarm_chain_lube_btn" class="btn btn-danger" data-dismiss="modal">Set</button>
                          </div>
                    
                        </div>
                      </div>
                    </div>
    			    
			    </div>
				
			    <div class="row">
			     
			        <div class="col-sm-4 mx-auto">
			             <button type="submit" id="add_motorcycle_btn"  class="giftBtn pull-right load_text_submit">Submit</button>
			        </div>
			    </div>
			   
			    
			    
			   
			  </fieldset>
			  
			  
			  <div class="row">
    			    <!-- The Modal -->
                    <div class="modal" id="app_modal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                    
                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Upload From App</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                    
                          <!-- Modal body -->
                          <div class="modal-body">
                            <p align="center">Certified images must be uploaded form the app.
                                    First you need to end filling the required information.</p>
                            <p align="center">Later you can access the app and also obtain the Blockchain Certificate.</p>
                            
                          </div>
                    
                          <!-- Modal footer -->
                          <div class="modal-footer">
                            <button type="button"   class="btn btn-danger" data-dismiss="modal">Ok</button>
                          </div>
                    
                        </div>
                      </div>
                    </div>
    			    
			    </div>
			    
<script>

//when user select circuit dedicated 
   $('#circuit_dedicated').click(function(){
            if($(this).prop("checked") == false){
                $('#plate_no'). attr("required","required");
            }
            else if($(this).prop("checked") == true){
                $('#plate_no'). removeAttr("required","required");
            }
        });
        
		var allowsubmit = false;
		$(function(){
			//on keypress 
			$('#frame_no_2').keyup(function(e){
				//get values 
				var frame_no = $('#frame_no').val();
				var frame_no_2 = $(this).val();
				
				//check the strings
				if(frame_no == frame_no_2){
					//if both are same remove the error and allow to submit
					$('.err_msg').text('');
					allowsubmit = true;
				}else{
					//if not matching show error and not allow to submit
					$('.err_msg').text('Frame Number not matching');
					allowsubmit = false;
				}
			});
			
			//jquery form submit
			$('#add_moter_cycle_form').submit(function(){
			
				var frame_no = $('#frame_no').val();
				var frame_no_2 = $('#frame_no_2').val();
 
				//just to make sure once again during submit
				//if both are true then only allow submit
				if(frame_no == frame_no_2){
					allowsubmit = true;
				}
				if(allowsubmit){
					return true;
				}else{
					return false;
				}
			});
		});
	</script>
			  
			  
<script type="text/javascript">

    

    $('#country_a_m').change(function(){
    var country_id = $(this).val();    
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+country_id,
           success:function(res){               
            if(res){
                $("#region_a_m").empty();
                $("#region_a_m").append('<option value="">Select</option>');
                $.each(res,function(key,value){
                    $("#region_a_m").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#region_a_m").empty();
            }
           }
        });
    }else{
        $("#region_a_m").empty();
        
    }      
   });


    $(document).ready(function() {
        
      $(".new_or_used").click(function(){
	      if($(this).val() === "1")
	      {
	        $("#previous_owner_div").show("fast");
	        $('#owner_name'). attr("required","required");
	        $('#date_1'). attr("required","required");
	      }
	      else{
	        $("#previous_owner_div").hide("fast");
	        $('#owner_name'). removeAttr("required","required");
	        $('#date_1'). removeAttr("required","required");
	      }
	    });
	    
	    //to add more owners
	    

    });
    
    
    $(document).ready(function() {
    	var max_fields      = 15; //maximum input boxes allowed
    	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
    	var add_button      = $(".add_field_button"); //Add button ID
    	
    	var x = 1; //initlal text box count
    	$(add_button).click(function(e){ //on add input button click
    		e.preventDefault();
    		if(x < max_fields){ //max input box allowed
    			x++; //text box increment
    			$(wrapper).append('<div class="col-sm-12 input-group "><div class="form-group col-sm-4"><input type="text" name="owner_name[]"  placeholder=" '+x+' Owner name" class="form-control"   required></div><div class="form-group col-sm-4"> <input type="text" name="first_reg_date[]" class="form-control date_txt" onkeyup="date_validate_reg(this.id)" id="date_'+x+'" placeholder="dd/mm/yyyy"  required ></div><div class="form-group col-sm-4"><button class="btn btn-danger remove_field">Remove</button></div></div>'); 
    	
    		}
    		
    		
    	});
    	
    	
    	/*$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    		e.preventDefault(); $(this).parent('span').remove(); x--;
    	})*/
    	$("body").on("click",".remove_field",function(){ 
          $(this).parents(".col-sm-12").remove(); 
          x--;
         });
      
      
      $('body').on('mousedown',".date_txt", function(){
          
          $('#reg_err_msg').html('');
          $('#add_motorcycle_btn').attr("disabled", false);
          var id = $(this).attr('id');
          //console.log(id);
          var year_val = $('#year').val()-1;
            $('#'+id).datepicker({
                            minDate: new Date(year_val, 1, 1),
	                    	maxDate: new Date(),
                            dateFormat: 'dd/mm/yyyy',
                            autoClose: true,
                  });
        });
    
      
     
      
    });

           $( function() {
            $( "#add_alarm_assurance, #current_mileage_date" ).datepicker({
                dateFormat: 'dd/mm/yyyy',
                autoClose: true,
                
            });
         }); 
    
    //show other cv original
   $('#cv_original').change(function(){
        var val=$(this).find(':selected').data('id');
       
       if(val=='other')
       {
           $("#other_cv_original").show();
           $('#other_cv_original'). attr("required","required");
       }else{
            $("#other_cv_original").hide();
            $('#other_cv_original'). removeAttr("required","required");
       }
    });

</script>
<script type="text/javascript">
    $('#brand_id').change(function(){
    var brand_id = $(this).val(); 
    if(brand_id =='other'){

        $('#brand_other_input').html('<input type="text" class="form-control" style="margin-top: 6px;" id="brand_id1" name="brand_id" placeholder="Enter Your Brand Name">');
        $('#brand_id1').focus();

        $("#model_id").html('<option value="other">other</option>');
        $('#model_other_input').html('<input type="text" class="form-control" style="margin-top: 6px;" id="model_id1" name="model_id" placeholder="Enter Your Model Name">');

    }else if(brand_id){

        $.ajax({
           type:"GET",
           url:"{{url('get-model-list')}}?brand_id="+brand_id,
           success:function(res){               
            if(res){
                $('#brand_other_input').html('');
                $('#model_other_input').html('');
                $("#model_id").empty();
                $("#model_id").append('<option value="">Select</option>');
                $.each(res,function(key,value){
                    $("#model_id").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#model_id").empty();
               $('#brand_other_input').html('');
               $('#model_other_input').html('');
            }
           }
        });
    }else{
        $("#model_id").empty();
        $('#brand_other_input').html('');
        $('#model_other_input').html('');
    }      
   });
   
</script>



<script>
//datepicker
  
  function open_mileage_alarm()
  {
      $('#add_alarm_mileage_modal').modal();
  }
  function open_chain_lube_alarm()
  {
      $('#add_alarm_chain_lube_modal').modal();
  }
  function open_modal()
  {
      $('#app_modal').modal();
  }
  
  $("#alarm_mileage_btn").click(function(){
      var alarm_mileage = $('#add_alarm_mileage').val();
      //var alarm_mileage_month = $('#add_alarm_mileage_month').val();
       var alarm_mileage_days = $('#add_alarm_mileage_days').val(); 
       var set_alarm =alarm_mileage +'  '+ alarm_mileage_days;
       //alert(set_alarm);
       $('#set_alarm_mileage').val(set_alarm);
       
  });
  
  function checkdays(val)
  {
      if(val==1)
      {
          $("#add_alarm_chain_lube_month").html('<option value="Week">Week</option><option value="Month">Month</option>');
          
      }else{
          $("#add_alarm_chain_lube_month").html('<option value="Weeks">Weeks</option><option value="Months">Months</option>');
      }
      
  }
  $("#alarm_chain_lube_btn").click(function(){
      var alarm_chain_cube_days = $('#add_alarm_chain_lube_days').val();
      var alarm_chain_cube_month = $('#add_alarm_chain_lube_month').val();
      var alarm_chain_cube = $('#add_alarm_chain_lube').val();
      var set_alarm =alarm_chain_cube +' '+ alarm_chain_cube_month +' '+ alarm_chain_cube_days;
      $('#set_alarm_chain_lube').val(set_alarm);
  });
  
  
  //gyg
  function date_validate_reg(date_id){
    var date = document.getElementById(date_id);
    
   var txt_id = $('#'+date_id);
    var txt_val = txt_id.val();
    var len = txt_val.length;
    var yr_val = $('#year').val()-1;
    if(len>=14)
    {
        var arr = txt_val.split('/');
        if(yr_val>arr[2])
        {
            $('#reg_err_msg').html('Registration year is less than Motorcycle year');
            $("#add_motorcycle_btn").attr("disabled", true);
        }else{
            $('#reg_err_msg').html('');
            $('#add_motorcycle_btn').attr("disabled", false);
        }
        
    }else{
       $('#reg_err_msg').html('');
    }
    
        function checkValue(str, max) {
          if (str.charAt(0) !== '0' || str == '00') {
            var num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) num = 1;
            str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
          };
          return str;
        };
        
        date.addEventListener('input', function(e) {
          this.type = 'text';
          var input = this.value;
          if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
          var values = input.split('/').map(function(v) {
            return v.replace(/\D/g, '')
          });
          if (values[1]) values[1] = checkValue(values[1], 12);
          if (values[0]) values[0] = checkValue(values[0], 31);
          var output = values.map(function(v, i) {
            return v.length == 2 && i < 2 ? v + ' / ' : v;
          });
          this.value = output.join('').substr(0, 14);
        });
        
        date.addEventListener('blur', function(e) {
          this.type = 'text';
          var input = this.value;
          var values = input.split('/').map(function(v, i) {
            return v.replace(/\D/g, '')
          });
          var output = '';
          
          if (values.length == 3) {
            var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
            var month = parseInt(values[1]) - 1;
            var day = parseInt(values[0]);
            var d = new Date(year, month, day);
            if (!isNaN(d)) {
              document.getElementById('result').innerText = d.toString();
              var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
              output = dates.map(function(v) {
                v = v.toString();
                return v.length == 1 ? '0' + v : v;
              }).join(' / ');
            };
          };
          this.value = output;
        });
  }
      
  </script>
  
  