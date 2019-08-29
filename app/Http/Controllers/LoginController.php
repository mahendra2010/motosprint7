<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Illuminate\Support\Facades\File;

use App\Models\Usermodel;
use App\Models\Blogmodel;

use App\Models\MoterCycleBrand as brand;
use App\Models\MoterCycleModels as model;
use App\Models\Productmodel as Product;
use Auth;
//use Session;
use Hash;


class LoginController extends Controller
{
    private $base_url;

    public function __construct()
    {
        //blockio init
        $this->base_url = url('/');
      
    }
    
    //user registration
    public function insert_users(Request $request)
    {
    	//echo $request->input('email');
    	$this->validate($request,[
    	        'name' => 'required',
    			'email' => 'required | unique:users',
    			'password' => 'required| min:6',
    			'user_type' => 'required' ,
    		]);
    	
    	    $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $user_type = $request->input('user_type');
            $a_token = md5(time());

            $user_reg = New Usermodel;
            $user_reg->name= $name;
            $user_reg->email = $email;
            $user_reg->password = Hash::make($password);
            $user_reg->s_pass = $password;
            $user_reg->access_token = $a_token;
            $user_reg->user_type = $user_type;
            $user_reg->verified_status = 0;
            $user_reg->email_notification = 'Active';
            $user_reg->status =0;
            $user_reg->created_at =  NOW();
            $user_reg->updated_at = NOW();
            $result=$user_reg->save();
            if($result)
            {   //to send email
                $user_id = $user_reg->id;
               
               if($user_type==0)
               {
                   $user_role = "Buyer";
               }else if($user_type==1){
                   $user_role = "Owner";
               }else{
                   $user_role ="";
               }
               //to create individual user directory
                $path = public_path().'/images/'.$user_id;
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                }
                
                $user_data=array(
                        'sender_email'  => "admin@motoblockchain.es",
                        'name'          => $name,
                        'email'          => $email,
                        'subject'       => "Verify Your Mail",
                        'message'        => "<p>You created an account on Motoblockchain as ". $user_role ." </p> <p> Please verify your email ...</p>",
                        'url'           => $this->base_url.'/verify/'.$user_id.'/'.$a_token
                    );
                    Mail::to($email)->send(new SendMail($user_data));


                    return redirect('/verify')->with('info','Verification Mail is sent on '.$email.' . ');
            }else{
                return redirect('/register')->with('info','Failed to register');
            }
    	
    }
    
   
    
    //verify email
    public function verify_mail($id, $token)
    {
    	$user_id=$id;
       // Retrieve a model by its primary key...
       // $Usermodel = Usermodel::find($user_id);
        // Retrieve the first model matching the query constraints...
        $Usermodel = Usermodel::where(['access_token'=> $token, 'id' => $user_id])->first();
        if(!empty($Usermodel))
        {
           $user_type = $Usermodel->user_type;
           $name = $Usermodel->name;
           $email = $Usermodel->email;
           $s_pass = $Usermodel->s_pass;
            $new_token=md5(time().$user_id);
            $data=array(
                'access_token' => $new_token,
                'email_verified_at' => NOW(),
                'verified_status' => 1,
                'status' => 1,
                'updated_at' => NOW()
                );
            $update=Usermodel::where('id', $user_id)->update($data);
            if($update)
            {
                        if(Auth::attempt(['email' => $email, 'password' => $s_pass]))
                        { 
                            if(Auth::user()->dni=='' || Auth::user()->surname1=='')
                            {
                                session()->put('auth_user_id',$user_id);
                                 session()->put('auth_user_name',$name);
                                session()->put('auth_user_type',$user_type);
                                 
                                return redirect('registration-step-1');
                                //echo "failed";
                            }else{
                                return redirect('/success-login')->with('info','Success');
                                
                            }
                        }
                        else
                        {
                            return back()->with('info',' Authentication failed');
                            //echo "fail";
                        }
                
               

                
            }
            else{
            return redirect('/verify')->with('expire_token','Failed to verify please try again');
           }
        }else{
            return redirect('/verify')->with('expire_token','Your accesstoken is expired');
            //return back()->with('invalid_token','Your accesstoken is expired');
        }
        
    	
    }
    
    //user login
    public function login_user(Request $request)
    {

        $email= $request->input('email');
        $password = $request->input('password');
       
       
        $user = Usermodel::where('email', $email)
        ->select('id','email', 'password','verified_status','name','user_type','status');
        

       if($user->count()>0) {
            $user  =  $user->first();
            if(Hash::check($password, $user->password)) {
                 //User has provided valid credentials :)
                $v_status   =    $user->verified_status;
                $user_id    =    $user->id;
                $name       =    $user->name;
                $user_type  =    $user->user_type;
                $status     =    $user->status;
                $dni        =    $user->dni; 
                if($v_status==1)
                {
                    if($status=='1')
                    {
                        if(Auth::attempt(['email' => $email, 'password' => $password]))
                         { 
                              
                            if(empty(Auth::user()->dni))
                            {
                               
                                 session()->put('auth_user_id',$user_id);
                                 session()->put('auth_user_name',$name);
                                session()->put('auth_user_type',$user_type);
                                return redirect('registration-step-1');  
                               
                            }else{
                                if(!empty($request->input('req'))){
                                    // $req = $request->input('req');
                                    // if($req == 'my-profile?tab=requested_doc'){
                                    //     $req = 'my-profile?tab=req';
                                    // }
                                    return redirect('/'.$request->input('req'))->with('info','Success');
                                }else{
                                    return redirect('/')->with('info','Success');
                                } 
                            }
                        }
                        else
                        {
                            return back()->with('info',' Authentication failed');
                            //echo "fail";
                        }
                    }else{
                        return back()->with('info',' Your account is Deactivated. Please Contact Administrator');
                    }

                      
                    
                }else{
                    return back()->with('info',' Please verify your email');
                }
                
            }
            else{
                return back()->with('info',' Password Not Matched. Try Again');
            }
        }else{
            return back()->with('info',' Email not registered.. Please create an account');
        }

    }
    
     public function forgot_password(Request $request)
    {
        $this->validate($request,[
                'email' => 'required'
        ]);
        $email=$request->input('email');
        $user = DB::table('users')
        ->select('email', 'id','verified_status','access_token')
        ->where('email', $email);

        if($user->count()) {
            $user = $user->first();
                 //User has provided valid credentials :)
                $v_status=$user->verified_status;
                if($v_status==1)
                {
                    $access_t = $user->access_token;
                    $user_id = $user->id;

                    $user_data=array(
                        'sender_email' => "admin@motoblockchain.es",
                        'email' => $email,
                        'subject' => 'Reset Your Password',
                        'message' => 'Please reset your password by clicking the below link',
                        'url' => $this->base_url.'/reset_password/'.$user_id.'/'.$access_t
                    );
                  Mail::to($email)->send(new SendMail($user_data));
                    

                    return redirect('/verify')->with('invalid_token','Check your Mail id and generate Password');
                }else{
                    return back()->with('info',' Please verify your email');
                }
                
            
        }else{
            return back()->with('info',' Email not exist in our database.. ');
        }

    }
    
    public function reset_password($id, $token)
    {
        $user_id=$id;
        $users=Usermodel::where('id', $user_id)
                            ->where('access_token',$token )
                             ->first();
       if(!empty($users))
        {
              return view('reset-password')->with(['user_id'=>$user_id,'token'=>$token]);
        }else{
                return view('reset-password')->with('err_msg','Oop\'s token expired.. please try again');
        } 
        
    }
    
    //reset password
    public function generate_new_password(Request $request)
    {
        $this->validate($request,[
                'user_id' => 'required',
                'token' => 'required',
                'new_password' => 'min:4|required',
                'confirm_password' => 'required_with:new_password|same:new_password| min:4'
        ]);
        $user_id = $request->input('user_id');
        $token = $request->input('token');
        $pass = $request->input('new_password');
        $users = Usermodel::where(['id'=> $user_id,'access_token'=>$token])->get();
        if(sizeof($users) > 0)
        {
            $data=array(
                'password' => Hash::make($pass),
                's_pass' => $pass,
                'access_token' => md5(time()),
                'updated_at' =>NOW()
            );
            $update=Usermodel::where('id',$user_id)->update($data);
            if($update)
            {
                return back()->with('success_info','Successfully password changed');

            }else{
                return back()->with('fail_info','failed to update.. Please try again');
            }

        }else{
            return back()->with('fail_info','invalid request token');
        }
    }
    
    public function welcome(){
        $user_id = @Auth::user()->id;
         //$last_added_bike = Product::take(4)->orderBy('id', 'DESC')->get();
        $last_added_bike= DB::table('products')
            ->join('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->join('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->join('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
            ->join('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->join('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
            ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name')
            ->orderBy('id','DESC')
            ->limit(8)
            ->get();
            
        $onsales_product = DB::table('products')
            ->where('selling_price','!=','')
            ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->leftjoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
            ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->leftjoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
            ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name')
            ->orderBy('id','DESC')
            ->limit(8)
            ->get();
            
        $recent_search_products = DB::table('search_motorcycles')
                ->where(array('search_motorcycles.user_id'=>$user_id))
                 ->leftjoin('products', 'products.id', '=', 'search_motorcycles.product_id')
                 ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
                ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
                ->leftjoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
                ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
                ->leftjoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
                ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name','search_motorcycles.user_id as userid','search_motorcycles.product_id as productid')
                ->orderBy('id','DESC')
                ->limit(8)
                ->get();
                                    
        //print_r($recent_search_products); die;
         
        $blogs = Blogmodel::where('status','Active')->take(4)->orderBy('id', 'DESC')->get();
        $brands = brand::all();
       // $models = model::all();

        return view('index', compact('blogs','last_added_bike','onsales_product','recent_search_products',  'brands'));
    }

    
    
    
}
