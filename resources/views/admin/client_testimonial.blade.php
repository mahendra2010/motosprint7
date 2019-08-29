@extends('admin.common.admin_header_sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Testimonial</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Testimonial</li>
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
              <h3 class="box-title">All Testimonial List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Photo</th>
                  <th>Name</th>
                  <th> Product Name</th>
                  <th>Message </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               
             

                  <script>
                     $(function() {
                           $('#example1').DataTable({
                           processing: true,
                           serverSide: true,
                           ajax: '{{ url("/admin/client_testimonial_list") }}',
                           columns: [
                                    { data: 'id', name: 'id' },
                                    { data: 'client_pic', name: 'client_pic' },
                                    { data: 'client_name', name: 'client_name' },
                                    { data: 'product_name', name: 'product_name' },
                                    { data: 'message', name: 'message' },
                                    { data: 'status', name: 'status' },
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
    
    <!-- Testimonial  Modal -->
    <div id="testimonial_modal" class="modal fade" role="dialog">
      <div class="modal-dialog" id="testimonial_layout">
    
        <!-- Modal content-->
       
    
      </div>
    </div>
    
   
    
    <script type="text/javascript">
    
    //To hide div after 5 sec
     function dismiss_message()
     {
         setTimeout(function() {
            $('.alert-dismissible').fadeOut('fast');
        }, 5000);
     }
       
        function EditTestimonialLayout(elem){
            var id  = elem;
        $('#testimonial_modal').modal('show');
         $.ajax({
               type:'POST',
               url:'{{ url('/')}}/admin/testimonial_layout',
               data:{
                   "id" : id,
                   "_token": "{!! csrf_token() !!}"
                   },
               success:function(res) {
                  //console.log(res);
                  $('#testimonial_layout').html(res);
                
                     
                 
               }
            });
        }
        
        //send email form ajax by append
        $(document).on('submit', '#testimonial_form', function(event){
            event.preventDefault();
          //alert('hi');
          var form = $(this);
           //alert(formdata);
           $.ajax({
               type:'POST',
               url:'{{ url('/')}}/admin/testimonial_update',
               data: form.serialize(),
               success:function(res) {
                  //$("#msg").html(data.msg);
                  console.log(res);
                  if(res==1)
                  {
                      $("#testimonial_form").before('<div class="alert alert-success alert-dismissible">Successfully updated... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                    dismiss_message();
                  }else{
                      $("#testimonial_form").before('<div class="alert alert-danger alert-dismissible">Failed !! Please try Again ... <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>');
                  dismiss_message();
                      
                  }
                 
               }
            });
          });
    
        function deleteClientTestimonial(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to delete this Testimonial ?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "delete_testimonial/"+id,
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
                          var url = "{{ url('/admin/client_testimonial') }}";
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
        function disable_client_testimonial(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to  Disable this Testimonial ?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "disable_testimonial/"+id,
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
                          var url = "{{ url('/admin/client_testimonial') }}";
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
        function Activate_client_testimonial(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to Activate this Testimonial ?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "active_testimonial/"+id,
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
                          var url = "{{ url('/admin/client_testimonial') }}";
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

