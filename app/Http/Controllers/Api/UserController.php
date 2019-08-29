<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Http\Helpers\ApiCommonHelper;
use App\Models\Usermodel as User;

use Hash;
use Response;

class UserController extends Controller{
    
    private $base_url;
    
    protected $ApiCommonHelper;
    

    public function __construct(){
        //blockio init
        $this->base_url = url('/');
        $this->ApiCommonHelper = new ApiCommonHelper;
      
    }
    
    //Change password
    public function change_password(){
        //{"RequestData": {"v_code": "1.0","apikey": "fbb36f24d9b3985aa86fa37fd51c29eb","user_id":"3","userToken":"f80b14122874eb2a7ca561bf048636b3", "old_password": "123456","new_password": "12345678"}}
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
       
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
             $user_id = $arr['RequestData']['user_id'];
            $old_pass = $arr['RequestData']['old_password'];
            $new_pass = $arr['RequestData']['new_password'];
            
                    if(!empty($new_pass) || !empty($old_pass || !empty($user_id)))
                    {
                        $logincount = DB::table('users')->where(array('id'=>$user_id))->select('id','password','s_pass','updated_at');
                        //echo $logincount;
                        if($logincount->count()>0){
                            $logincount  =  $logincount->first();
                            if(Hash::check($old_pass, $logincount->password)) {
                                $update_data =array(
                                        'password' =>  Hash::make($new_pass),
                                        's_pass' => $new_pass,
                                        'updated_at' => NOW()
                                        );
                                $change_pass = DB::table('users')->where(array('id'=>$user_id))->update($update_data);
                                if($change_pass)
                                {
                                    $this->res['successBool']  = true;
                                    $this->res['successCode']  = "200";
                                    $this->res['responseType'] = "change_password";
                                    $this->res['response']['message'] = 'Password Successfully Changed';
                                    $this->res['response']['data'] = array();
                                    
                                }else{
                                    $this->res['successBool'] = false;
                                    $this->res['ErrorObj']['ErrorCode'] = "105";
                                    $this->res['ErrorObj']['ErrorMsg'] = 'Failed to update Password'; 
                                }
                            }else{
                                $this->res['successBool'] = false;
                                $this->res['ErrorObj']['ErrorCode'] = "105";
                                $this->res['ErrorObj']['ErrorMsg'] = 'Old Password Not mached'; 
                            }
                            
                        
                        }else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = 'User id Not found'; 
                        
                        }
                    }else{
                       $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Some Required fields are missing..'; 
                    }
        }else{
             $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;
        }
               
            
        $this->ApiCommonHelper->error_log('change_password', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    //logout API
    public function user_logout(){
        //{"RequestData": {"v_code": "1.0","apikey": "fbb36f24d9b3985aa86fa37fd51c29eb","user_id":"3","userToken":"f80b14122874eb2a7ca561bf048636b3"}}
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        $user_id = $arr['RequestData']['user_id'];
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
        
                   
                        $logincount = DB::table('users')->where(array('id'=>$user_id))->select('id');
                        //echo $logincount;
                        if($logincount->count()>0){
                            $update_data =array(
                                    'token' =>  '',
                                    'device_type' => '',
                                    'device_id' => '',
                                    'device_token' => '',
                                    'updated_at' => NOW()
                                    );
                            $logout = DB::table('users')->where(array('id'=>$user_id))->update($update_data);
                            if($logout)
                            {
                                
                    				$this->res['successBool']  = true;
                                    $this->res['successCode']  = "200";
                                    $this->res['responseType'] = "logout";
                                    $this->res['response']['message'] = 'Successfully Logged Out';
                                    $this->res['response']['data'] = array();
                                
                            }else{
                                $this->res['successBool'] = false;
                                $this->res['ErrorObj']['ErrorCode'] = "105";
                                $this->res['ErrorObj']['ErrorMsg'] = "Failed To update password";
                                
                            }
                        
                        }else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "User Id Not found";
                        
                        }
                   
                
                }else{
                     $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = $access;
                }
                       
                    
                $this->ApiCommonHelper->error_log('change_password', $this->res);
                header('access-control-allow-credentials: true');
                header('content-type: application/json');
                return response()->json($this->res);
    } 
}
