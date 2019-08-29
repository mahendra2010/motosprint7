
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Motoblockchain | Edit Motorcycle</title>
  <!-- end top css/js scripts -->
<link href="{{ asset('public/css/color.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/css/flaticon.css') }}" rel="stylesheet">

  @include('common.head')
  
  <style>
      .btn-hover {
        width:150px;
        font-size: 20px;
        line-height: 35px;
        height:40px;
        margin:0;
    }
  </style>
  

</head>
<body class="animated fadeIn">
<!-- header start -->
 @include('common.header')
<!-- header close -->

      <div class="automobile-subheader">
            <div class="automobile-subheader-image">
                <span class="automobile-dark-transparent"></span>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <span>Welcome To Motoblockchain</span>
                            <h1><span>{{ @Auth::user()->name }}</span></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="automobile-breadcrumb">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/my-profile/') }}">Account</a></li>
                            <li class="automobile-color">Edit Motorcycle</li>
                        </ul>
                    </div>
                </div>
            </div>
      </div>

    <div class="automobile-main-content">

      <!--// Main Section \\-->
      <div class="automobile-main-section">
        <div class="container">
          <div class="row">
              <div class="col-sm-12">
                   <h2 align="center" class="automobile-color"> {{ @$product->bike_name }} , {{ @$product->category->category_name }} / {{ @$product->brand->brand_name }} , {{ @$product->model->model_name }} </h2><hr/>
                </div>
            <!--// SideBaar \\-->
            <aside class="col-md-3">
                <!--// Widget account_links \\-->
                <div class="widget widget_account_links">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#basic_details" data-toggle="tab">Motorcycle Details <i class="icon-right-arrow"></i></a>
                        </li>
                        <li>
                            <a href="#review" data-toggle="tab"> Review <i class="icon-right-arrow"></i></a>
                        </li>
                        <li>
                            <a href="#documentation" data-toggle="tab"> Documentation <i class="icon-right-arrow"></i></a>
                        </li>
                        <!--<li>
                            <a href="#alarms" data-toggle="tab">Alarms <i class="icon-right-arrow"></i></a>
                        </li>-->

                    </ul>
                </div>
                <!--// Widget account_links \\-->
            </aside>
            <!--// SideBaar \\-->
            <div class="col-md-9">
                
                <div class="tab-content">
                    <div class="tab-pane  in active" id="basic_details">
                        <div class="automobile-account-profile">
                    <form method="post" action="{{ url('/update_motor_cycle_info') }}" enctype="multipart/form-data" id="add_moter_cycle_form" class="was-validated" autocomplete="off"> 
				{{ csrf_field() }}
			  <fieldset>
			   
			     
			    
			     <!-- <input type="hidden" name="user_id" value="{{ @session()->get('auth_user_id') }}"> -->
			   <input type="hidden" name="user_id" value="{{ @Auth::user()->id }}"> 
			   <input type="hidden" name="pro_id" value="{{ encrypt($product->id) }}"> 
			    <div class="row">
                            <div class="automobile-section-heading">
                                            <h2 class="automobile-color">Motorcycle Information</h2>
                          </div>
                </div>
			    
			    <div class="row">
				    <div class="form-group col-sm-4">
				        <label for="bike_name">Motocycle Name </label>
				        <input type="text" name="bike_name" class="form-control" id="bike_name" value="{{ @$product->bike_name }}" placeholder="Enter Motocycle Name"  > 
				    </div>
				   <div class="col-sm-4">
				       <div class="row">
				           <div class="col-sm-8">
				               <?php
    				               if(!empty($product->bike_imgs))
    				               {
    				                   ?>
    				                  <img src=" {{ url('/')}}/public/images/{{ @$product->user_id }}/{{ @$product->id }}/{{ @$product->bike_imgs }}" id="bike_preview"  class="zoom" style="width:100%; max-height:100px; object-fit: cover;">
    				                   <?php
    				               }else{
    				                   ?>
    				                   <img src=" {{ url('/')}}/public/images/default_images/default_bike.png"  class="zoom" width="100%" id="bike_preview" style="width:100%; max-height:100px; object-fit: cover;">
    				                   <?php
    				               }
				               ?>
				           </div>
				           <div class="col-sm-4">
				           <!-- <div class="input-group control-group  " > 
				            <label for="bike_imgs" id="camera_icon"><i   class="fa fa-camera" title="Edit Moter Cycle Image"></i></label>
    		                <input type="file"  name="bike_imgs" style="display:none"  id="bike_imgs" class="form-control"  style="padding:3px" >
				           </div>-->
				       </div>
			        	
    			     
    		          
    		        </div>
    		        
    		       
			    </div>
				    <div class="form-group col-sm-4">
				        <label for="category_id">Category </label> 
    				      <select  class="form-control" name="category_id" id="category_id" required disabled>
    					   <option value="{{ $product->category_id }}"> {{ @$product->category->category_name }} </option>
    					   @foreach($category as $key => $cat)
    		                  <option value="{{$key}}"> {{ $cat }}</option>
    		                @endforeach
    					   
    					</select>
				    </div>
				</div>
			   <div class="row">
				    <div class="form-group col-sm-4">
				      <label for="exampleInputEmail1"> Brand Name </label>
				      <select  class="form-control" name="brand_id" id="brand_id" required disabled>
					   <option value="{{ $product->brand_id }}"> {{ @$product->brand->brand_name }} </option>
					   @foreach($brands as $key => $brand)
		                  <option value="{{$key}}"> {{ $brand }}</option>
		                @endforeach
					</select>
				     
				      
				    </div>
				    <div class="form-group col-sm-4">
				      <label for="exampleInputPassword1">Model</label>
				      <select  name="model_id" id="model_id" class="form-control" required disabled>
						  <option value="{{ $product->model_id }}"> {{ @$product->model->model_name }} </option>
						</select>
				    </div>
				     <div class="form-group col-sm-4">
				         <label for="year"> Year </label>
				          <select  class="form-control" name="year" id="year" required disabled>
    					   <option value="{{ $product->year }}"> {{ @$product->year }} </option>
    					   
    					   @for($i=date('Y')-10; $i<=date('Y');$i++)
    		                  <option value="{{ $i }}"> {{ $i }}</option>
    		                @endfor
    					</select>
				     </div>
				  </div>
				 <div class="row">
				     <div class="form-group col-sm-4">
				         <label for="bike_cc"> CC  </label>
				          <select  class="form-control" name="bike_cc" id="bike_cc" required disabled>
    					   <option value="{{ @$product->bike_cc }}"> {{ @$product->cc_data->cc_name }} </option>
    					   
    					    @foreach($cc as $key => $cc_name)
    		                  <option value="{{$key}}"> {{ $cc_name }}</option>
    		                @endforeach
    					   
    					   
    					   
    					</select>
				     </div>
				     <div class="form-group col-sm-4">
				         <label for="cv_original">CV Original</label> 
				         <select name="cv_original" class="form-control" onchange="cvoriginal(this.value)" id="cv_original" required disabled >
				             <option value="{{ @$product->cv_original }}"> {{ @$product->cv_original_data->cv_original_name }} </option>
				             @foreach($cv_original as $key => $cv)
    		                  <option value="{{$key}}"> {{ $cv }}</option>
    		                @endforeach
				         </select>
				         <input type="text" name="other_cv_original" id="other_cv_original" class="form-control" style="display:none" placeholder="Enter Other CV Original">
        			     
				     </div>
				     <div class="form-group col-sm-4"  id="other_cv_original_div">
				        <label for="current_cv">Current CV </label>
        			      <input type="text" name="current_cv" class="form-control" id="current_cv" value=" {{ @$product->current_cv }}" placeholder="Enter Current CV"  > 
        			      <input type="file" name="current_cv_image" class="form-control" id="current_cv_image"   style="padding:3px">
				     </div>
				 </div>
				 <div class="row">
				     <div class="form-group col-sm-4">
				         <label for="exampleInputEmail1">Frame Number</label>
    				        <input type="text" name="frame_no" class="form-control" id="exampleInputEmail1" placeholder="Enter frame no" value="{{ @$product->frame_no }}"  required readonly >
    				      <!--  <input type="file" name="frame_no_image" class="form-control" id="frame_no_image"   style="padding:3px" >  -->
    				      <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload  Documentation Image</button>
				     </div>
				     <div class="form-group col-sm-4">
				      <label for="exampleInputEmail1">Frame Number</label>
				        <input type="text" name="frame_no_2" class="form-control" id="exampleInputEmail1" placeholder="Enter frame no" value="{{ @$product->frame_no_2 }}"  required readonly >
				      <!--  <input type="file" name="frame_no_image" class="form-control" id="frame_no_image"   style="padding:3px" >  -->
				      <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload Motorcycle Image</button>
				    </div>
				    <div class="form-group col-sm-4">
				         <label for="plate_no"> Plate number</label>
				          <input type="text" name="plate_no"  placeholder="Enter plate no"  class="form-control" id="plate_no"  value="{{ @$product->plate_no }}"  readonly >
				          <!--<input type="file" name="plate_no_image" class="form-control" id="plate_no_image"   style="padding:3px" > -->
				          <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload Plate No. Image</button>
        			      
				     </div>
				  
				     
				     
				 </div>
				 
				  <div class="row">
                  <div class="form-group col-md-4">
                      <label for="country">Country</label><span class="required-mark">*</span>
                      <select class="form-control" name="country" id="country" required>
                            <option value="{{ @$product->country }}"> {{ @$product->country_data->country_name }}</option>
                           @foreach($country as $key => $cnt)
    		                  <option value="{{ $key }}"> {{ $cnt }}</option>
    		                @endforeach
                          </select>
                         
                  </div>
                  <div class="form-group col-md-4">
                    <label for="region">Region</label><span class="required-mark">*</span>
                    <select class="form-control" name="region" id="region" required >
                            <option value="{{ @$product->state }}"> {{ @$product->state_data->state_name }}</option>
                     </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input type="text" name="city" id="city" class="form-control"  placeholder="Enter City" value="{{ $product->city }}" >
                </div>
              </div>
				 <hr/>
				 <div class="row" style="padding-top:10px">
				     <div class="col-sm-12" style="background:#ee953e; border-radius:10px; color:#fff;padding:5px ">
				         <h4 align="center" style="" > OWNERS & MILEAGE</h4>
				     </div>
				</div>
				 <div class="row" style="padding-top:10px; " >
				      <div class="form-group col-sm-6">
        			        <label > Are you selling it? Selling price</label></br>
        			        <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <select class="custom-select" name="currency_code" id="inputGroupSelect01" >
                                    <option value="{{ $product->currency_code }}">{{ @$product->currency_code }}</option>
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="INR">INR</option>
                                    
                                  </select>
                              </div>
                              <input type="number" class="form-control" name="selling_price" placeholder="Enter Price" value="{{ @$product->selling_price }}" />
                            </div>
        			      
        			    </div>
				      <div class="form-group col-sm-6">
        			      <!--  <label >New or Used Motorbike</label></br>
        			      <input type="radio" name="new_or_used" class="new_or_used " id="new_or_used_n" value="new" value="{{ old('new_or_used') }}" required > <label for="new_or_used_n">  Bought the Motorcycle New &nbsp; &nbsp; </label>
        			       <input type="radio" name="new_or_used" class="new_or_used " id="new_or_used_u" value="used" value="{{ old('new_or_used') }}" required> <label for="new_or_used_u"> Bought the Motorcycle Used </label>
        			    -->
        			      
        			    </div>
        			   
        		</div>
        		<?php
			       
			           /* foreach($previous_owner as $owner)
			            {
			              
			            } */
			       ?>
			       <!--
        		<div class="row input_fields_wrap" style="display:none;" id="previous_owner_div" >
        		    <div class="input-group  col-sm-12">
				    <div class="form-group col-sm-4">
			        	<label> Owner Name</label>
    		          <input type="text" name="owner_name[]"  placeholder="1 Owner name" class="form-control"   required>
			       </div>
			       
				     <div class="form-group col-sm-5">
				         <label for="first_reg_date">Registration Date (dd/mm/yyyy)</label> 
                             <input type="text" name="first_reg_date[]" class="form-control date_txt" onkeyup="date_validate(this.id)" id="first_reg_date" required  placeholder="dd/mm/yyyy"  > 
				     </div>
				     <div class="form-group col-sm-3"><br/>
                            <button class=" btn btn-primary add_field_button">Add More Owner</button>
				     </div>
				    </div>
				</div> -->
				<hr/>
				<div class="row ">
				    <div class="input-group col-sm-12">
				    <div class="form-group col-sm-4">
				        <label>MPH & KM/h</label> 
				      
				        <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <select class="custom-select" name="c_mileage_type" id="inputGroupSelect01" required >
                                    <option value="{{ $product->c_mileage_type }}"> {{ @$product->c_mileage_type }}</option>
                                    <option value="MHP">MPH</option>
                                    <option value="KM">KM</option>
                                    
                                  </select>
                              </div>
                              <input type="number" class="form-control" name="c_mileage" placeholder="Enter here" value="{{ @$product->c_mileage}}"  required  />
                        </div>
				    </div>
				    <div class="form-group col-sm-4">
				         <label>Current Mileage Image (From App)</label>
				       <!-- <input type="file" name="milege_image" id="milege_image" class="form-control"    style="padding:3px" disabled >  -->
				       <button type="button" class="btn btn-warning form-control" onclick="open_modal()">Upload Mileage Image</button>
				      
				        
				    </div>
				    <div class="form-group col-sm-4">
				     <label>Current Mileage Date (From App) </label>
				        <input type="date" name="current_mileage_date" id="current_mileage_date" class="form-control" >
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
				        <label>Add alarm for Mileage</label><br/>
				        <input type="text " name="set_alarm_mileage" id="set_alarm_mileage" class="form-control" onfocus="open_mileage_alarm()" placeholder="Activate alarm every " value="{{ @$product->add_alarm_mileage}}" onkeydown="return false;"  />
				    </div>
				    <div class="form-group col-sm-4">
				        <label>Add alarm for assurance</label><br/>
				        <input type="text" id="add_alarm_assurance" name="add_alarm_assurance" class=" form-control" value="{{ @$product->add_alarm_assurance}}" placeholder="dd/mm/yyyy"  onkeyup="date_validate(this.id)" />
				    </div>
				    <div class="form-group col-sm-4">
				        <label>Add alarm for chain lube</label><br/>
				        <input type="text" name="set_alarm_chain_lube" id="set_alarm_chain_lube" class="form-control" onfocus="open_chain_lube_alarm()" value="{{ @$product->add_alarm_chain_lube }}" placeholder="set alarm"  / >
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
                                <div class="col-sm-6">
                                    <select name="add_alarm_chain_lube" id="add_alarm_chain_lube" class="form-control">
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
                                
                                <div class="col-sm-6">
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
			             <input type="submit" style="line-height: inherit;" class="btn-hover color-4" value="Update">
			        </div>
			    </div>
			   
			    
			    
			   
			  </fieldset>
			</form>
                        </div>
                    </div>
                <div class="tab-pane fade" id="documentation">
                        <div class="row">
                            <h2 class="automobile-typography-heading automobile-color">Documentation of Motorcycle</h2>
                            <div class="panel-group automobile-typography-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            
                            @if(count($documentation) > 0)
                              @foreach($documentation as $doc)  
                               
                              <div class="panel panel-default ">
                                <div class="panel-heading" role="tab" id="heading{{ $doc['list_id']}}">
                                  <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $doc['list_id']}}" aria-expanded="true" aria-controls="collapse{{ $doc['list_id']}}" class="">
                                    {{ $doc['list_name'] }}   <span class="pull-right" style="padding-right:30px;">{{ count($doc['media_files']) }} Docs </span>
                                    </a>
                                   
                                  </h4>
                                  
                                </div>
                                <div id="collapse{{ $doc['list_id']}}" class="panel-collapse collapse in " role="tabpanel" aria-labelledby="heading{{ $doc['list_id']}}" aria-expanded="true" >
                                  <div class="panel-body" style="background:#f6f6f68f">
                                     
                                      @if(count($doc['media_files']) > 0)
                                        @foreach($doc['media_files'] as $media)
                                        
                                            <div class="row">
                                              <div class="col-sm-4">
                                                  <div class="imgbtn_wrap">
                                                      <img src="{{ url('/')}}/public/images/{{$media->user_id}}/{{ $media->product_id }}/{{$media->file}}" class="img-responsive" style="width:100%">
                                                      <!--<div class="hover_btns">
                                                          <a href="javascript:get_document_files({{ $media->id }} )"   > <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                      </div>-->
                                                  </div>
                                              </div>
                                              <div class="col-sm-8">
                                                  <h6><b id="doc_title_{{$media->id}}"> {{ $media->title }} </b></h6>
                                                  <p id="doc_desc_{{$media->id}}"> {{ $media->description }} </p>
                                                  <time class="small" datetime="{{$media->updated_at}}"><strong>Modify Date :</strong> {{ date("d M Y h:i A", strtotime($media->updated_at)) }}</time>
                                                  
                                             
                                             <div class="row" style="float:right"> 
                                               <a href="javascript:get_document_files({{ $media->id }} )"  class="btn btn-sm btn-primary pull-right" value="Edit"><i class="fa fa-pencil" aria-hidden="true"></i> Edit </a>
                                             </div>
                                            </div>
                                          </div>
                                          
                                         <hr/>
                                             
                                        @endforeach
                                        @else
                                            <div class="row">
                                               <h6>No {{ $doc['list_name'] }} Documents uploaded. </h6> 
                                               <h6>Please upload Docs from App</h6>
                                            </div>
                                        
                                      @endif
                                      
                                     
                                  <br/>
                                      
                                    </div>
                                </div>
                              </div>
                               @endforeach   
                              @endif
                              
                              
                              <!--<div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                  <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      Section 2
                                    </a>
                                  </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                                  <div class="panel-body"><p>Nam elit agna, endrerit sit amet, tincidunt ac, viverra sed, nulla. Donec porta diam eu massa. Quisque diam lorem, interdum vitae,dapibus ac, scel erisque vitae, pede. Donec eget tellus non erat lacinia fermentum.</p></div>
                                </div>
                              </div>-->
                              
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="review">
                        <div class="automobile-account">
                            <form  method="post" id="description_form">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" id="productid" value="{{ encrypt($product->id) }}">
                               <div class="row">
                                <div class="automobile-section-heading">
                                        <h2 class="automobile-color">Write Review /Description of product</h2>
                                </div>
                                </div>
                                <div class="col-sm-12" style="padding-right: 0px !important; padding-left: 3px !important;">
                                    <!-- <textarea  name="description" id="desc" onfocusout="save_description()" rows="20"  placeholder="Enter  your review here " required > {{ $product->description }} </textarea>-->
                                        <textarea name="description" id="desc"  rows="10" class="form-control" > {{ $product->description }} </textarea>
                                </div>
                                  <div class="col-sm-12" align="right">
                			        <div class="form-group">
                			             <input type="submit" id="description_btn"  class="btn-hover color-4" value="Update">
                			        </div>
                			    </div>
                			    <br/>
                          </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="alarms">
                        <div class="automobile-account">
                         <h1> Alarm Tab</h1>
                        </div>
                    </div>
                    
                </div>
            </div>
          </div>
        </div>
      </div>
      <!--// Main Section \\-->
      
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
                            <button type="button"  class="btn btn-danger" data-dismiss="modal">Ok</button>
                          </div>
                    
                        </div>
                      </div>
                    </div>
    			    
			    </div>

    </div>
    <div class="clearfix"></div>
    
    
    
    <!---->
  
  <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg" >
    
       <!--Modal Content-->
        
        <div class="modal-content" id="document_content">
          
          
          
        </div>
        
    
      </div>
    </div>
  
  
  <!---->
<!-- footer start -->
 @include('common.footer')
<!-- footer close -->


<!-- CK Editor -->
<script src="https://motoblockchain.us/public/backend/components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
   // CKEDITOR.replace('editor1')
    CKEDITOR.replace('desc');
    //bootstrap WYSIHTML5 - text editor
   // $('.textarea').wysihtml5()
   /*CKEDITOR.instances['desc'].on("blur", function() {
            save_description();
    });*/
    
  })
  
  
</script>

            <!-- Modal content-->
<script type="text/javascript">
                
    //To hide div after 5 sec
     function dismiss_message()
     {
         setTimeout(function() {
            $('.alert-dismissible').fadeOut('fast');
        }, 5000);
     }
     
                    
        $('#description_btn').on('click', function(event){
            event.preventDefault();
           // var description  =  $('#desc').val();
            var product_id       =  $('#productid').val();
            for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var description = CKEDITOR.instances['desc'].getData();
                
           // alert(product_id);
       
                $.ajax({
                      url: "{{url('/')}}/update_description",
                      type: 'POST',
                      data: {"product_id": product_id, "description":description, "_token": "{!! csrf_token() !!}"},
                      success:function(res){
                        //alert(res);
                        if(res == 1){
                            $("#description_form").after('<div class="clearfix"></div><div class="alert alert-success alert-dismissible"> Saved Successfully <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                          
                        }else {
                            $("#description_form").after('<div class="clearfix"></div><div class="alert alert-danger alert-dismissible"> Please update text then update <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                        }
                     }
                });
                
                dismiss_message();
        });
        
        //       
        function get_document_files(id )
        {
            $('#myModal').modal();
             $.ajax({
                   type:'POST',
                   url:'{{ url('/')}}/get_document_files',
                   data:{
                       "id" : id,
                       "_token": "{!! csrf_token() !!}"
                       },
                
                   success:function(res) {
                      console.log(res);
                      $("#document_content").html(res);
                   }
                });
        }
        //end 
        
        //updated documentation
        
         //send email form ajax by append
        $(document).on('submit', '#update_document_form', function(event){
            event.preventDefault();
            //alert('ferg');
           var form = $(this);
          
           $.ajax({
               type:'POST',
               url:'{{ url('/')}}/update_document_files',
               data: form.serialize(),
               success:function(res) {
                  //$("#msg").html(data.msg);
                  console.log(res);
                 //$("#sendEmail_form")[0].reset();
                  var obj = jQuery.parseJSON(res);
                     if(obj.result=="TRUE")
                    {  
                       
                        //$("#s_message").addClass("text-success");
                         // $("#s_message").text(obj.message);
                         $("#s_message").html('<div class="alert alert-success alert-dismissible">Successfully updated.. </div>');
                          
                          $("#doc_title_"+obj.id).text(obj.title);
                           $("#doc_desc_"+obj.id).text(obj.desc);
                           dismiss_message();
                        }else if(obj.result=="FALSE"){ 
                            //$("#s_message").addClass("text-danger");
                            //$("#s_message").text(obj.message);
                             $("#s_message").html('<div class="alert alert-danger alert-dismissible">Have not changed Anything.. </div>');
                          
                            dismiss_message();
                        }
                     
               }
            });
          });
          
    
                    
                    
                    
                    
                    
                    
                </script>


<script>
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

    $("#camera_icon").hover(function() {
        $(this).css('cursor','pointer');
    }, function() {
        $(this).css('cursor','auto');
    });

    $('#country').change(function(){
    var country_id = $(this).val();    
    if(country_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-state-list')}}?country_id="+country_id,
           success:function(res){               
            if(res){
                $("#region").empty();
                $("#region").append('<option>Select</option>');
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


    $(document).ready(function() {
        
      $(".new_or_used").click(function(){
	      if($(this).val() === "used")
	        $("#previous_owner_div").show("fast");
	      else
	        $("#previous_owner_div").hide("fast");
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
    			//$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
    			$(wrapper).append('<div class="col-sm-12 input-group "><div class="form-group col-sm-4"><input type="text" name="owner_name[]"  placeholder=" '+x+' Owner name" class="form-control"   required></div><div class="form-group col-sm-4"> <input type="text" name="first_reg_date[]" class="form-control date_txt" onkeyup="date_validate(this.id)" id="date'+x+'" placeholder="dd/mm/yyyy"  required ></div><div class="form-group col-sm-4"><button class="btn btn-danger remove_field">Remove</button></div></div>'); 
    	
    		}
    	});
    	/*$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    		e.preventDefault(); $(this).parent('span').remove(); x--;
    	})*/
    	$("body").on("click",".remove_field",function(){ 
          $(this).parents(".col-sm-12").remove(); 
          x--;
      });
    });
    
    
    //show other cv original
    function  cvoriginal(val){
        //alert(val);
       if(val=='other')
       {
           $("#other_cv_original").show();
           $('#other_cv_original'). attr("required","required");
       }else{
            $("#other_cv_original").hide();
            $('#other_cv_original'). removeAttr("required","required");
       }
    }

</script>
<script type="text/javascript">
    $('#brand_id').change(function(){
    var brand_id = $(this).val();    
    if(brand_id){
        $.ajax({
           type:"GET",
           url:"{{url('get-model-list')}}?brand_id="+brand_id,
           success:function(res){               
            if(res){
                $("#model_id").empty();
                $("#model_id").append('<option>Select</option>');
                $.each(res,function(key,value){
                    $("#model_id").append('<option value="'+key+'">'+value+'</option>');
                });
           
            }else{
               $("#model_id").empty();
            }
           }
        });
    }else{
        $("#model_id").empty();
        
    }      
   });
   
</script>

 <script type="text/javascript">
      $('.nav-tabs li').on('click', function(){
        $('.nav-tabs li').removeClass('active');
        $(this).toggleClass('active');
      });
  </script>


<script>
//datepicker

  $( function() {
        $( "#add_alarm_assurance, #current_mileage_date" ).datepicker({
            dateFormat: 'dd/mm/yyyy',
            autoClose: true,
        });
  } ); 
  
  
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
  $("#alarm_chain_lube_btn").click(function(){
      var alarm_chain_cube_days = $('#add_alarm_chain_lube_days').val();
      //var alarm_chain_cube_month = $('#add_alarm_chain_lube_month').val();
      var alarm_chain_cube = $('#add_alarm_chain_lube').val();
      var set_alarm =alarm_chain_cube +'  '+ alarm_chain_cube_days;
      $('#set_alarm_chain_lube').val(set_alarm);
  });
      
  </script>
  
  <script>
      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    $('#bike_preview').attr('src', e.target.result);
                }
        
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        $("#bike_imgs").change(function(){
            readURL(this);
        });
  </script>
  
</body>
</html>