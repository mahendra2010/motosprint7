@extends('admin.common.admin_header_sidebar')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Blog Description</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Blog description</li>
      </ol>
    </section>

    <div class="pad margin no-print">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> Note:</h4>
        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
      </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
            <a href="{{ url('/')}}/admin/edit-blog/{{ encrypt($blog_det->id) }} " class="btn btn-primary pull-right"><i class="fa fa-pencil"></i> Edit</a>
        </div>
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> {{ $blog_det->title }}
            <small class="pull-right"> 
            {{ date('l jS \of F Y h:i:s A', strtotime($blog_det->created_at)) }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
          @if($blog_det->blog_img)
             <img src="{{ url('/public/images/blog_images/') }}/{{ $blog_det->id }}/{{ $blog_det->blog_img }}" width="100%" style="height:450px; object-fit:cover" class="img-responsive img-thumbnail" align="left" hspace="20" >
        
          @endif
        
        <br/><br/>
          <?php echo $blog_det->blog_content; ?> 
       
        <!-- /.col -->
      </div>
      <div class="row">
          <div class="col-sm-12">
              <h3>Gallery</h3>
          </div>
          @if(count($blog_media)>0)
            @foreach($blog_media as $media)
              <div class="col-sm-4">
                <img src="{{ url('/')}}/public/images/blog_images/{{ $media->blog_id}}/{{ $media->img_name}}" width="100%">
              </div>
              @endforeach
              @else
              <p>No Gallery found</p>
          @endif
          
      </div>
      <!-- /.row -->
      
      <div class="row">
          <div class="col-sm-12">
             <h3> Comments</h3>
          </div>
           
          @if(count($blog_comments)>0)
            @foreach($blog_comments as $comment)
            <div class="col-sm-12">
              <div class="col-sm-6">
                  <b>Name : {{ $comment->name }} </b><br/>
                   Email : {{ $comment->email }} <br/>
                    Website : {{ $comment->website }}<br/>
                   <b>Comment : {{ $comment->comment }}</b> <br/>
                </div>
                <div class="col-sm-6">
                    @if($comment->status=='0')
                        <span class="label label-danger"> Rejected </a>
                        @else
                        <span class="label label-success"> Published </a>
                    @endif
                </div>
                 
                </div>
               <div class="col-sm-12">
                   <hr/>
               </div>
                @endforeach
                
                @else
                <p class="col-sm-12">No Comments</p>
                
          @endif
          
        </div>

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
        <a href="{{ url()->previous() }}" class="btn btn-success pull-right"><i class="fa fa-arrow-left"></i> Back
          </a>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

     
    </section>
    <!-- /.content -->
 @endsection
