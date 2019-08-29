<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Usermodel as User;

use App\Models\Productmodel as Product;
use App\Models\CountryModel;
use App\Models\StateModel;
use  App\Models\Admin\Admin;
use  App\Models\Admin\Client_testimonial as Testimonial;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Mail;
use App\Mail\GeneralMail;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use Auth;
use Hash;


class AdminController extends Controller
{
    private $base_url;

    public function __construct()
    {
        //base url of the website
        $this->base_url = url('/');
      
    }
    public function index()
    {
    	$data['total_users_count'] = User::count();
    	$data['total_products_count'] = Product::count();
    	$data['total_blogs_count'] = DB::table('blogs')->count();
    	
    	return view('admin.dashboard',$data);
    	 //return Datatables::of(User::query())->make(true);
    }
    public function create()
    {
         return view('admin.test');
    }
    
    //Admin Profile Details
    public function profile()
    {
    	return view('admin/profile');
    	
    }
    //profile() ends
    
    //Admin is able to change Password
    public function change_password(Request $request)
    {
        $this->validate($request,[
    			'current_password' => 'required ',
    			'new_password' => 'required'
    		]);
    	
            $c_pass=$request->input('current_password');
            $n_pass=$request->input('new_password');
            $email=Auth::guard('admin')->user()->email;
            $admindata = Admin::where('email', $email)
                ->select('email', 'password','id');
            if($admindata->count()>0)
            {
                $admindata=$admindata->first();
                if(Hash::check($c_pass, $admindata->password)) 
                {
                    $udata=array(
                        'password' => $n_pass,
                        'updated_at' => NOW()
                        );
                    $update=Admin::where('email', $email)->update($udata);
                    if($update)
                    {
                        return redirect('/admin/profile/')->with('info','Password Successfully Changed');
                        
                    }else{
                        return back()->with('error_info','Failed to update Password');
                    }
                }else{
                    return back()->with('error_info','Previous Password is incorrect');
                }
                
            }else{
                
            }
    }
    //end change_password method
    
    
     
    //To change the photo of profile picture of the admin
    public function change_photo(Request $request)
    {
        $this->validate($request,[
    			'profile_pic' => 'required '
    		]);
    	
            
            $email=Auth::guard('admin')->user()->email;
            $admindata = Admin::where('email', $email)
                ->select('email', 'password','id');
            if($admindata->count()>0)
            {
                $admindata=$admindata->first();
             
             $img_name='';
            if ($request->hasFile('profile_pic')) {
                $img = $request->file('profile_pic');
                $img_name = time().'.'.$img->getClientOriginalExtension();
                $destinationPath = public_path('/backend/dist/images/');
                $img->move($destinationPath, $img_name);
               
            }
                    $udata=array(
                        'profile_pic' => $img_name,
                        'updated_at' => NOW()
                        );
                    $update=Admin::where('email', $email)->update($udata);
                    if($update)
                    {
                        return redirect('/admin/profile/')->with('info','Password Successfully Changed');
                        
                    }else{
                        return back()->with('error_info','Failed to update Password');
                    }
                
                
            }else{
                
            }
    }
    //change_photo ends
    
    
    
    //Unverified Users List
    public function unverified_users_list()
    {
        
    	$users=User::query()->where('verified_status',0)->orderByDesc('id');
    
    	return Datatables::of($users)
    	    ->addColumn('verified', function ($users) {
    	        if($users->verified_status==0)
    	        {
    	            return '<span class="label label-danger">Unverified</span>';
    	        }else{
    	            return '<span class="label label-success">Verified</span>';
    	        }
                })
                ->addColumn('user_type', function ($users) {
    	        if($users->user_type=='0')
    	        {
    	            return '<span class="label label-success">Buyer</span>';
    	        }elseif($users->user_type=='1'){
    	            return '<span class="label label-primary">Seller</span>';
    	        }
                })
    	    ->addColumn('action', function ($users) {
                  return '<button type="button" onclick="send_mail_layout(\''.$users->name.'\',\''.$users->email.'\')" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-envelope" title="Send Mail"></i> </button>
                  <button type="button" id="'.$users->id.'" onclick="deleteUser(this.id)"   class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" title="Delete"></i> </button> ';
                })
            ->rawColumns([ 'verified','user_type', 'action'])

    		->make(true);
    		//return Datatables::of(User::query())->make(true);
    		
    		
    	
    }
    //End
    
    public function unverified_users()
    {
        return view('admin.unverified_users_list');
    }
    
    //send email layout
    function send_mail_layout(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        echo'
             <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="s_message">  </h4> 
              </div>
              <div class="modal-body">
                
                <div class="box box-info">
                    <div class="box-header">
                      <i class="fa fa-envelope"></i>
        
                      <h3 class="box-title">Send Email to '.$name.'</h3>
                      <!-- tools box -->
                      
                      <!-- /. tools -->
                    </div>
                    <form  id="sendEmail_form" method="POST">
                    <div class="box-body">
                      
                      '. csrf_field() .'
                        <div class="form-group">
                         <input type="hidden" class="form-control" id="user_name" name="user_name" value="'.$name.'" />
                          <input type="email" class="form-control" id="user_email_to" name="user_email_to" value="'.$email.'" placeholder="Email to:" readonly required>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" id="user_subject" name="user_subject" placeholder="Subject" required>
                        </div>
                        <div>
                          <textarea class="textarea" id="user_message" name="user_message" placeholder="Message"
                                    style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
                        </div>
                      
                    </div>
                    <div class="box-footer clearfix">
                      <button type="submit" class="pull-right btn btn-default"  id="sendEmail_btn">Send
                        <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                    </form>
                  </div>
                
                
                
              </div>
              
            </div>
        ';
    }
    //End
    
    //To send mail
    public function send_mail(Request $request)
    {
     
        $name  = $request->input('name');
        
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        
        
        $user_data=array(
                        'sender_email' => 'admin@motoblockchain.es',
                        'name'          => $name,
                        'email'         => $email,
                        'type'          => 'unverified_user',
                        'subject'        => $subject,
                        'message'       => $message,
                        'url' => '',
                    );
                Mail::to($email)->send(new GeneralMail($user_data));
          
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Mail Successfully sent...'
    		);
            
       
        echo json_encode($results);          
        
        
    }
    
    //end
    
    //To fetch the blog list in admin panel
    public function blog_list()
    {
       
         $blog = DB::table('blogs')->orderByDesc('id');

    	return Datatables::of($blog)
    	    ->addColumn('blog_img', function ($blog){
        	        if(!empty($blog->blog_img))
        	        {
        	        return '<a href="blog_description/'.$blog->id.'"><img src="'.$this->base_url.'/public/images/blog_images/'.$blog->id.'/'.$blog->blog_img.'" style="width:40px; height:40px"></a>';
        	        }else{
        	            return '<a href="blog_description/'.$blog->id.'"><img src="'.$this->base_url.'/public/images/default_images/default_bike.png" style="width:40px; height:40px"></a>';
        	        }
    	        })
    	    
                ->addColumn('blog_content', function ($blog) {
    	            return strip_tags(substr($blog->blog_content,0,100));
                })
            ->addColumn('status', function ($blog) {
    	        if($blog->status=='Active')
    	        {
    	            return '<a href="javascript:void(0)" id="'.$blog->id.'" onclick="disable_blog(this.id)"><span class="label label-primary">Active</span></button>';
    	        }else{
    	            return '<a href="javascript:void(0)" id="'.$blog->id.'" onclick="Activate_blog(this.id)"><span class="label label-danger">Deactive</span></a>';
    	        }
                })
    	    ->addColumn('action', function ($blog) {
                  return '<a href="blog_description/'.$blog->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open" title="View"></i> </a>
                  <a href="edit-blog/'.encrypt($blog->id).'" class="btn btn-xs btn-default"> <i class="glyphicon glyphicon-edit" title="Edit"></i>  </a>
                  <button type="button" id="'.$blog->id.'" onclick="deleteBlog(this.id)"   class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" title="Delete"></i> </button> ';
                })
            ->rawColumns(['blog_img', 'blog_content','status', 'action'])

    		->make(true);
    	
    		
    }
    /*list blg method end*/
    
    /*complete users details in this method*/
    public function user_detail($user_id)
    {
        $id = decrypt($user_id);
         //echo $reuest->input('id');
        $userdatail = User::find($id);
        
        
            $products_listing = Product::where('user_id',$id)->with('brand','model','category','cc_data','cv_original_data','country_data','state_data')->get();
            
        //echo "<pre>";
        //print_r($products_listing);
        if($userdatail)
        {
           return view('admin/usersprofile',compact('userdatail','products_listing'));  
        }else{
            $userdata = DB::table('users')->select('*')->where('id',$id)->first();
            return view('admin/usersprofile',compact('userdata'));  
        }
	     
    }
    /*User Details method end*/
    
    /*Blog comments*/
    public function blog_comments()
    {
        return view('admin/blog-comments-list');
    }
    
    public function blog_comment_list()
    {
       
         $blog = DB::table('blog_comments')->orderByDesc('id');

    	return Datatables::of($blog)
            ->addColumn('blog_title', function ($blog) {
                  return $this->blog_title_name($blog->blog_id);
                })
            ->addColumn('status', function ($blog) {
    	        if($blog->status=='0')
    	        {
    	            return '<a href="void:javaccript(0)" id="'.$blog->id.'" onclick="publish_blog_comment(this.id)"><span class="label label-danger">Rejected</span></button>';
    	        }else{
    	            return '<a href="void:javascript(0)" id="'.$blog->id.'" onclick="reject_blog_comment(this.id)"><span class="label label-success">Published</span></a>';
    	        }
                })
    	    ->addColumn('action', function ($blog) {
                  return '<a href="blog_description/'.$blog->blog_id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open" title="View"></i> </a>
                  <button type="button" id="'.$blog->id.'" onclick="deleteBlogComment(this.id)"   class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" title="Delete"></i> </button> ';
                })
            ->rawColumns([ 'blog_title','status', 'action'])

    		->make(true);
    	
    		
    }
    
    public function blog_title_name($id)
    {
        $title = DB::table('blogs')->where('id', $id)->first();
        if($title)
        {
            return $title->title;
        }else{
            return '';
        }
    }
    
    /* To delete individual users information  form the database*/
    public function delete_user($id)
    {
       $user_id=$id;
       
           $getproduct= DB::table('products')->where('user_id',$user_id)->get();
           if(count($getproduct)>0)
           {
               foreach($getproduct as $product)
               {
                   $product_id = $product->id;
                    DB::table('previous_owners_details')->where('product_id', $product_id)->delete();
                    DB::table('product_mechanic_details')->where('product_id', $product_id)->delete();
                    DB::table('media_files')->where('product_id', $product_id)->delete();
                    DB::table('product_invoice')->where('product_id', $product_id)->delete();
                    DB::table('products')->where('id', $product_id)->delete();
                    
               }
               
           }
           DB::table('contact_seller')->where('sender_id', $user_id)->orwhere('receiver_id', $user_id)->delete();
         //To Remove The users directory
         $path = public_path().'/images/'.$user_id;
         if(File::isDirectory($path))
         {
             File::deleteDirectory($path); 
         }
         
        $delete=User::find($user_id)->delete($user_id); 
        if($delete)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Profile Deleted Successfully'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed please Try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*delete user method end */
    
    
    /*To disable individual users*/
    public function disable_user($id)
    {
       
        $data=array(
            'status' => 0
            );
       $update = User::where(array('id' =>$id))->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Disabled'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*Disable user method end*/
    
    /*To deactivate email notification*/
    public function deactivate_email_notification($id)
    {
       
        $data=array(
            'email_notification' => 'Deactive'
            );
       $update=User::where(array('id' =>$id))->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Deactivated Email Notification'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End */
    
    /*To change the status active 'means he/she is able to acccess the website'*/
     public function activate_email_notification($id)
    {
       
        $data=array(
            'email_notification' => 'Active'
            );
       $update=User::where(array('id' =>$id))->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Activated Email Notification'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*Activate user method end*/
    
    /*To change the status active 'means he/she is able to acccess the website'*/
     public function active_user($id)
    {
       
        $data=array(
            'status' => 1
            );
       $update=User::where(array('id' =>$id))->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Disabled'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*Activate user method end*/
    
    public function display_users()
    {
    	return view('admin.users');
    }
    
    /*Dislpay all blog list view*/
    public function display_blogs()
    {
    	return view('admin.blog-list');
    }
    /*End of Display view Blog*/
    
    
    
    
    /*Blog Discription View data*/
    public function blog_description($id)
    {
        //echo $reuest->input('id');
        $blog_det   = DB::table('blogs')->where('id', $id)->first();
        $blog_media = DB::table('blog_media')->where('blog_id', $id)->get();
        
        $blog_comments = DB::table('blog_comments')->where('blog_id', $id)->get();
        
        if($blog_det)
        {
           return view('admin.blog-description',compact('blog_det','blog_media','blog_comments'));  
        }else{
            echo "<script>alert('No blog Found')</script>";
      
        }
	     
    }
    /*End of Blog description method*/
    
    /*Delete the blog by paricular id*/
    public function delete_blog($id)
    {
       $image = DB::table('blogs')->where('id', $id)->first();
       
       $path = public_path().'/images/blog_images/'.$image->id;
         if(File::isDirectory($path))
         {
             File::deleteDirectory($path); 
         }
      
      $delete= DB::table('blogs')->where('id', $id)->delete();
      $delete1= DB::table('blog_media')->where('blog_id', $id)->delete();
        if($delete)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Deleted !!!'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !!! Please Try Again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End of Delete blog method*/
    
    /*Delete the blog comment by paricular id*/
    public function delete_blog_comment($id)
    {
       
      $delete= DB::table('blog_comments')->where('id', $id)->delete();
        if($delete)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Deleted !!!'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !!! Please Try Again'
    		);
        }
        echo json_encode($results);
        
    }
    
    /*End */
    
    /*Delete the blog by paricular id*/
    public function delete_blog_media($id)
    {
       
      $delete= DB::table('blog_media')->where('id', $id)->delete();
        if($delete)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Deleted !!!'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !!! Please Try Again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End of Delete blog method*/
    
    /*Disable any blog by id*/
    public function disable_blog($id)
    {
       
        $data=array(
            'status' => 'Disable'
            );
      
       $update= DB::table('blogs')->where('id', $id)->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Disabled'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End of Disable method*/
    
    /*This method turns the blog in active mode*/
     public function active_blog($id)
    {
       
        $data=array(
            'status' => 'Active'
            );
       $update= DB::table('blogs')->where('id', $id)->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Active'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End of method*/
    
    /*This method turns the blog in active mode*/
     public function publish_blog_comment($id)
    {
       
        $data=array(
            'status' => 1
            );
       $update= DB::table('blog_comments')->where('id', $id)->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Published'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End */
    
    /*This method turns the blog in active mode*/
     public function reject_blog_comment($id)
    {
       
        $data=array(
            'status' => 0
            );
       $update= DB::table('blog_comments')->where('id', $id)->update($data);
        if($update)
        {
            $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Published'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !! please try again'
    		);
        }
        echo json_encode($results);
        
    }
    /*End */
    
    public static function user_country($id)
    {
        $country = DB::table('country')
                        ->select('*')->where('id',$id)->first();
        if($country)
        {
            return $country->country_name;
        }else{
            return '';
        }
        
        
    }
    public static function user_state($id)
    {
        $state = DB::table('state')
                        ->select('*')->where('id',$id)->first();
        if($state)
        {
            return $state->state_name;
        }else{
            return '';
        }
    }
    
    /*To add blogs UI/UX view*/
    public function add_blog()
    {
        $tags = DB::table('tags')->select('*')->get();
        return view('admin.add-blog',compact('tags'));
    }
    /*Add blog method end */
    
    /*To insert blog data in database*/
    public function create_blog(Request $request)
    {
        $this->validate($request, [
        'title' => 'required|min:3|max:255|unique:blogs'
        ]);
        
       $title= $request->input('title');
       
       $choice = array();
       $tags = '';
       if($request->input('tags'))
       {
           foreach( $request->input('tags') as $tag) {
                $choice[]=$tag;
            }
            $tags = implode(',',$choice);
       }
        
       
       $img_name='';
        if ($request->hasFile('blog_img')) {
            
            $img = $request->file('blog_img');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            /*$destinationPath = public_path('/images/blog_images');
            $img->move($destinationPath, $img_name);*/
           
        }
       $blog_content= $request->input('blog_content');
       $posted_by = ucfirst(Auth::guard('admin')->user()->name);
       
       $data= array(
            'title'         => $title,
            'slug'          => str_slug(strtolower($title)),
            'tags'          => $tags,
            'blog_img'      => $img_name,
            'blog_content'  => $blog_content,
            'posted_by'     => $posted_by,
            'status'        => 'Deactive',
            'updated_at'    => NOW(),
            'created_at'    => NOW()
           );
           
         $result=DB::table('blogs')->insertGetId($data);
         if($result)
         {
             $blog_id=$result;
            
            //to create individual user directory for blog media files
                $path = public_path().'/images/blog_images/'.$blog_id;
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                }
                $destinationPath = public_path().'/images/blog_images/'.$blog_id;

                if($request->hasFile('blog_img')){
                   $img->move($destinationPath, $img_name);
                }
             
             if($request->hasfile('img_name')){
                $i=1;
                foreach($request->file('img_name') as $image){
                    $i++;
                    $gallery_name = time().$i.'.'.$image->getClientOriginalExtension();
                    //$name=$image->getClientOriginalName();
                    $image->move($destinationPath, $gallery_name);  
                    //$img_data[] = $gallery_name;  
                    $gallery_data = array(
                            'blog_id' => $blog_id,
                            'img_name' => $gallery_name,
                        );
                    DB::table('blog_media')->insert($gallery_data);
                }
                
               
             }
            return redirect('/admin/add_blog')->with('info','Blog Successfully added');

         }else{
                return back()->with('fail_info',' Failed to insert data');
         }
           
    }
    
    /*End create blog method*/
    
    public function auto_insert_blog(Request $request)
    {
      
        
       $title= $request->input('title');
       
       $choice = array();
       $tags = '';
       if($request->input('tags'))
       {
           foreach( $request->input('tags') as $tag) {
                $choice[]=$tag;
            }
            $tags = implode(',',$choice);
       }
        
       
      /* $img_name='';
        if ($request->hasFile('blog_img')) {
            
            $img = $request->file('blog_img');
            $img_name = time().'.'.$img->getClientOriginalExtension();
           
        }*/
       $blog_content= $request->input('blog_content');
       $posted_by = ucfirst(Auth::guard('admin')->user()->name);
       
       $data= array(
            'title'      => $title,
            'slug'       => str_slug(strtolower($title)),
            'tags'      =>  $tags,
            //'blog_img'   => $img_name,
            'blog_content' => $blog_content,
            'posted_by'  =>  $posted_by,
            'status'     => 'Deactive',
            'updated_at' => NOW(),
            'created_at' => NOW()
           );
           
          $blog_id = '';
         $result=DB::table('blogs')->insertGetId($data);
         if($result)
         {
             $blog_id = $result;
            
            //to create individual user directory for blog media files
                $path = public_path().'/images/blog_images/'.$blog_id;
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                }
                
            
            //return redirect('/admin/add_blog')->with('info','Blog Successfully added');
            echo $blog_id;
         }else{
                //return back()->with('fail_info',' Failed to insert data');
           echo  $blog_id;
         }
           
    }
    
    
    /*To insert blog data in database*/
    public function add_tag(Request $request)
    {
        
        
       $tag_name= $request->input('tag_name');
       
       $data= array(
            'tag_name'   => $tag_name,
            'updated_at' => NOW(),
            'created_at' => NOW()
           );
           
         $result=DB::table('tags')->insertGetId($data);
         if($result)
         {
             $tag_id = $result;
             $results = array(
    			'result'=>'TRUE',
    			'message'=>'Successfully Added',
    			'tag_id' => $tag_id,
    			'tag_name' => $tag_name,
    		);

         }else{
               $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed Please Try again',
    		);
         }
            echo json_encode($results);
    }
    
    /*To Update blog data in database*/
    public function update_blog(Request $request)
    {
        $blog_id = $request->input('blog_id');
       
       $blog= DB::table('blogs')->select('*')->where('id',$blog_id)->first();
       
       $title= $request->input('title');
        //$blog_cat = $request->input('blog_cat');
        $choice = array();
        $tags = '';
        if($request->input('tags'))
        {
            foreach( $request->input('tags') as $tag) {
                $choice[]=$tag;
            }
            $tags = implode(',',$choice);
        }
        
      
        if ($request->hasFile('blog_img')) {
            $img = $request->file('blog_img');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path().'/images/blog_images/'.$blog_id;
            $img->move($destinationPath, $img_name);
           
        }else{
             $img_name  =   $blog->blog_img;
        }
       $blog_content    =   $request->input('blog_content');
       $status  = '';
       if($request->input('status'))
       {
          $status          =   $request->input('status');
       }else{
           $status          =   'Deactive';
       }
       
       $posted_by       =   ucfirst(Auth::guard('admin')->user()->name);
       
       $data= array(
            'title'          =>     $title,
            'slug'           =>     str_slug(strtolower($title)),
            'tags'           =>     $tags,
            'blog_img'       =>     $img_name,
            'blog_content'   =>     $blog_content,
            'posted_by'      =>      $posted_by,
            'status'         =>     $status,
            'updated_at'     =>     NOW()
           );
           
         $result=DB::table('blogs')->where('id',$blog_id)->update($data);
         if($result)
         {
             $i=1;
             if ($request->hasFile('img_name')) {
                 
                  foreach($request->file('img_name') as $image)
                {
                    $i++;
                    $destinationPath = public_path().'/images/blog_images/'.$blog_id;
                    $gallery_name = time().$i.'.'.$image->getClientOriginalExtension();
                    //$name=$image->getClientOriginalName();
                    $image->move($destinationPath, $gallery_name);  
                    //$img_data[] = $gallery_name;  
                    $gallery_data = array(
                            'blog_id' => $blog_id,
                            'img_name' => $gallery_name,
                        );
                    DB::table('blog_media')->insert($gallery_data);
                }
             }
               
            return redirect('/admin/blogs')->with('info','Blog Successfully Updated');

         }else{
                return back()->with('fail_info',' Failed to insert data');
         } 
           
    }
    
    
    //all users list
    public function users_list()
    {
        
    	$users=User::query()->orderByDesc('id');
    
    	return Datatables::of($users)
    	    ->addColumn('profile_pic', function ($users){
        	        if(!empty($users->profile_pic))
        	        {
        	        return '<a href="userdetails/'.encrypt($users->id).'"><img src="'.$this->base_url.'/public/images/'.$users->id.'/'.$users->profile_pic.'" style="width:40px; height:40px"></a>';
        	        }else{
        	            return '<a href="userdetails/'.encrypt($users->id).'"><img src="'.$this->base_url.'/public/images/default_images/default_user.png" style="width:40px; height:40px"></a>';
        	        }
    	        })
    	    ->addColumn('verified', function ($users) {
    	        if($users->verified_status==1)
    	        {
    	            return '<span class="label label-success">Verified</span>';
    	        }else{
    	            return '<span class="label label-warning">Unverified</span>';
    	        }
                })
                ->addColumn('user_type', function ($users) {
    	        if($users->user_type=='0')
    	        {
    	            return '<span class="label label-success">Buyer</span>';
    	        }elseif($users->user_type=='1'){
    	            return '<span class="label label-warning">Seller</span>';
    	        }
                })
            ->addColumn('email_notification', function ($users) {
    	        if($users->email_notification=='Active')
    	        {
    	            return '<a href="void:javaccript(0)" id="'.$users->id.'" onclick="deactivate_notification(this.id)"><span class="label label-primary">Active</span></button>';
    	        }else{
    	            return '<a href="void:javascript(0)" id="'.$users->id.'" onclick="activate_notification(this.id)"><span class="label label-danger">Deactive</span></a>';
    	        }
                })
            ->addColumn('status', function ($users) {
    	        if($users->status==1)
    	        {
    	            return '<a href="void:javaccript(0)" id="'.$users->id.'" onclick="disable_user(this.id)"><span class="label label-primary">Active</span></button>';
    	        }else{
    	            return '<a href="void:javascript(0)" id="'.$users->id.'" onclick="Activate_user(this.id)"><span class="label label-danger">Deactive</span></a>';
    	        }
                })
    	    ->addColumn('action', function ($users) {
                  return '<a href="userdetails/'.encrypt($users->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open" title="View"></i> </a>
                   <button type="button" id="'.$users->id.'" onclick="deleteUser(this.id)"   class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" title="Delete"></i> </button> ';
                })
            ->rawColumns(['profile_pic', 'verified','status','user_type','email_notification', 'action'])

    		->make(true);
    		//return Datatables::of(User::query())->make(true);
    		
    		
    	
    }
    //users list method end
    
    
    public function auto_update_blog(Request $request)
    {
        $blog_id = $request->input('blog_id');
       
       //print_r($request->input()); die;
       $blog= DB::table('blogs')->select('*')->where('id',$blog_id)->first();
       
       $title= $request->input('title');
        $blog_content    =   $request->input('blog_content');
        $status = '';
        if($request->input('status'))
        {
           $status          =   $request->input('status');
        }else{
            $status          =   'Deactive';
        }
       
       $posted_by       =   ucfirst(Auth::guard('admin')->user()->name);
        //$blog_cat = $request->input('blog_cat');
        $choice = array();
        $tags = '';
        if($request->input('tags'))
        {
            foreach( $request->input('tags') as $tag) {
                $choice[]=$tag;
            }
            $tags = implode(',',$choice);
        }
        
      
       /* if ($request->hasFile('blog_img')) {
            $img = $request->file('blog_img');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path().'/images/blog_images/'.$blog_id;
            $img->move($destinationPath, $img_name);
           
        }else{
             $img_name  =   $blog->blog_img;
        }*/
      
       
       $data= array(
            'title'          =>     $title,
            'slug'           =>     str_slug(strtolower($title)),
            'tags'           =>     $tags,
            //'blog_img'       =>     $img_name,
            'blog_content'   =>     $blog_content,
            'posted_by'      =>      $posted_by,
            'status'         =>     $status,
            'updated_at'     =>     NOW()
           );
           
         $result=DB::table('blogs')->where('id',$blog_id)->update($data);
         if($result)
         {
             $i=1;
            /* if ($request->hasFile('img_name')) {
                 
                  foreach($request->file('img_name') as $image)
                {
                    $i++;
                    $destinationPath = public_path().'/images/blog_images/'.$blog_id;
                    $gallery_name = time().$i.'.'.$image->getClientOriginalExtension();
                    //$name=$image->getClientOriginalName();
                    $image->move($destinationPath, $gallery_name);  
                    //$img_data[] = $gallery_name;  
                    $gallery_data = array(
                            'blog_id' => $blog_id,
                            'img_name' => $gallery_name,
                        );
                    DB::table('blog_media')->insert($gallery_data);
                }
             }*/
               
            //return redirect('/admin/blogs')->with('info','Blog Successfully Updated');
            echo  "Success";

         }else{
               // return back()->with('fail_info',' Failed to insert data');
               echo "fail";
         } 
           
    }
    /*End of Update Blog*/
    
    /*To Edit Blog*/
    public function edit_blog($id)
    {
        $blog_id   = decrypt($id);
        $blogs = DB::table('blogs')->select('*')->where('id',$blog_id)->first();
        $blog_media = DB::table('blog_media')->select('*')->where('blog_id',$blog_id)->get();
        $tags = DB::table('tags')->select('*')->get();
        //print_r($blogs);
        return view('admin/edit-blog',compact('blogs','blog_media','tags'));
        
    }
    /*End of Editblog method */
    
    //################################################################## //
        // Client Testimonial
        /* To delete individual users information  form the database*/
        public function delete_testimonial($id)
        {
            $delete =   Testimonial::find($id)->delete($id); 
            if($delete)
            {
                $results = array(
        			'result'=>'TRUE',
        			'message'=>'Testimonial Deleted Successfully'
        		);
                
            }else{
                $results = array(
        			'result'=>'FALSE',
        			'message'=>'Failed please Try again'
        		);
            }
            echo json_encode($results);
            
        }
        /*delete Testimonial method end */
        /*To change the status active 'means he/she is able to acccess the website'*/
        public function active_testimonial($id)
        {
           
            $data=array(
                'status' => 1
                );
           $update=Testimonial::where(array('id' =>$id))->update($data);
            if($update)
            {
                $results = array(
        			'result'=>'TRUE',
        			'message'=>'Successfully Actvated'
        		);
                
            }else{
                $results = array(
        			'result'=>'FALSE',
        			'message'=>'Failed !! please try again'
        		);
            }
            echo json_encode($results);
            
        }
        /*Activate user method end*/
        /*To disable individual users*/
        public function disable_testimonial($id)
        {
           
            $data=array(
                'status' => 0
                );
           $update = Testimonial::where(array('id' =>$id))->update($data);
            if($update)
            {
                $results = array(
        			'result'=>'TRUE',
        			'message'=>'Successfully Disabled'
        		);
                
            }else{
                $results = array(
        			'result'=>'FALSE',
        			'message'=>'Failed !! please try again'
        		);
            }
            echo json_encode($results);
            
        }
        /*Disable user method end*/
        //clients testimonial
    public function client_testimonial(){
        return view('admin.client_testimonial');
    }
    
    public function client_testimonial_list()
    {
        $users = Testimonial::query()->orderByDesc('id');
    	return Datatables::of($users)
    	    ->addColumn('client_pic', function ($users){
        	        if(!empty($users->profile_pic))
        	        {
        	        return '<img src="'.$this->base_url.'/public/images/testimonial/'.$users->client_pic.'" style="width:40px; height:40px">';
        	        }else{
        	            return '<img src="'.$this->base_url.'/public/images/default_images/default_user.png" style="width:40px; height:40px">';
        	        }
    	        })
            ->addColumn('status', function ($users) {
    	        if($users->status==1)
    	        {
    	            return '<a href="void:javaccript(0)" id="'.$users->id.'" onclick="disable_client_testimonial(this.id)"><span class="label label-primary">Active</span></button>';
    	        }else{
    	            return '<a href="void:javascript(0)" id="'.$users->id.'" onclick="Activate_client_testimonial(this.id)"><span class="label label-danger">Deactive</span></a>';
    	        }
                })
    	    ->addColumn('action', function ($users) {
                  return '<button type="button" onclick="EditTestimonialLayout(this.id)"  class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit" title="Edit"></i> </button>
                  <!-- <button type="button" id="'.$users->id.'" onclick="deleteClientTestimonial(this.id)"   class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" title="Delete"></i> </button> --> ';
                })
            ->rawColumns(['client_pic', 'status', 'action'])

    		->make(true);
    		//return Datatables::of(User::query())->make(true);
    }
    /*End */
    
    public function testimonial_layout(Request $request){
        //print_r($request->input());
        $id = $request->input('id');
        $testimonial = DB::table('client_testimonial')->first();
        echo' <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Change Client testimonial </h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" id="testimonial_form">
                    	'. csrf_field() .'
                        <div class="form-group">
                            <input type="hidden" name="id" class="form-control" value="'.$testimonial->id.'">
                        </div> 

                        <div class="form-group">
                            <label>Client Name</label>
                            <input type="text" name="client_name" class="form-control" value="'.$testimonial->client_name.'">
                        </div>
                        <div class="form-group">
                            <label>Product Name</label>
                             <input type="text" name="product_name" class="form-control" value="'.$testimonial->product_name.'">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="form-control" rows="5"> '.$testimonial->message.' </textarea>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="status">
                                ';
                                if($testimonial->status==1){
                                    echo '<option value="'.$testimonial->status.'"> Active</option>';
                                }else{
                                    echo '<option value="'.$testimonial->status.'"> Deactive </option>';
                                }
                                echo '<option value="1"> Active</option>
                                <option value="0"> Deactive</option>
                            </select>
                        </div>
                        
                         <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-pull-right" name="submit_testimonial" value="Submit">
                         </div>
                        
                        
                    </form>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>';
    }
    
    public function testimonial_update(Request $request)
    {
        //print_r($request->input());
        $id = $request->input('id');
        $data = array(
            'client_name'  =>  $request->input('client_name'),
            'product_name'  =>  $request->input('product_name'),
            'message'  =>  $request->input('message'),
            'status'  =>  $request->input('status'),
            
            );
            //print_r($data);
            $update = Testimonial::where('id', $id)->update($data);
            if($update)
            {
               echo 1; 
            }else{
                echo 2;
            }
        
    }
    
    
    // ################################################################## //
    
    //
    public function modification_layout(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('type');
        if($type=='title')
        {
            $header = 'title';
        }else{
            $header = 'Description';
        }
        
        //print_r($request->input());
        echo ' <!-- Modal content-->
            <div class="modal-content" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Modified '. $header .' </h4>
              </div>
              <div class="modal-body">';
              if($type=='title')
              {
                  $titles = DB::table('media_title_modification')->where('id',$id)->get();
                  if(count($titles) > 0)
                  {
                      foreach($titles as $tit)
                      {
                          echo '<p>'.$tit->updated_title.'<em class="pull-right"> '. date(' jS \of F Y h:i:s A', strtotime($tit->created_at) )	 .'</em></p><hr/>';
                      }
                  }else{
                      echo '<p>No Modifications</p>';
                  }
                  
                  
              }else{
                   $descriptions = DB::table('media_description_modification')->where('id',$id)->get();
                     if(count($descriptions) > 0)
                      {
                           foreach($descriptions as $desc)
                          {
                              echo '<p>'.$desc->updated_description.'<em class="pull-right"> '. date(' jS \of F Y h:i:s A', strtotime($desc->created_at) )	 .'</em></p><hr/>';
                          }
                      }else{
                       echo '<p>No Modified Descriptions </p>';   
                      }
                    
              }
              echo '</div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>';
    }
    
}
