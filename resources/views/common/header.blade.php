<?php use App\Http\Helpers\ApiCommonHelper as myhelper; ?>
<header class="wow fadeInDown" id="header">
   <div class="row">
       <div class="col-sm-3">
          <div class="logo">
              <a href="{{ url('/')}}"><img class="d-none d-sm-block" src="{{ url('/')}}/public/frontend/images/logo.png"> </a>
              <a href="{{ url('/')}}"><img class="d-block d-sm-none" src="{{ url('/')}}/public/frontend/images/MBCBigLogo_white.png"> </a>
        </div>
       </div>
       <div class="col-6 col-sm-8 ">
               <div class=" pull-left header-text">
                   <h2 class="d-none d-sm-block"> @lang('messages.header.top_head') </h2>  
               </div>
               <div class="pull-right">
                  
                   <?php
                   
                    if(last(request()->segments()) =='registration-step-1' || last(request()->segments()) =='motor-cycle-registration')
                    {
                       ?>
                       
                  <?php }else{  ?>
                          <?php 
                      if(!empty(Auth::user()->id ))
                      {
                        ?>
                         <div class="dropdown p-10" >
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                               <i class="fa fa-user" aria-hidden="true"></i> {{ @Auth::user()->name }}
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ url('/my-profile')}}"> @lang('messages.header.my_profile')</a>
                                <a class="dropdown-item" href="{{ url('/my-profile?setting=active')}}"> @lang('messages.header.setting') </a>
                                <a class="dropdown-item" href="{{ url('/logout') }}"> @lang('messages.header.logout')</a>
                              </div>
                              <?php 
                              	$req_comment = myhelper::check_doc_view(Auth::user()->id);
                              	$req_file = myhelper::check_doc_view(Auth::user()->id, 'comment');
                              ?>
                              @if($req_comment >0 || $req_file >0)
	                              <div class="req_icon">
	                              	<a href="{{ url('/my-profile?tab=requested_doc')}}">
	                              		<i class="fa fa-commenting" aria-hidden="true"></i>
	                              		@if($req_comment >= 0)
	                              			<span>{{$req_comment}}</span>
	                              		@endif
	                              	</a>
	                              	<a href="{{ url('/my-profile?tab=requested_doc')}}">
	                              		<i class="fa fa-file-text" aria-hidden="true"></i>
	                              		@if($req_file >= 0)
	                              			<span>{{$req_file}}</span>
	                              		@endif
	                              	</a>
	                             </div>
                            @endif
                        </div> 
                        
                        <?php
                      }else{
                          ?>
                         <div class="p-10" >
                              <a href="{{ url('/login')}}" class="btn btn-default " ><i class="fa fa-user" ></i> @lang('messages.header.login') </a>
                
                        </div>
                        <?php
                      }
                      ?>  
                            
                <?php    } ?>
               </div>
           
       </div>  
       <div class="col-6 col-sm-1">
       <div class="menu-right">  
            <label>
                    <input type='checkbox'>
                    <span class='menu'> <span class='hamburger'></span> </span>
                     <ul>
                      <li> <a href="{{ url('/') }}">  @lang('messages.header.home_menu') </a> </li>
                      <li> <a href="{{ url('/what-we-do') }}">@lang('messages.header.what_we_do')</a> </li>
                      <li> <a href="{{ url('/blog')}}">@lang('messages.header.blog')</a> </li>
                      <li> <a href="{{ url('/contact-us') }}">@lang('messages.header.contact')</a> </li>
                      @if(!empty(session()->get('auth_user_id')))
                       <li> <a href="{{ url('/logout') }}"> @lang('messages.header.logout')</a> </li>
                      @endif
                     
                    </ul> 
            </label>
        </div>  
        </div>
    </div>
  
        
</header>