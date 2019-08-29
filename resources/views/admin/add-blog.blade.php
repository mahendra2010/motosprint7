@extends('admin.common.admin_header_sidebar')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Add Blog</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Blog</li>
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
                    <div class="col-sm-8">
                        <h3 class="box-title">Add New Blog
                      </h3><br/>
                      <small>Please don not refresh page while adding blog. If you refresh page then you loose "Auto Save " property</small>
                    </div>
                    <div class="col-sm-4">
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
               
                   	{{ csrf_field() }}
              <div class="form-group">
                  <br/>
                  <label>Blog title</label>
                  <input type="hidden" class="form-control" name="blog_id" id="blog_id" value="0">
                   <input type="hidden" class="form-control" name="posted_by" id="posted_by" value="{{ ucfirst(Auth::guard('admin')->user()->name) }}">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter Blog title" value="{{ old('title') }}" required>
                  {!! $errors->first('title', '<span class="help-block text-red"> :message </span>') !!}
                 
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
                  <div class="form-group">
                      <div class="row">
                          <div class="col-sm-6">
                              <label>Select one or Multiple Tags</label>
                          </div>
                          <div class="col-sm-6">
                              <a class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Add Tag</a>
                          </div>
                      </div>
                   
                    <select class="form-control select2" id="tags" name="tags[]" multiple="multiple" data-placeholder="Select a Tags" style="width: 100%;">
                        @foreach($tags as $tag)
                         <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                        @endforeach
                      
                    </select>
                  </div>

              </div>
              <div class="form-group">
                  <label>Blog Image</label>
                  <input type="file" class="form-control" name="blog_img" placeholder="Enter Blog title" required>
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
            <!--
            <div class="box-body pad">
                
               
             
                <textarea class="textarea" name="blog_content" placeholder="Place some text here"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" ></textarea>
             
             
            </div> -->
            
            
           
            <div class="box-body pad">
        
                    <textarea id="editor1" name="blog_content" rows="20"  placeholder="Enter Blog description here " required >
                                     {{ old('blog_content') }}
                    </textarea>
               
        
             
             
             
            </div>
            
            
                 <div class=" form-group input_fields_wrap"   >
        		    <div class="col-sm-12 input-group">
				    <div class="form-group col-sm-4">
			        	<label> Add One or More Images (Bottom gallery)</label>
    		          <input type="file" name="img_name[]" class="form-control "  />
			       </div>
				     <div class="form-group col-sm-4">
				         <br/>
				         <a class=" btn btn-primary add_field_button" title="Add More Images"><i class="fa fa-plus" aria-hidden="true"></i> </a>
				     </div>
				     <div class="form-group col-sm-4"><br/>
                           
				     </div>
				    </div>
				</div>
				<div class="row  input-group">
				    <div class="col-sm-11 form-group">
				        <input type="submit" name="add_blog" class="btn btn-primary pull-right" value="Submit">
				    </div>
				    <div class="col-sm-1"></div>
				     
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
        <form method="post" >
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
    
    
    $("#add_tag_btn").click(function(event) {
            var tag_name= $("#tag_name").val();
              //alert(tag_name);
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
                $.ajax(
                {
                    url: "add_tag",
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
                        //$(".poptext").text(obj.message);
                          //var url = "{{ url('/admin/users') }}";
                        //window.location.href = url;
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
 
 </script>
 
 
 
    
 @endsection
