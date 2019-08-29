<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


use App\Http\Helpers\ApiCommonHelper;

use Hash;
use Response;

class BrandModelController extends Controller{
    //
    
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
    //All category List
    public function category_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
            $user_id = $arr['RequestData']['user_id'];
            
                       $category= DB::table('motor_cycle_category')->get();
                       foreach($category as $cat)
                       {
                         $categ['id']=$cat->id;
                         $categ['category_name']=$cat->category_name;
                         $data[]=$categ;
                       }
                       //print_r($data);
                       $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "category_list";
                        $this->res['response']['message'] = 'Category List';
                        $this->res['response']['data'] = $data;
                       
            
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('category_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    //brand list
    public function brand_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);
        if($access==1)
        {
            $user_id = $arr['RequestData']['user_id'];
            
                       $brands= DB::table('motorcycle_brand')->get();
                       foreach($brands as $brand)
                       {
                         $categ['id']=$brand->id;
                         $categ['brand_name']=$brand->brand_name;
                         $data[]=$categ;
                       }
                       //print_r($data);
                       $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "brand_list";
                        $this->res['response']['message'] = 'Brand list';
                        $this->res['response']['data'] = $data;
                      
                       
               
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('brand_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
            
       
    }    
    //Country list
    public function country_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        $user_id = $arr['RequestData']['user_id'];
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);
        if($access==1)
        {
                       $countries = DB::table('country')->get();
                       if($countries)
                       {
                           foreach($countries as $country)
                           {
                             $categ['id']=$country->id;
                             $categ['name']=$country->country_name;
                             $data[]=$categ;
                           }
                           //print_r($data);
                           $this->res['successBool']  = true;
                            $this->res['successCode']  = "200";
                            $this->res['responseType'] = "country_list";
                            $this->res['response']['message'] = 'Country List';
                            $this->res['response']['data'] = $data;
                            
                       }else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "No country Available";
                       }
                       
                 
            
     }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('country_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    
    //State list Api
    public function state_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);
        if($access==1)
        {
            $user_id = $arr['RequestData']['user_id'];
            $country_id =$arr['RequestData']['country_id'];
                       $states = DB::table('state')->where('country_id',$country_id)->get();
                       if($states)
                       {
                           foreach($states as $state)
                           {
                             $categ['id']=$state->id;
                             $categ['name']=$state->state_name;
                             $data[]=$categ;
                           }
                           //print_r($data);
                           $this->res['successBool']  = true;
                            $this->res['successCode']  = "200";
                            $this->res['responseType'] = "state_list";
                            $this->res['response']['message'] = 'State List';
                            $this->res['response']['data'] = $data;
                            
                       }else{
                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "No State Available";
                       }
                       
                 
            
     }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('state_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    /*End method*/
    //Model list
    public function model_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        $user_id = $arr['RequestData']['user_id'];
        $brand_id = $arr['RequestData']['brand_id'];
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
                       $brands= DB::table('motorcycle_model')->where('brand_id',$brand_id)->get();
                       if($brands)
                       {
                            foreach($brands as $brand)
                           {
                             $categ['id']=$brand->id;
                             $categ['model_name']=$brand->model_name;
                             $data[]=$categ;
                           }
                           //print_r($data);
                           
                           $this->res['successBool']  = true;
                            $this->res['successCode']  = "200";
                            $this->res['responseType'] = "model_list";
                            $this->res['response']['message'] = 'Model List';
                            $this->res['response']['data'] = $data;
                         
                       }else{
                           $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "No Model Found";
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
    
    //cc Api list
    public function cc_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
             $user_id = $arr['RequestData']['user_id'];
                       $brands= DB::table('motor_cycle_cc')->get();
                       foreach($brands as $brand)
                       {
                         $categ['id']=$brand->id;
                         $categ['name']=$brand->cc_name;
                         $data[]=$categ;
                       }
                       //print_r($data);
                       $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "cc_list";
                        $this->res['response']['message'] = 'CC list';
                        $this->res['response']['data'] = $data;
                      
                       
               
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('cc_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
            
       
    }
    /*End method*/
    
    //cv original  Api list
    public function cv_original_list(){
        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
         $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey );
        if($access==1)
        {
             $user_id = $arr['RequestData']['user_id'];
                       $brands= DB::table('motor_cycle_cv_original')->get();
                       foreach($brands as $brand)
                       {
                         $categ['id']=$brand->id;
                         $categ['name']=$brand->cv_original_name;
                         $data[]=$categ;
                       }
                       //print_r($data);
                       $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "cv_original_list";
                        $this->res['response']['message'] = 'CV Original list';
                        $this->res['response']['data'] = $data;
                      
                       
               
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('cv_original_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
            
       
    }
    
}
//end class