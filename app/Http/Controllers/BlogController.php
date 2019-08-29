<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blogmodel as Blog;
use App\Models\TagsModel as Tags;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\GeneralMail;
use App\Mail\AdminMail;

class BlogController extends Controller{

    private $base_url;

    public function __construct(){
        //blockio init
        $this->base_url = url('/');
      
    }
 
    public function index(){
        //$blogs = Blog::where('status','Active')->orderBy('id', 'DESC')->get();
        $blogs = Blog::where('status','Active')->orderBy('id', 'DESC')->paginate(15);;
         $recent_blogs  = Blog::take(5)->where('status','Active')->orderBy('id', 'DESC')->get();
        $random_blogs  =  Blog::take(5)->where('status','Active')->inRandomOrder()->get();
        $blog_tags     =  DB::table('tags')->get();
        
        
        return view('blog',compact('blogs'))->with(array('recent_blogs'=>$recent_blogs,'random_blogs'=>$random_blogs,'blog_tags'=>$blog_tags));
    }
    public function blog_description($id, $slug){
       
        $blogs   =   Blog::where('id',$id)->orderBy('id', 'DESC')->first();
        //print_r($blogs);
        if($blogs)
        {
        $blog_id    =   $blogs->id;
        $blog_tag_ids = $blogs->tags;
        
        $tag_ids = array_map('intval', explode(",", $blog_tag_ids));
        $related_blogs = Blog::take(2)->whereIn('tags',$tag_ids)
                                        ->where('status','Active')
                                        ->get(); 
      
        
        $blog_gallery   =  DB::table('blog_media')->where('blog_id',$blog_id)->get();
        
        $recent_blogs  = Blog::take(5)->where('status','Active')->orderBy('id', 'DESC')->get();
        $random_blogs  = Blog::take(5)->where('status','Active')->inRandomOrder()->get();
        $blog_tags     = DB::table('tags')->get();
        
        $blog_comments = DB::table('blog_comments')->where(array( 'blog_id' =>$blog_id,'status' =>1))->get();
        
        return view('blog-description')->with(array('blog_gallery' => $blog_gallery,'blogs' => $blogs,'recent_blogs'=>$recent_blogs,'blog_tags'=>$blog_tags,'related_blogs'=>$related_blogs,'blog_comments'=>$blog_comments,'random_blogs'=>$random_blogs));
        }else{
            echo "<script>alert(' Blog Not Found')</script>";
        }
        
        
        
        
        
    }
    public function contactus(){
        return view('contactus');
    }
    public function whatwedo(){
        return view('whatwedo');
    }
    
    public function contact_us(Request $request)
    {
      $name = $request->input('name');
      $email = $request->input('email');
      $phone = $request->input('phone');
      $website = $request->input('website');
      $message = $request->input('message');
      
       $data = array(
           'name'   =>  $name,
           'email'   => $email,
           'phone'  => $phone,
           'website' =>  $website,
           'message'   =>  $message,
           'updated_at'   => NOW(),
           'created_at'   => NOW(),
           );
       
       $insert = DB::table('contact_us_users')->insert($data);
       if($insert)
       {
           $reciever_email = "user@motoblockchain.es";
           $user_data=array(
                        'sender_email'   =>     $email,
                        'type'           =>     'contact_us',
                        'email'          =>      $email,
                        'subject'        =>     'New User Contact us',
                        'message'        =>     "<p>New User contact us from motoblockchain, His/Her details are given below:-</p> <p>Name : ".$name." </p> <p>  Email: ".$email .",</p> <p> Phone: ".$phone .",</p><p> Website : ". $website .", </p><p> Message: ". $message."</p>",
                        'url'            =>     '',
                    );
                    
                    Mail::to($reciever_email)->send(new AdminMail($user_data));
                    return redirect('contact-us')->with('success_info', 'Message Successfully Sent');
       }else{
           return back()->with('info','Failed to send message');
       }
    }
    /*End method*/
    
    public function insert_comment(Request $request)
    {
           //print_r($request->input());
           $email = $request->input('email');
           $name = $request->input('name');
           $comment = $request->input('comment');
           
           $data = array(
                'blog_id'    => $request->input('blog_id'),
                'name'       =>  $name,
                'email'      =>  $email,
                'website'    =>  $request->input('website'),
                'comment'    =>  $comment,
                'status'    => 0,
                'created_at' => NOW(),
                'updated_at' => NOW()
                
               );
            $insert = DB::table('blog_comments')->insert($data);
            if($insert)
            {
                $results = array(
        			'result'=>'TRUE',
        			'message'=>'Comment will Appear after admin approval',
        			'name' => $name,
        			'comment' => $comment,
        		);
                $reciever_email = "approval@motoblockchain.es";
                 $user_data=array(
                        'sender_email'  =>  $email,
                        'name'          =>  $name,
                        'type'          =>   '',
                        'email'          =>     $email,
                        'subject'       =>  'New Comment',
                        'message'        =>  "<p><b>".$name. "</b> has commented on the blog..</p><p> <b>".$comment."</b></p><p>You Can Publish or Reject comment from Admin panel. Click Below link to access admin panel </p>",
                        'url'           =>   $this->base_url."/admin/blog-comments"
                    );
                    
                    Mail::to($reciever_email)->send(new AdminMail($user_data));
                
                
                
            }else{
                $results = array(
        			'result'=>'FALSE',
        			'message'=>'Failed !! please try again'
        		);
            }
            echo json_encode($results);
            
       
    }
    
    
    //search blogs
    public function search_blog($id)
    {
       $int_id = (int) $id;
       
       $recent_blogs  = Blog::take(5)->where('status','Active')->orderBy('id', 'DESC')->get();
       $recent_blogs_bottom  = Blog::take(2)->where('status','Active')->orderBy('id', 'DESC')->get();
        $random_blogs  =  Blog::take(5)->where('status','Active')->inRandomOrder()->get();
        $blog_tags     =  DB::table('tags')->get();
        
       $blogs='';
      if($int_id == 0){
         $id= $id;
         $blogs = Blog::where('title', 'LIKE', '%' . $id . '%')
                       ->orWhere('blog_content', 'LIKE', '%' . $id . '%')
                        ->paginate(10);
      }else{
          $id = $int_id;
          $blogs = Blog::where('tags', 'LIKE', '%' . $id . '%')
                        ->paginate(10);
      }
       
       
       return view('search-blog',compact('blogs'))->with(array('recent_blogs'=>$recent_blogs,'random_blogs'=>$random_blogs,'blog_tags'=>$blog_tags,'recent_blogs_bottom'=>$recent_blogs_bottom));;
    }
    
    //to get tag name
    public static function tag_name($id)
    {
      $tag =  DB::table('tags')->where('id',$id)->first();
      return @$tag->tag_name;
    }
    
    

}
/*End Class*/