<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Http\Helpers\ApiCommonHelper;
use App\Models\Usermodel as User;

use App\Models\Productmodel as product;
use Illuminate\Support\Facades\File;
use Auth;
use Hashids;
use Redirect;
use Hash;
use Response;

class LoginController extends Controller{
    private $base_url;
    
    protected $ApiCommonHelper;
    
    private $res = array(
            "successBool" => false,
            "successCode" => "",
            "responseType" => "",
            "response" => array(),
            "ErrorObj"   => array("ErrorCode" => "","ErrorMsg"  => ""));

    public function __construct(){
        //blockio init
        $this->base_url = url('/');
        $this->ApiCommonHelper = new ApiCommonHelper;
      
    }
    
    public function user_login(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );

        if($access==1){

            $deviceType = $arr['RequestData']['deviceType'];
            $deviceID = $arr['RequestData']['deviceID'];
            $device_token = $arr['RequestData']['device_token'];
            $email = $arr['RequestData']['email'];
            $password = $arr['RequestData']['password'];
            
            $logincount = DB::table('users')->where(array('email'=>$email))->select('id','name','dni','surname1', 'surname2','email','password','user_type','profile_pic', 'verified_status');
            //echo $logincount;
            if($logincount->count() > 0){
                $datet = date("Y-m-d-H-i-s");
                $token = md5($datet.$email);
                $update_array = array(
                    'token' => $token,
                    'device_type' => $deviceType,
                    'device_id' => $deviceID,
                    'device_token' => $device_token,
                    'updated_at' => NOW()
                    );
                //$logindata = DB::table('users')->where(array('email'=>$email))->first();
                $logindata  = $logincount->first();

                if(Hash::check($password, $logindata->password)){
                    
                    if($logindata->verified_status==1){
                        
                        if(!empty($logindata->dni) && !empty($logindata->surname1)){

                            $user_id = $logindata->id;
                            $profile_pic='';
                            if(!empty($logindata->profile_pic)){

                                $profile_pic =$this->base_url."/public/images/".$user_id."/".$logindata->profile_pic;
                            }else{

                                $profile_pic =$this->base_url."/public/images/default_images/default_user.png";
                            }
                            
                            $count_product = Product::where('user_id',$user_id)->with('brand','model')->get();
                            $comple_bike = array();
                            $pending_bike_ids = array();

                            if(!empty($count_product)){

                                foreach($count_product as $pro){

                                   if(strpos($pro->upload_step_status, ',')){

                                       if(strlen(str_replace(',', '', $pro->upload_step_status)) >= 4){

                                         $comple_bike[] =  $pro->id;

                                       }else{

                                            $pending_bike_ids[] = array('product_id'=>$pro->id,'product_name' => $pro->bike_name,'brand_id'=>$pro->brand_id, 'brand_name'=> @$pro->brand->brand_name, 'model_id'=> $pro->model_id,'model_name'=> @$pro->model->model_name);
                                       }
                                   }else{

                                       $pending_bike_ids[] = array('product_id'=>$pro->id,'product_name' => $pro->bike_name,'brand_id'=>$pro->brand_id, 'brand_name'=> @$pro->brand->brand_name, 'model_id'=> $pro->model_id,'model_name'=> @$pro->model->model_name);
                                   }
                                }
                            }
                      
                            $count_product = count($comple_bike);

                            $update = DB::table('users')->where(array('id'=>$logindata->id))->update($update_array);
                
                		    	$this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "login";
                                $this->res['response']['message'] = 'Successfully logged in';
                                $this->res['response']['data'] = array(
                							"user_id"        =>      $logindata->id,
                							"name"           =>     $logindata->name .' '. $logindata->surname1,
                							"userToken"      =>     $token,
                							"email"          =>     $logindata->email,
                							"user_type"     =>      $logindata->user_type,
                                            "device_token"   =>      $device_token,
                                            "device_type"    =>      $deviceType,
                                            "profile_pic"      =>      $profile_pic,
                                            "bikes_uploaded"   =>      $count_product,
                                            "pending_bike_ids" => $pending_bike_ids);
                            
                        }else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = 'Please Fill Your Personal Information on website'; 
                        }
                        

                        
                    }else{
                        $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Please verify your email.'; 
                    }  
                }else{
                        $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Wrong Password...'; 
                    
                }
                }else{
                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = 'Invalid Login credentials'; 
                }
            }else{

                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = $access;

            }
        $this->ApiCommonHelper->error_log('user_registration', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }

    public function user_data(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );

        if($access==1){

            $deviceType = $arr['RequestData']['deviceType'];
            $deviceID = $arr['RequestData']['deviceID'];
            $device_token = $arr['RequestData']['device_token'];
            $user_id = $arr['RequestData']['user_id'];
            
            $logincount = DB::table('users')->where(array('id'=>$user_id))->select('id','name','dni','surname1', 'surname2','email','user_type','token','profile_pic', 'verified_status');
            //echo $logincount;
            if($logincount->count() > 0){
                $logindata  = $logincount->first();
                $datet = date("Y-m-d-H-i-s");
                //
                $token = $logindata->token;
                $update_array = array(
                    'token' => $token,
                    'device_type' => $deviceType,
                    'device_id' => $deviceID,
                    'device_token' => $device_token,
                    'updated_at' => NOW()
                    );
                //$logindata = DB::table('users')->where(array('email'=>$email))->first();
                
                if($logindata->id){
                    
                    if($logindata->verified_status == 1)
                    {
                        
                        if(!empty($logindata->dni) && !empty($logindata->surname1))
                        {
                            $user_id = $logindata->id;
                            
                            $profile_pic='';
                            if(!empty($logindata->profile_pic))
                            {
                                $profile_pic =$this->base_url."/public/images/".$user_id."/".$logindata->profile_pic;
                            }else{
                                $profile_pic =$this->base_url."/public/images/default_images/default_user.png";
                            }
                            
                       
                            $count_product = Product::where('user_id',$user_id)->with('brand','model')->get();
                            $comple_bike = array();
                            $pending_bike_ids = array();
                            if(!empty($count_product)){
                                foreach($count_product as $pro){

                                   if(strpos($pro->upload_step_status, ',')){
                                       if(strlen(str_replace(',', '', $pro->upload_step_status)) >= 4){
                                         $comple_bike[] =  $pro->id;
                                       }else{
                                            //$pending_bike_ids[] = $pro->id;
                                            $pending_bike_ids[] = array('product_id'=>$pro->id,'product_name' => $pro->bike_name,'brand_id'=>$pro->brand_id, 'brand_name'=> @$pro->brand->brand_name, 'model_id'=> $pro->model_id,'model_name'=> @$pro->model->model_name);
                                       }
                                   }else{
                                       //$pending_bike_ids[] = $pro->id;
                                       $pending_bike_ids[] = array('product_id'=>$pro->id,'product_name' => $pro->bike_name,'brand_id'=>$pro->brand_id, 'brand_name'=> @$pro->brand->brand_name, 'model_id'=> $pro->model_id,'model_name'=> @$pro->model->model_name);
                                   }
                                }
                            }
                      
                            $count_product = count($comple_bike);
                        
                            $update = DB::table('users')->where(array('id'=>$logindata->id))->update($update_array);
                
                                $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "login";
                                $this->res['response']['message'] = 'Successfully logged in';
                                $this->res['response']['data'] = array(
                                "user_id"        =>      $logindata->id,
                                "name"           =>     $logindata->name .' '. $logindata->surname1,
                                "userToken"      =>     $token,
                                "email"          =>     $logindata->email,
                                "user_type"     =>      $logindata->user_type,
                                "device_token"   =>      $device_token,
                                "device_type"    =>      $deviceType,
                                "profile_pic"    =>      $profile_pic,
                                "bikes_uploaded"    =>      $count_product,
                                "pending_bike_ids" => $pending_bike_ids
                            );
                            
                        }else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = 'Please Fill Your Personal Information on website'; 
                        }
                        

                        
                    }else{
                        $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Please verify your email.'; 
                    }  
                }else{
                        $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Wrong Password...'; 
                    
                }
                }else{
                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = 'Invalid Login credentials'; 
                }
            }else{

                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = $access;

            }
        $this->ApiCommonHelper->error_log('user_registration', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    /*End */
    
    //forgot password
    public function forgot_password(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $email = $arr['RequestData']['email'];
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
                $logincount = DB::table('users')->where(array('email'=>$email))->select('id','verified_status','name','email');
                //echo $logincount;
                if($logincount->count()>0){
                
                //$logindata = DB::table('users')->where(array('email'=>$email))->first();
                $logindata=$logincount->first();
                $name=$logindata->name;
               
                    if($logindata->verified_status==1)
                    {
                        $otp=rand(100000,999999);
                        $otp_data=array(
                            'user_id' =>$logindata->id,
                            'otp' => $otp,
                            'is_expired' => 1,
                            'created_at' => NOW(),
                            'updated_at' => NOW()
                            );
                        $q_otp = DB::table('otp_expiry')->insert($otp_data);
                        if($q_otp)
                        {
                            $user_data=array(
                                'sender_email' =>  "admin@motoblockchain.es",
                                'name' => $name,
                                'email' => $email,
                                'subject' => 'Verification OTP',
                                'message' => 'OTP for Forgot Password request is <b>'.$otp.'</b> . Please Enter this to verify your identity. ',
                                'url' => ''
                            );
                            Mail::to($email)->send(new SendMail($user_data));
                            
                        }
                        
                        $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "forgot_password";
                        $this->res['response']['message'] = 'OTP Successfully sent on your email';
                        $this->res['response']['data'] = array(	);
                        
                    }else{
                        $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Please Verify your email..'; 
                        
                    }
                    
                }else{
                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = 'Email Not Found'; 
                
                }
                
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('user_registration', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    
    //verify otp
    public function verify_otp(){
        
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $email = $arr['RequestData']['email'];
        $otp = $arr['RequestData']['otp'];
        $newpassword = $arr['RequestData']['new_password'];
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
        $logindata = DB::table('users')->where(array('email'=>$email))->select('id','email');
        if($logindata->count()>0)
        {
            $logindata=$logindata->first();
            $user_id=$logindata->id;
            
                        $otpdata = DB::table('otp_expiry')->where(array('user_id'=>$user_id,'otp'=>$otp))
                                                            ->Where('is_expired', '!=', '0')
                                                            ->whereRaw('NOW() <= DATE_ADD(created_at, INTERVAL 24 HOUR)')
                                                            ->select('*');
                        if($otpdata->count()>0)
                        {
                           $otpdata= $otpdata->first();
                            if($otp==$otpdata->otp)
                            {
                                $uo=array('is_expired'=> 0, 'updated_at'=>NOW());
                                DB::table('otp_expiry')->where(array('user_id'=>$user_id,'otp'=>$otp))->update($uo);
                                $udata=array(
                                    'password' =>  Hash::make($newpassword),
                                    's_pass' => $newpassword,
                                    'updated_at' => NOW()
                                    );
                                $upadate=DB::table('users')->where(array('id'=>$user_id))->update($udata);
                                if($upadate)
                                {
                                   
                        			$this->res['successBool']  = true;
                                    $this->res['successCode']  = "200";
                                    $this->res['responseType'] = "password_changed";
                                    $this->res['response']['message'] = 'Password Successfully changed';
                                    $this->res['response']['data'] = array(	);
                                    
                                }else{
                                    $this->res['successBool'] = false;
                                    $this->res['ErrorObj']['ErrorCode'] = "105";
                                    $this->res['ErrorObj']['ErrorMsg'] = "Failed To change Password";
                                }
                                
                                
                            }else{
                               $this->res['successBool'] = false;
                                $this->res['ErrorObj']['ErrorCode'] = "105";
                                $this->res['ErrorObj']['ErrorMsg'] = "OTP Expired";
                            }
                            
                        }
                        else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Invalid OTP";
                        }
                        
                    
                    
                    
                    
                
            
        }else{
           $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = "Email Not Matched ";
        }
        
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('user_registration', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    public function user_registration()
    {
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey      =   $arr['RequestData']['apikey'];
        $v_code      =  $arr['RequestData']['v_code'];
       
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
             $name        =  $arr['RequestData']['name'];
            $email       =  $arr['RequestData']['email'];
            $password    =  $arr['RequestData']['password'];
            $user_type   =  $arr['RequestData']['user_type'];
            
            if(!empty($name) || !empty($email) || !empty($password) || !empty($user_type))
            {
                $check_email = User :: where('email', $email)->count();
                if($check_email == 0)
                {
                    //code from here
                    $a_token = md5(time());

                    $user_reg = new User;
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
                       
                       //to create individual user directory
                        $path = public_path().'/images/'.$user_id;
                        if(!File::isDirectory($path))
                        {
                            File::makeDirectory($path, 0777, true, true);
                        }
                        
                        $user_data=array(
                                'sender_email' => "admin@motoblockchain.es",
                                'name' => $name,
                                'email' => $email,
                                'subject' => 'Verify Your Mail',
                                'message' => 'Your created an acount on motoblockchain as '. $user_type.' . Please verify your email ',
                                'url' => $this->base_url.'/verify/'.$user_id.'/'.$a_token
                            );
                            Mail::to($email)->send(new SendMail($user_data));
                            
                        
                    $this->res['successBool']  = true;
                    $this->res['successCode']  = "200";
                    $this->res['responseType'] = "user_registration";
                    $this->res['response']['message'] = 'Verification Email Sent on Your Email';
                    $this->res['response']['data'] = array();
        
                           
                    }else{
                       $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Failed !! Please try again'; 
                    }
                    
                }else{
                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = 'This Email is Already Registerd '; 
                }
            }
            else{

                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = 'Some Required fields are missing..'; 
            }
           
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('user_registration', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    //to check access token
    public function check_user_token()
    {
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey      =   $arr['RequestData']['apikey'];
        $v_code      =  $arr['RequestData']['v_code'];
        $userToken   =   $arr['RequestData']['userToken'];
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);
        
        if($access==1)
        {
            $this->res['successBool']  = true;
            $this->res['successCode']  = "200";
            $this->res['responseType'] = "check_user_token";
            $this->res['response']['message'] = 'User Token Matched';
            $this->res['response']['data'] = array();
           
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('check_user_token', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    /*End*/
    /*
    public function user_login_testing(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
       
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
             $deviceType = $arr['RequestData']['deviceType'];
            $deviceID = $arr['RequestData']['deviceID'];
            $device_token = $arr['RequestData']['device_token'];
            $email = $arr['RequestData']['email'];
            $password = $arr['RequestData']['password'];
            
        $logincount = DB::table('users')->where(array('email'=>$email))->select('id','name','dni','surname1', 'surname2','email','password','user_type', 'verified_status');
        //echo $logincount;
        if($logincount->count() > 0){
        $datet = date("Y-m-d-H-i-s");
          $token = md5($datet.$email);
         $update_array = array(
            'token' => $token,
            'device_type' => $deviceType,
            'device_id' => $deviceID,
            'device_token' => $device_token,
            'updated_at' => NOW()
            );
        //$logindata = DB::table('users')->where(array('email'=>$email))->first();
        $logindata=$logincount->first();
        if(Hash::check($password, $logindata->password)){
            
            if($logindata->verified_status==1)
            {
                
                if(!empty($logindata->dni) && !empty($logindata->surname1))
                {
                    $user_id = $logindata->id;
                    
               
                $count_product = Product::where('user_id',$user_id)->get();
                $comple_bike = array();
                $pending_bike_ids = array();
                if(!empty($count_product)){
                    
                    foreach($count_product as $pro){

                       if(strpos($pro->upload_step_status, ','))
                       {
                           if(strlen(str_replace(',', '', $pro->upload_step_status)) >= 4)
                           {
                             $comple_bike[] =  $pro->id;
                               
                           }else{
                                $pending_bike_ids[] = array('id'=> $pro->id, 'status' => $pro->upload_step_status); 
                           }
                       }else{
                           $pending_bike_ids[] = array('id'=> $pro->id, 'status' => $pro->upload_step_status);
                       }
                    }
                }
                $pb_ids = array();
                $st = array();
                $st_m = array();
                $arr_m = array();
                foreach($pending_bike_ids as $k){
                    if(strpos($k['status'], ',')){
                        $st= explode(',', $k['status']);
                        
                    }else{
                        $st[]= $k['status'];
                    }
   
                    for($i=1; $i<=4; $i++){
                        $st_m[] = $i;
                    }
                    
                    $it = 0;
                    
                    foreach($st_m as $k1){
                        
                        //$ds = (!empty($st[$it]))? $st[$it] : '';
                        if (in_array($k1, $st)) {
                            $status = "true";
                        }else{
                           $status = "false";
                        }
                        
                        $arr_m[$k1] = $status;
                    
                        $it++;
                    }
                    
                   $pb_ids[]=array('id'=>$k['id'], 'step_status'=> $arr_m);
                }
   

                //print_r($pb_ids);
                //die();
                $count_product = count($comple_bike);
                
                $profile_pic='';
                if(!empty($logindata->profile_pic))
                {
                    $profile_pic =$this->base_url."/public/images/".$user_id."/".$logindata->profile_pic;
                }else{
                    $profile_pic =$this->base_url."/public/images/default_images/default_user.png";
                }
                $update = DB::table('users')->where(array('id'=>$logindata->id))->update($update_array);
        
        		    	$this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "login";
                        $this->res['response']['message'] = 'Successfully logged in';
                        $this->res['response']['data'] = array(
                                    							"user_id"        =>      $logindata->id,
                                    							"name"           =>     $logindata->name .' '. $logindata->surname1,
                                    							"userToken"      =>     $token,
                                    							"email"          =>     $logindata->email,
                                    							"user_type"     =>      $logindata->user_type,
                                                                "device_token"   =>      $device_token,
                                                                "device_type"    =>      $deviceType,
                                                                "profile_pic"    =>      $profile_pic,
                                                                "bikes_uploaded"    =>      $count_product,
                                                                "completed_bike_ids" => $comple_bike,
                                                                "pending_bike_ids" => $pb_ids
                                    						);
                    
                }else{
                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = 'Please Fill Your Personal Information on website'; 
                }
                

                
            }else{
                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = 'Please verify your email.'; 
            }
            
            
        }else{
                 $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = 'Wrong Password...'; 
            
        }
        
            }else{
                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = 'Invalid Login credentials'; 
            }
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('user_registration', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }*/
    /*End */
   
}
