@extends('admin.common.admin_header_sidebar')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Motorcycles List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Blogs</li>
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
              <h3 class="box-title">All Motorcycles  list</h3> 
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>ID </th>
                  <th>Image</th>
                  <th>Name/Category</th>
                  <th>Brand/Model</th>
                  <th>CC/CV</th>
                  <th>Posted By</th>
                  <th>Posted On</th>
                  <th>status</th>
                  <th width="60px">Action</th>
                </tr>
                </thead>
                <tbody>
            
                <script>
                     $(function() {
                           $('#example1').DataTable({
                           processing: true,
                           serverSide: true,
                           ajax: '{{ url("/admin/motor_cycle_data") }}',
                           columns: [
                                    { data: 'id',           name: 'id' },
                                    { data: 'bike_imgs',    name: 'bike_imgs' },
                                    { data: 'name_category',name: 'name_category' },
                                    { data: 'brand_model',  name: 'brand_model' },
                                    { data: 'cc_cv',        name: 'cc_cv' },
                                    { data: 'posted_by',     name: 'posted_by' },
                                    { data: 'created_at',    name: 'created_at' },
                                    { data: 'status',        name: 'status' },
                                    { data: 'action',        name: 'action' }
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
    
        function deleteProduct(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to delete this Product ?');  
            //$("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "deleteproduct/"+id,
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
                          var url = "{{ url('/admin/products') }}";
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
        function disable_product(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to  Disable this Product ?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "disable_product/"+id,
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
                          var url = "{{ url('/admin/products') }}";
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
        function Activate_product(elem){
            var id = elem;
            $(".Mypopup").animate({top:75}, 800).css({'display':'block'});
            $(".poptext").text('Do you want to Activate this Product ?');  
            $("#yes").attr("data-id", id);
            $("#yes").click(function(event) {
                /* Act on the event */
              //var user_id= $(this).data('id');
                var token = $("meta[name='csrf-token']").attr("content");
               //alert(user_id);
                $.ajax(
                {
                    url: "activate_product/"+id,
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
                          var url = "{{ url('/admin/products') }}";
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