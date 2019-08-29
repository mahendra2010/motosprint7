@extends('admin.common.admin_header_sidebar')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Blogs Comments</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Blogs Comments</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <div class="col-sm-5 col-sm-offset-3 Mypopup" style="background:#ecf0f5; color:#000;box-shadow: 0 2px 2px 0 rgba(76, 175, 80, 0.14), 0 3px 1px -2px rgba(76, 175, 80, 0.2), 0 1px 5px 0 rgba(76, 175, 80, 0.12);border-radius: 0px;position: fixed;top:-175px;left: 100px;z-index:999;padding:15px; display: none">
                    <p class="poptext" style="padding-top: 22px;font-weight: bold; font-size:20px"></p>
                    <button class="btn btn-sm btn-success pull-right" id="yes"  style="margin-top: 0px;">
                    YES
                    </button>
                    <button class="btn btn-sm btn-danger pull-right" style="margin-right:5px;margin-top: 0px;" id="no">NO</button>  
            </div>
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">All Blogs Comments list</h3> <a href="{{ url('/admin/add_blog')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>  Blog Comments</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>ID </th>
                  <th>Blog Title</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Website</th>
                  <th>Comment</th>
                   <th>status</th>
                  <th>Posted on</th>
                 
                  <th width="60px">Action</th>
                </tr>
                </thead>
                <tbody>
            
                <script>
                     $(function() {
                           $('#example1').DataTable({
                           processing: true,
                           serverSide: true,
                           ajax: '{{ url("/admin/blog_comment_list") }}',
                           columns: [
                                    { data: 'id', name: 'id' },
                                    { data: 'blog_title', name: 'blog_title' },
                                    { data: 'name', name: 'name' },
                                    { data: 'email', name: 'email' },
                                    { data: 'website', name: 'website' },
                                    { data: 'comment', name: 'comment' },
                                    { data: 'status', name: 'status' },
                                    { data: 'created_at', name: 'created_at' },
                                    
                                    { data: 'action', name: 'action' }
                                 ]
                        });
                     });
                     </script>
                
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    
    <script type="text/javascript">
    
        function deleteBlogComment(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to delete this Blog ?');  
            //$("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "<?= url('/')?>/admin/delete_blog_comment/"+id,
                    type: 'GET',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                     beforeSend: function(){
                        $(this).text('processing...');
                    },
                    success:function(res){
                        console.log(res);
                        
                        var obj = jQuery.parseJSON(res);
                        //var obj = JSON.parse(res);
                        if(obj.result=="TRUE")
                        {
                        $("#yes").css({'display':'none'});
                        $('#no').text('Cancel');
                        $(".poptext").text(obj.message);
                          var url = "{{ url('/admin/blog-comments') }}";
                        window.location.href = url;
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
        
        
        //TO DISABLE USER
        function reject_blog_comment(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to  Reject  this Blog  comment ?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "<?= url('/') ?>/admin/reject_blog_comment/"+id,
                    type: 'GET',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                     beforeSend: function(){
                        $(this).text('processing...');
                    },
                    success:function(res){
                        console.log(res);
                        
                        var obj = jQuery.parseJSON(res);
                        //var obj = JSON.parse(res);
                        if(obj.result=="TRUE")
                        {
                        $("#yes").css({'display':'none'});
                        $('#no').text('Cancel');
                        $(".poptext").text(obj.message);
                          var url = "{{ url('/admin/blog-comments') }}";
                        window.location.href = url;
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
        
        //activate user
         //TO DISABLE USER
        function publish_blog_comment(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to Publish this Blog comment?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "<?= url('/')?>/admin/publish_blog_comment/"+id,
                    type: 'GET',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                     beforeSend: function(){
                        $(this).text('processing...');
                    },
                    success:function(res){
                        console.log(res);
                        
                        var obj = jQuery.parseJSON(res);
                        //var obj = JSON.parse(res);
                        if(obj.result=="TRUE")
                        {
                        $("#yes").css({'display':'none'});
                        $('#no').text('Cancel');
                        $(".poptext").text(obj.message);
                          var url = "{{ url('/admin/blog-comments') }}";
                        window.location.href = url;
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

  @endsection