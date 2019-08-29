@extends('admin.common.admin_header_sidebar')

@section('content')
<?php
use \App\Http\Controllers\BlogController;
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Edit Blog</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Blog</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="col-sm-5 col-sm-offset-3 Mypopup" style="background:#ecf0f5; color:#000;box-shadow: 0 2px 2px 0 rgba(76, 175, 80, 0.14), 0 3px 1px -2px rgba(76, 175, 80, 0.2), 0 1px 5px 0 rgba(76, 175, 80, 0.12);border-radius: 0px;position: fixed;top:-175px;left: 100px;z-index:999;padding:15px; display: none">
                    <p class="poptext" style="padding-top: 22px;font-weight: bold; font-size:20px"></p>
                    <button class="btn btn-sm btn-success pull-right" id="yes"  style="margin-top: 0px;">
                    YES
                    </button>
                    <button class="btn btn-sm btn-danger pull-right" style="margin-right:5px;margin-top: 0px;" id="no">NO</button>  
            </div>
          <!-- /.box -->
     <form action="{{ url('/admin/update_blog')}}" id="edit_blog_form" method="post" enctype="multipart/form-data">
          <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="box-title">Edit  Blog
                        <small>Simple and fast</small>
                      </h3>
                    </div>
                    <div class="col-sm-6">
                         <a href="{{ url('/admin/blogs') }}" class="btn btn-primary pull-right"><i class="fa fa-eye"></i> View Blogs</a>
                    </div>
                </div>
              
             
              @if(session('info'))
    					
    			<div class="alert alert-success alert-dismissible successMessage">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Success</h4>
                    {{ session('info') }}
                  </div>
        					
                    @elseif(session('fail_info'))
                    <div class="alert alert-danger alert-dismissible successMessage">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Fail</h4>
                        {{ session('fail_info') }}
                      </div>
                    
        		@endif
              
                   
              <div class="form-group">
                  <br/><input type="hidden" class="form-control" id="blog_id" name="blog_id"  value="{{ $blogs->id }}" >
                  	{{ csrf_field() }}
                  <label>Blog title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter Blog title" value="{{$blogs->title}}" required>
                  {!! $errors->first('title', '<span class="help-block text-red"> :message </span>') !!}
                 
              </div>
              <div class="form-group">
                  <div class="form-group">
                      <div class="row">
                          <div class="col-sm-6">
                              <label>Select one or Multiple Tags</label>
                          </div>
                          <div class="col-sm-6">
                              <a class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Add New Tag</a>
                          </div>
                      </div>
                   
                    <select class="form-control select2" id="tags" name="tags[]" multiple="multiple" data-placeholder="Select a Tags" style="width: 100%;" required>
                         <?php 
                            $tagss = $blogs->tags ;
                            $myArray = explode(',', $tagss);
                            
                            foreach($myArray as $my_Array){ ?>
                                
                                <option value="{{$my_Array}}" selected>{{ @BlogController::tag_name($my_Array) }}</option>
                            <?php
                            }
                          ?>
                          
                        @foreach($tags as $tag)
                         <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                        @endforeach
                      
                    </select>
                  </div>

              </div>
             <!-- <div class="form-group">
                  <label>Blog Category</label>
                 <select name="blog_cat" class="form-control">
                     <option value=""> Select category</option>
                     <option value="cat_1"> Cat 1</option>
                     <option value="cat_2"> Cat 2</option>
                     <option value="cat_3"> Cat 3</option>
                 </select>
              </div>-->
              <div class="form-group">
                  <div class="row">
                      <div class="col-sm-4">
                        <?php
    				               if(!empty($blogs->blog_img))
    				               {
    				                   ?>
    				                  <img src="{{ url('/') }}/public/images/blog_images/{{ $blogs->id}}/{{ $blogs->blog_img}}" id="blog_preview"  class="zoom" style="width:100%; max-height:200px; object-fit: cover;">
    				                   <?php
    				               }else{
    				                   ?>
    				                   <img src=" {{ url('/')}}/public/images/default_images/default_bike.png"  class="zoom" id="blog_preview" style="width:100%; max-height:200px; object-fit: cover;">
    				                   <?php
    				               }
				               ?>
                      </div>
                      <div class="col-sm-8">
                          <label for="blog_img"><i   class="fa fa-camera camera_icon" title="Change Blog Image"></i></label>
    		                <input type="file" style="display:none" name="blog_img"  id="blog_img" class="form-control"  style="padding:3px" >
                          
                      </div>
                  </div>
                 
              </div>
               <div class="form-group">
                <select name="status" class="form-control">
                    <option value="{{ $blogs->status }}"> {{ $blogs->status }}</option>
                    <option value="Deactive"> Deactive </option>
                    <option value="Active"> Active </option>
                </select>
            </div>
              <!-- tools box -->
              <div class="pull-right box-tools">
                 
                  <!--
                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> -->
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
              <textarea id="editor1" class="blog_content"  name="blog_content" rows="20"   placeholder="Enter Blog description here ">
                                     {{$blogs->blog_content}} 
                    </textarea>
              
             
              <br/>
            
            </div>
            <div class="col-sm-12 input-group">
                @if(count($blog_media) > 0 )
                    @foreach($blog_media as $media)
                    <div class="col-sm-3 media_gallery" >
                        <a href="void:javascript(0)" id="{{ $media->id}}" onclick="delete_blog_media(this.id)"><i class="fa fa-trash pull-right" title="Delete" style="top:0; font-size:20px; color:red"></i></a>
                        <img src="{{ url('/')}}/public/images/blog_images/{{ $media->blog_id}}/{{ $media->img_name}}" width="90%"/>
                        
                    </div>
                    @endforeach
                @endif
            </div>
            <div class=" form-group input_fields_wrap"   >
        		    <div class="col-sm-12 input-group">
				    <div class="form-group col-sm-4">
			        	<label> Add One or More Images (Bottom gallery)</label>
    		          <!--<input type="file" name="img_name[]" class="form-control " required />-->
			       </div>
				     <div class="form-group col-sm-4">
				         
				         <a class=" btn btn-primary add_field_button" title="Add More Images"><i class="fa fa-plus" aria-hidden="true"></i> </a>
				     </div>
				     <div class="form-group col-sm-4"><br/>
                           
				     </div>
				    </div>
				</div>
				
				<div class="col-sm-12 input-group">
				    <div class=" form-group">
				        <input type="submit" name="add_blog" class="btn btn-primary " value="Submit">
				        <br/>
				    </div>
				
				</div>
            
            
           
            
          </div>
           </form>
        </div>
        <!-- /.col-->
        
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
    
    
    <div class="modal fade" id="modal-default">
        <form method="post"  >
            {{ csrf_token() }}
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add tags</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label>Tag Name</label>
                    <input type="text" class="form-control" name="tag_name" id="tag_name" placeholder="Enter Tag Name">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="add_tag_btn" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          </form>
          <!-- /.modal-dialog -->
        </div>
        
       
  
        
        
     <script type='text/javascript'>
        $(document).ready(function(){
            $("#title").blur(function(){
              AutosaveBlogData()
            });
        
        });
        
      

        // Save data
        function AutosaveBlogData(){
            var blog_id = $('#blog_id').val();
        
            if(blog_id == '0')
            {
                 var title = $('#title').val();
                    for ( instance in CKEDITOR.instances ) {
                        CKEDITOR.instances[instance].updateElement();
                    }
                    var blog_content = CKEDITOR.instances['editor1'].getData();
                    
                    //data.append('content', CKEDITOR.instances['editor1'].getData());
              
                var formData = new FormData($("#edit_blog_form")[0]);
                    if(title != '' || blog_content != ''){
                        // AJAX request
                        $.ajax({
                           type:'POST',
                           url:'{{ url('/')}}/admin/auto_insert_blog',
                            data: formData, 
                            contentType: false,       
                            cache: false,            
                            processData:false, 
                           success:function(res) {
                              //$("#msg").html(data.msg);
                              console.log(res);
                              $("#blog_id").val(res);
                            
                           }
                    });
                    }
                
            }else{
                var title = $('#title').val();
                for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                }
                var blog_content = CKEDITOR.instances['editor1'].getData();
                
                //data.append('content', CKEDITOR.instances['editor1'].getData());
          
            var formData = new FormData($("#edit_blog_form")[0]);
                if(title != '' || blog_content != ''){
                    // AJAX request
                    $.ajax({
                       type:'POST',
                       url:'{{ url('/')}}/admin/auto_update_blog',
                        data: formData, 
                        contentType: false,       
                        cache: false,            
                        processData:false, 
                       success:function(res) {
                          //$("#msg").html(data.msg);
                          console.log(res);
                        
                       }
                });
                }
            }
            
          
            
            
        }
        </script>    
    
    <script type="text/javascript">
    
    //add new tag ajax
     $("#add_tag_btn").click(function(event) {
            var tag_name= $("#tag_name").val();
              //alert(tag_name);
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                {
                    url: "<?php echo url('/')?>/admin/add_tag",
                    type: 'POST',
                    data: {
                        "tag_name": tag_name,
                        "_token": token,
                    },
                     beforeSend: function(){
                        $(this).text('processing...');
                    },
                    success:function(res){
                        console.log(res);
                        
                        var obj = jQuery.parseJSON(res);
                        if(obj.result=="TRUE")
                        {
                            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
                            $(".poptext").text('Successfully Added');
                            $("#yes").css({'display':'none'});
                            $('#no').text('Ok');
                            var tag_id = obj.tag_id;
                            var tag_name = obj.tag_name;
                            $("#tags").append("<option value="+tag_id+">"+tag_name+"</option>");
                            
                           $('#modal-default').modal('hide');
                       
                        }else if(obj.result=="FALSE"){ 
                             $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
                            $(".poptext").text('Failed please try again');
                            $("#yes").css({'display':'none'});
                            $('#no').text('Ok');
                             $('#modal-default').modal('hide');
                        }
                    }
                });
                
                $("#no").click(function(event) {
                /* Act on the event */
                $(".Mypopup").animate({top:-150}, 800).css({'display':'none'});
            });
              
              
            });
    
        function delete_blog_media(elem){
            var id = elem;
          
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to delete this Blog Gallery Item ?');  
            //$("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                {
                    url: "<?php echo url('/')?>/admin/delete_blog_media/"+id,
                    type: 'GET',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                     beforeSend: function(){
                        $(this).text('processing...');
                    },
                    success:function(res){
                        //console.log(res);
                       
                        
                        var obj = jQuery.parseJSON(res);
                        //var obj = JSON.parse(res);
                        if(obj.result=="TRUE")
                        {
                        
                        $("#yes").css({'display':'none'});
                        $('#no').text('Cancel');
                        $(".poptext").text(obj.message);
                        location.reload();
                        
                          //var url = "{{ url('/admin/blogs') }}";
                        //window.location.href = url;
                        }else if(obj.result=="FALSE"){ 
                            $("#yes").css({'display':'none'});
                            $('#no').text('Cancel');
                            $(".poptext").text(obj.message);
                        }
                    }
                });
            });
            $("#no").click(function(event) {
                /* Act on the event */
                $(".Mypopup").animate({top:-150}, 800).css({'display':'none'});
            });
            
        }
        </script>
         <script>
    //$(document).ready(function() {
    	var max_fields      = 15; //maximum input boxes allowed
    	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
    	var add_button      = $(".add_field_button"); //Add button ID
    	
    	var x = 1; //initlal text box count
    	$(add_button).click(function(e){ //on add input button click
    		e.preventDefault();
    		if(x < max_fields){ //max input box allowed
    			x++; //text box increment
    			$(wrapper).append('<div class="col-sm-12 input-group"><div class="form-group col-sm-4"> <input type="file" name="img_name[]" class="form-control " required /> </div><div class="form-group col-sm-4"> <button class="btn btn-danger remove_field"><i class="fa fa-minus" aria-hidden="true"></i></button> </div><div class="form-group col-sm-4"> </div></div>'); 
    	
    		}
    	});
    	
    	$("body").on("click",".remove_field",function(){ 
          $(this).parents(".col-sm-12").remove(); 
          x--;
         });
      
    //});
    
    
 
 </script>
    
 
 
 @endsection
 
