<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Productmodel as product;
use App\Models\Usermodel as User;
use App\Models\Pre_certificate as certificate;
use App\Models\Mediamodel as Media;
use Illuminate\Support\Facades\File;

use App\Http\Helpers\ApiCommonHelper;
use Hash;
use Response;
/*
Controller : Product Controller
Descrption : this controller is for implemention of all product related to MotoBlockchain motor bike with comblination of all related method.
Author : Dharma Chandra Kumar
*/
class ProductController extends Controller{
    /*
    Method : add_motor_cycle
    decription To add all type motor, bike, etc..
    */
    // Responce array
    
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
   
    public function bike_list(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $user_id     =  $arr['RequestData']['user_id'];  
            if(empty($user_id)){
                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = "User Id Required";
            }else{
            
                $query= DB::table('products')
                ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
                ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
                ->leftjoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
                ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
                ->leftjoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
                ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name', DB::raw('(select file from media_files where product_id = products.id and category= 6 order by id desc limit 1) as bike_photo'));
                
                $query->where('products.user_id',$user_id);
                $query->orderBy('id','DESC');
                $products = $query->get();

                $this->res['successBool']  = true;
                $this->res['successCode']  = "200";
                $this->res['responseType'] = "bike_list";
                $this->res['response']['message'] = 'Your bike list';

                if(empty($products)){
                    $this->res['response']['data'] = array();
                }else{
                    $this->res['response']['data'] = $products;    
                }
                $this->res['response']['count'] = count($products);
                 
            }

        }else{
                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = $access;
            } 

            $this->ApiCommonHelper->error_log('', $this->res);
            header('access-control-allow-credentials: true');
            header('content-type: application/json');
            return response()->json($this->res);
         
    }
    ////////////////////////
    public function add_motor_cycle(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $user_id     =  $arr['RequestData']['user_id'];
        $bike_name       =  $arr['RequestData']['motorcycle_name'];
        $category_id     =  $arr['RequestData']['category_id'];
        $circuit_dedicated     =  $arr['RequestData']['circuit_dedicated'];
        $brand_id        =  $arr['RequestData']['brand_id'];
        $model_id        =  $arr['RequestData']['model_id'];
        $year            =  $arr['RequestData']['year'];
        $cc_id           =  $arr['RequestData']['cc_id'];
        $cv_original_id  =  $arr['RequestData']['cv_original_id'];
        $other_cv_original =  $arr['RequestData']['other_cv_original'];
        $country         =  $arr['RequestData']['country_id'];
        $state           =  $arr['RequestData']['state_id'];
        $city            =  $arr['RequestData']['city'];
        $used_or_new     =  $arr['RequestData']['used_or_new'];
        
        $frame_no     =  $arr['RequestData']['frame_no'];
        $plate_no     =  $arr['RequestData']['plate_no'];
        
        $currency_code   =  $arr['RequestData']['currency_code'];
        $selling_price   =  $arr['RequestData']['selling_price'];
        
        $mileage_type    =  $arr['RequestData']['mileage_type'];
        $mileage         =  $arr['RequestData']['mileage'];
        
        $owner_name         =  $arr['RequestData']['owner_name'];
        $registration_date  =  $arr['RequestData']['registration_date'];
        
        $submit_btn      =  $arr['RequestData']['submit_btn'];
        
        
        //$submit_btn value 0 for save and 1 for save and go next
                    $data = array(
                                'user_id'       =>  $user_id,
                                'bike_name'     =>  $bike_name,
                                'category_id'   =>  $category_id,
                                'circuit_dedicated' => $circuit_dedicated,
                                'brand_id'      =>  $brand_id,
                                'model_id'      =>  $model_id,
                                'year'          =>  $year,
                                'country'       =>   $country,
                                'state'       =>   $state,
                                'city'           =>  $city,
                                'bike_cc'       =>  $cc_id,
                                'cv_original'   => $cv_original_id,
                                'frame_no'  => $frame_no,
                                'plate_no' => $plate_no,
                                'other_cv_original' => $other_cv_original,
                                'new_or_used'       => $used_or_new,
                                'currency_code' =>  $currency_code,
                                'selling_price' =>  $selling_price,
                                'c_mileage_type' => $mileage_type,
                                'c_mileage'     =>  $mileage,
                                'status'        =>  1,
                                'upload_step_status' => 1,
                                'created_at'    =>  NOW(),
                                'updated_at'    =>  NOW()
                    
                             );
                    
                            
                    //content here
                    if($submit_btn=='0'){
                        
                         $result_id = DB::table('products')->insertGetId($data);
                         if($result_id){
                             $product_id =$result_id;
                             if($used_or_new=='1')
                             {
                                 
                                 $data1= array(
                                        'product_id'         => $product_id,
                                        'owner_name'         =>  $owner_name,
                                        'registration_date'  => $registration_date ,
                                        'created_at'        => NOW(),
                                        'updated_at'        => NOW(),
                                     );
                                 DB::table('previous_owners_details')->insert($data1);
                             }
                             
                              $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "save_bike";
                                $this->res['response']['message'] = 'Successfully Saved';
                                $this->res['response']['data'] = array('product_id' => $product_id, 'product_name'=> $bike_name,'brand_id'=>$brand_id, 'brand_name' =>  $this->ApiCommonHelper->get_brand_name($brand_id), 'model_id'=>$model_id, 'model_name' => $this->ApiCommonHelper->get_model_name($model_id));
                             
                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Save data";
                             
                         }
                    }
                    if($submit_btn=='1'){
                         $result_id = DB::table('products')->insertGetId($data);
                          if($result_id){
                              $product_id =$result_id;
                              if($used_or_new=='1')
                                 {
                                     
                                     $data1= array(
                                            'product_id'         => $product_id,
                                            'owner_name'         =>  $owner_name,
                                            'registration_date'  => $registration_date ,
                                            'created_at'        => NOW(),
                                            'updated_at'        => NOW(),
                                         );
                                     DB::table('previous_owners_details')->insert($data1);
                                 }
                                 
                               $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "save_and_add_photo";
                                $this->res['response']['message'] = 'Successfully Added';
                                $this->res['response']['data'] = array('product_id' => $product_id, 'product_name'=> $bike_name,'brand_id'=>$brand_id, 'brand_name' =>  $this->ApiCommonHelper->get_brand_name($brand_id), 'model_id'=>$model_id, 'model_name' => $this->ApiCommonHelper->get_brand_name($model_id));

                           
                             
                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Save and add  photo";
                             
                         }
                    }
                    
                }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    
    /*End */
    
    
    /*product detail Api*/
    
    public function product_detail(){
         $input      =   file_get_contents('php://input');
        $arr         =  json_decode($input,true);
        $req         =  $arr['RequestData'];
        $userToken   =    $req['userToken'];
        $access      =     $this->ApiCommonHelper->check_valid_version($req['v_code'], $req['apikey']);

        if($access == 1){
            $product_id = $req['product_id'];
            
            
            //$product = Product::where('id',$product_id)->first();
         $product = DB::table('products')
            ->leftJoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->leftJoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->leftJoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
            ->leftJoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->leftJoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
            ->leftJoin('country', 'country.id', '=', 'products.country')
            ->leftJoin('state', 'state.id', '=', 'products.state')
            ->leftJoin('previous_owners_details', 'previous_owners_details.product_id', '=', 'products.id')
            
            ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name','country.country_name', 'state.state_name','previous_owners_details.owner_name','previous_owners_details.registration_date')
            ->where('products.id',$product_id)
            ->first(); 
               // print_r($pb_ids);
                
                
                         $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "product_detail";
                        $this->res['response']['message'] = 'Product Detail';
                        $this->res['response']['data'] = $product;
                
            
            
        }else{
            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;
        }
        
        $this->ApiCommonHelper->error_log('product_detail', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    /*end*/
    
    
    
    public function update_motor_cycle(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            
        $product_id     =  $arr['RequestData']['product_id'];
        
        $count_bike = DB::table('products')->where('id',$product_id)->count();
        if($count_bike > 0)
        {
            $user_id     =  $arr['RequestData']['user_id'];
            $bike_name       =  $arr['RequestData']['motorcycle_name'];
            $category_id     =  $arr['RequestData']['category_id'];
            $circuit_dedicated     =  $arr['RequestData']['circuit_dedicated'];
            $brand_id        =  $arr['RequestData']['brand_id'];
            $model_id        =  $arr['RequestData']['model_id'];
            $year            =  $arr['RequestData']['year'];
            $cc_id           =  $arr['RequestData']['cc_id'];
            $cv_original_id  =  $arr['RequestData']['cv_original_id'];
            $other_cv_original =  $arr['RequestData']['other_cv_original'];
            $frame_no       =  $arr['RequestData']['frame_no'];
            $plate_no       =  $arr['RequestData']['plate_no'];
            $country         =  $arr['RequestData']['country_id'];
            $state           =  $arr['RequestData']['state_id'];
            $city            =  $arr['RequestData']['city'];
            $used_or_new     =  $arr['RequestData']['used_or_new'];
            $currency_code   =  $arr['RequestData']['currency_code'];
            $selling_price   =  $arr['RequestData']['selling_price'];
            
            $mileage_type    =  $arr['RequestData']['mileage_type'];
            $mileage         =  $arr['RequestData']['mileage'];
            
            $owner_name         =  $arr['RequestData']['owner_name'];
            $registration_date  =  $arr['RequestData']['registration_date'];
            
            $submit_btn      =  $arr['RequestData']['submit_btn'];
            
            
            //$submit_btn value 0 for save and 1 for save and go next
                        $data = array(
                                    'bike_name'     =>  $bike_name,
                                    'category_id'   =>  $category_id,
                                    'circuit_dedicated' => $circuit_dedicated,
                                    'brand_id'      =>  $brand_id,
                                    'model_id'      =>  $model_id,
                                    'year'          =>  $year,
                                    'country'       =>   $country,
                                    'state'        =>   $state,
                                    'city'           =>  $city,
                                    'bike_cc'       =>  $cc_id,
                                    'cv_original'   =>  $cv_original_id,
                                    'frame_no'      =>  $frame_no,
                                    'plate_no'      =>  $plate_no,
                                    'other_cv_original' => $other_cv_original,
                                    'new_or_used'       => $used_or_new,
                                    'currency_code'     =>  $currency_code,
                                    'selling_price'     =>  $selling_price,
                                    'c_mileage_type'     => $mileage_type,
                                    'c_mileage'          =>  $mileage,
                                    'updated_at'         =>  NOW()
                        
                                 );
                        
                                
                        //content here
               
                            
                             $result_id = DB::table('products')->where('id',$product_id)->update($data);
                             if($result_id){
                                 if($used_or_new=='1')
                                 {
                                     $data1= array(
                                            'product_id'         => $product_id,
                                            'owner_name'         =>  $owner_name,
                                            'registration_date'  => $registration_date ,
                                            'created_at'        => NOW(),
                                            'updated_at'        => NOW(),
                                         );
                                     DB::table('previous_owners_details')->where('product_id',$product_id)->update($data1);
                                 }
                                 
                                     $this->res['successBool']  = true;
                                    $this->res['successCode']  = "200";
                                    $this->res['responseType'] = "update_bike";
                                    $this->res['response']['message'] = 'Successfully Updated';
                                    $this->res['response']['data'] = array('product_id' => $product_id, 'product_name'=> $bike_name,'brand_id'=>$brand_id, 'brand_name' =>  $this->ApiCommonHelper->get_brand_name($brand_id), 'model_id'=>$model_id, 'model_name' => $this->ApiCommonHelper->get_model_name($model_id));
                                 
                             }else{
                                 $this->res['successBool'] = false;
                                $this->res['ErrorObj']['ErrorCode'] = "105";
                                $this->res['ErrorObj']['ErrorMsg'] = "Failed to Update data";
                                 
                             }
            
        }else{
             $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = "No Motorcycle found in this id";
        }   
    }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    
    /*End */
    // list Machanic
        public function mechanic_list(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $product_id          =  $arr['RequestData']['product_id'];
            $result = DB::table('product_mechanic_details')->where('product_id', $product_id)->get();
             if(!empty($result)){
                  $this->res['successBool']  = true;
                    $this->res['successCode']  = "200";
                    $this->res['responseType'] = "mechanic_list";
                    $this->res['response']['message'] = 'mechanic list';
                    $this->res['response']['data'] = $result;
                 
             }else{
                 $this->res['successBool'] = false;
                $this->res['ErrorObj']['successCode'] = "200";
                $this->res['responseType'] = "mechanic_list";
                $this->res['response']['message'] = 'No data found';
                $this->res['response']['data'] = array();
                 
             }
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

            } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    //To add mechanic details
    public function add_mechanic_details(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
        $mac_id              =  (!empty($arr['RequestData']['mechanic_id'])) ? $arr['RequestData']['mechanic_id'] : '';
        $product_id          =  $arr['RequestData']['product_id'];
        $mechanic_name       =  $arr['RequestData']['mechanic_name'];
        $mechanic_web        =  $arr['RequestData']['mechanic_web'];
        $mechanic_address    =  $arr['RequestData']['mechanic_address'];
        $mechanic_email      =  $arr['RequestData']['mechanic_email'];
        $mechanic_phone      =  $arr['RequestData']['mechanic_phone'];
        $privacy             =  $arr['RequestData']['privacy'];
        $submit_btn          =  $arr['RequestData']['submit_btn'];

        $data = array(
                    'product_id'        =>  $product_id,
                    'mechanic_name'     =>  $mechanic_name,
                    'mechanic_web'      =>  $mechanic_web,
                    'mechanic_address'  =>  $mechanic_address,
                    'mechanic_email'     =>  $mechanic_email,
                    'mechanic_phone'     =>  $mechanic_phone,
                    'privacy'       =>   $privacy,
                    'created_at'    =>  NOW(),
                    'updated_at'    =>  NOW()
                 );
                            
                    //content here
                    if($submit_btn=='0'){
                        if($mac_id != ''){
                            DB::table('product_mechanic_details')
                            ->where('id', $mac_id)
                            ->update($data);
                            $result_id = $mac_id;
                        }else{
                            $result_id = DB::table('product_mechanic_details')->insertGetId($data);
                        }

                         if($result_id){
                              $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "save_details";
                                $this->res['response']['message'] = 'Successfully Saved';
                                $this->res['response']['data'] = array();
                             
                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Save data";
                             
                         }
                    }
                    if($submit_btn=='1'){
                        if($mac_id != ''){
                            DB::table('product_mechanic_details')
                            ->where('id', $mac_id)
                            ->update($data);
                            $result_id = $mac_id;
                        }else{
                            $result_id = DB::table('product_mechanic_details')->insertGetId($data);
                        }

                          if($result_id){
                              
                               $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "save_and_finish_later";
                                $this->res['response']['message'] = 'Successfully Added';
                                $this->res['response']['data'] = array();

                           
                             
                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Save ";
                             
                         }
                    }
                    
                }else{

                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = $access;

                } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    /*End */
    
    //To add mechanic details
    
    
    /* Add invoice details */
    public function add_invoice_details(Request $request){

        
        $apikey         = $request->apikey;
        $v_code         = $request->v_code;
        //$userToken    = $request->userToken;
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){

        $user_id             =  $request->user_id;
        $product_id          =  $request->product_id;
        $media_id          =  $request->media_id;
        $related_id          =  $request->related_id;
        $name                =  $request->name;
        $invoice_type        =  $request->invoice_type;
        $invoice_name        =  $request->invoice_name;
        $invoice_other_name  =  $request->invoice_other_name;
        $currency_code       =  $request->currency_code;
        $invoice_details     =  $request->invoice_details;
        
        $total_money_spent   =  $request->total_money_spent;
        $t_m_spent_accessories  =  $request->t_m_spent_accessories;
        $t_m_spent_components   =  $request->t_m_spent_components;
        
        $privacy              =  $request->privacy;
        $time_stamp           =  $request->time_stamp;
        $submit_btn           =  $request->submit_btn;
        
       
        //$img_name              = '';
        //$invoice_photo_org_name = '';


                 // if ($request->hasFile('invoice_photo')) {
                 //        $invoice_photo = $request->file('invoice_photo');
                 //        $invoice_photo_org_name = $invoice_photo->getClientOriginalName();
                 //        $img_name = time().'.'.$invoice_photo->getClientOriginalExtension();
                        
                 //        //to create individual user directory
                 //        $path = public_path().'/images/'.$user_id.'/'.$product_id;
                 //        if(!File::isDirectory($path))
                 //        {
                 //            File::makeDirectory($path, 0777, true, true);
                 //        }
                 //        $invoice_photo->move($path, $img_name);
                       
                 //    }

           

                    $data = array(
                                'user_id'                => $user_id,
                                'product_id'             =>  $product_id,
                                'name'                   =>  $name,
                                'invoice_type'           =>  $invoice_type,
                                'invoice_name'           =>  $invoice_name,
                                'invoice_other_name'      =>  $invoice_other_name,
                                'currency_code'           =>  $currency_code,
                                'total_money_spent'      =>  $total_money_spent,
                                't_m_spent_accessories'  =>  $t_m_spent_accessories,
                                't_m_spent_components'   =>  $t_m_spent_components,
                                'media_id'               =>  $media_id,
                                'related_id'               =>  $related_id,
                                'privacy'                =>   $privacy,
                                'created_at'             =>  $time_stamp,
                                'updated_at'             =>  NOW()
                    
                             );
                             //'invoice_photo_o_name'   =>   $invoice_photo_org_name,
                             //'invoice_photo_tmp_name' => $img_name,

                            // print_r($data);
                    
                            
                    //content here
                    //$submit_btn 0= save and 1= finish & next
                    if($submit_btn=='0'){
                        if(!empty($request->invoice_id)){
                            DB::table('product_invoice')
                            ->where('id', $request->invoice_id)
                            ->update($data);
                            $result_id = $request->invoice_id;
                        }else{
                            $result_id = DB::table('product_invoice')->insertGetId($data);
                        }                        

                         if($result_id){
                             //to update upload step status
                             $pro = DB::table('products')->where('id',$product_id)->first();
                             $string = $pro->upload_step_status;
                             $step_status= explode(',', $string);
                              if(in_array(3, $step_status))
                              {
                                  //nothing happen
                              }else{
                                  $final_string = $string.",3";
                                    $aa = explode(',',$final_string);
                                    sort($aa);
                                    $final_string = implode (",", $aa);
                                  DB::table('products')->where('id',$product_id)->update(array('upload_step_status'=>$final_string));
                              }
                             
                             
                              $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "save_details";
                                $this->res['response']['message'] = 'Successfully Saved';
                                $this->res['response']['data'] = array();
                             
                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Save data";
                             
                         }
                    }
                    if($submit_btn=='1'){
                        if(!empty($request->invoice_id)){
                            DB::table('product_invoice')
                            ->where('id', $request->invoice_id)
                            ->update($data);
                            $result_id = $request->invoice_id;
                        }else{
                            $result_id = DB::table('product_invoice')->insertGetId($data);
                        }
                          if($result_id){
                              
                              //to update upload step status
                             $pro = DB::table('products')->where('id',$product_id)->first();
                             $string = $pro->upload_step_status;
                             $step_status= explode(',', $string);
                              if(in_array(3, $step_status))
                              {
                                  //nothing happen
                              }else{
                                  $final_string = $string.",3";
                                    $aa = explode(',',$final_string);
                                    sort($aa);
                                    $final_string = implode (",", $aa);
                                  DB::table('products')->where('id',$product_id)->update(array('upload_step_status'=>$final_string));
                              }
                              
                               $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "save_and_finish_later";
                                $this->res['response']['message'] = 'Successfully Added';
                                $this->res['response']['data'] = array();

                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Save ";
                             
                         }
                    }
                    
                }else{

                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    /*End */
    
    
    
    /* Update invoice details */
    public function update_invoice_details(Request $request){

        
        $apikey             = $request->apikey;
        $v_code             = $request->v_code;
        //$userToken        = $request->userToken;
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
        $invoice_id          =  $request->invoice_id;
        $user_id             =  $request->user_id;
        $product_id          =  $request->product_id;
        $media_id            =  $request->media_id;
        $related_id          =  $request->related_id;
        $name                =  $request->name;
        $invoice_type        =  $request->invoice_type;
        $invoice_name        =  $request->invoice_name;
        $invoice_other_name  =  $request->invoice_other_name;
        $currency_code       =  $request->currency_code;
        $invoice_details     =  $request->invoice_details;
        
        $total_money_spent   =  $request->total_money_spent;
        $t_m_spent_accessories  =  $request->t_m_spent_accessories;
        $t_m_spent_components    =  $request->t_m_spent_components;
        
        $privacy              =  $request->privacy;
        $time_stamp           =  $request->time_stamp;
        $submit_btn           =  $request->submit_btn;
        
       
       //  $img_name            =     '';
       // $invoice_photo_o_name ='';
       //           if($request->hasFile('invoice_photo')) {
       //                  $invoice_photo = $request->file('invoice_photo');
       //                  $invoice_photo_o_name = $invoice_photo->getClientOriginalName();
       //                  $img_name = time().'.'.$invoice_photo->getClientOriginalExtension();
                        
       //                  //to create individual user directory
       //                  $path = public_path().'/images/'.$user_id.'/'.$product_id;
       //                  if(!File::isDirectory($path))
       //                  {
       //                      File::makeDirectory($path, 0777, true, true);
       //                  }
       //                  $invoice_photo->move($path, $img_name);
                       
       //              }else{
       //                  $m_count = DB::table('product_invoice')->where('id', $invoice_id)->count();
       //                  if($m_count>0)
       //                  {
       //                      $m = DB::table('product_invoice')->where('id', $invoice_id)->first();
       //                      $invoice_photo_o_name = $m->invoice_photo_o_name;
       //                       $img_name = $m->invoice_photo_tmp_name;
       //                  }
                        
       //              }

           

                    $data = array(
                                'user_id'                => $user_id,
                                'product_id'             =>  $product_id,
                                'media_id'               =>  $media_id,
                                'related_id'             =>  $related_id,
                                'name'                   =>  $name,
                                'invoice_type'           =>  $invoice_type,
                                'invoice_name'           =>  $invoice_name,
                                'invoice_other_name'     =>  $invoice_other_name,
                                'currency_code'          =>  $currency_code,
                                'invoice_details'        =>  $invoice_details,
                                'total_money_spent'      =>  $total_money_spent,
                                't_m_spent_accessories'  =>  $t_m_spent_accessories,
                                't_m_spent_components'   =>  $t_m_spent_components,
                                'privacy'                =>   $privacy,
                                'updated_at'             =>  NOW()
                    
                             );
                             
                        //print_r($data);
                    // 'invoice_photo_o_name'   =>   $invoice_photo_o_name,
                    //             'invoice_photo_tmp_name' => $img_name,
                            
                    //content here
                    $result_id = DB::table('product_invoice')->where('id',$invoice_id)->update($data);
                         if($result_id){
                             //to update upload step status
                             $pro = DB::table('products')->where('id',$product_id)->first();
                             $string = $pro->upload_step_status;
                             $step_status= explode(',', $string);
                              if(in_array(3, $step_status))
                              {
                                  //nothing happen
                              }else{
                                  $final_string = $string.",3";
                                    $aa = explode(',',$final_string);
                                    sort($aa);
                                    $final_string = implode (",", $aa);
                                  DB::table('products')->where('id',$product_id)->update(array('upload_step_status'=>$final_string));
                              }
                             
                             
                              $this->res['successBool']  = true;
                                $this->res['successCode']  = "200";
                                $this->res['responseType'] = "update_details";
                                $this->res['response']['message'] = 'Successfully Updated';
                                $this->res['response']['data'] = array();
                             
                         }else{
                             $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = "Failed to Update data";
                             
                         }
                
                   
                    
                }else{

                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = $access;

        } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    /*End */
    
    /*add all photos taken from the app*/
    public function add_photo(Request $request){
        
        $deviceType         = $request->deviceType;
        $deviceID           = $request->deviceID;
        $userToken          = $request->userToken;
        
        $access = $this->ApiCommonHelper->check_valid_version($request->v_code, $request->apikey);

        if($access == 1){

            // creating Hash for Image.
            if((!empty($request->user_id)) && (!empty($request->product_id)) && (!empty($request->type)) && (!empty($request->title)) && (!empty($request->description)) && (!empty($request->file('media')))){

                $userid             = $request->user_id;
                $product_id         = $request->product_id;
                $type               = $request->type;
                $media              = $request->media;
                $title              = $request->title;
                $description        = $request->description;
                $app_timestamp      = $request->app_timestamp;
                $privacy            = $request->privacy;
                $gps                = (!empty($request->gps))? $request->gps : '';

                $file = $request->file('media');

                $destinationPath    = public_path().'/images/'.$userid.'/'.$product_id;

                $ext                = $file->guessClientExtension();  
                $fullname           = $file->getClientOriginalName(); 
                $hash_code          = hash('sha256', $fullname . strval(time()));
                $hashname           = $hash_code.'.'.$ext; 

                if($file->move($destinationPath, $hashname)){

                    $models                = new Media;
                    $models->user_id       = $userid;
                    $models->product_id    = $product_id;
                    $models->category      = $type;
                    $models->title         = $title;
                    $models->description   = $description;
                    $models->media_type    = $ext;
                    $models->file          = $hashname;
                    $models->privacy       = $privacy;
                    $models->hash_code     = $hash_code;
                    $models->app_timestamp = $app_timestamp;
                    $models->gps           = $gps;

                    if($models->save()){
                        
                        //To update status of upload_tep_status
                        
                        $check_required_status = Media::where(array('product_id'=>$product_id,'user_id'=>$userid))->get();
                       $required = array(10,11,12,13);
                       $uploaded = array();
                        foreach($check_required_status as $status)
                        {
                            $uploaded[] = $status->category;
                        }        
                        
                      $aa = array_values(array_intersect($required,$uploaded));
                      sort($required);
                      sort($aa);
                      if($required==$aa)
                      {  
                         $pro = DB::table('products')->where('id',$product_id)->first();
                         $string = $pro->upload_step_status;
                         $step_status= explode(',', $string);
                          if(in_array(2, $step_status))
                          {
                              //nothing happen
                          }else{
                              $final_string = $string.",2";
                               $aa = explode(',',$final_string);
                                sort($aa);
                                $final_string = implode (",", $aa);
                              DB::table('products')->where('id',$product_id)->update(array('upload_step_status'=>$final_string));
                          }
                      }
                        

                        $this->res['successBool']  = true;
                        $this->res['successCode']  = "200";
                        $this->res['responseType'] = "add_media";
                        $this->res['response']['message'] = 'Media File Uploaded Successfully..';
                        $this->res['response']['data'] = array('media_id'=>$models->id,'user_id' => $userid, 'product_id' => $product_id, 'category' => $type, 'title' => $title, 'description' => $description, 'media_type' => $ext, 'file' => url('/public').'/images/'.$userid.'/'.$product_id.'/'.$hashname, 'hash_code' => $hash_code,'app_timestamp'=>$app_timestamp, 'gps'=>$gps);


                    }else{

                        $this->res['successBool'] = false;
                        $this->res['ErrorObj']['ErrorCode'] = "105";
                        $this->res['ErrorObj']['ErrorMsg'] = 'Some thing went wrong in Query..'; 

                    }
                }else{

                    $this->res['successBool'] = false;
                    $this->res['ErrorObj']['ErrorCode'] = "105";
                    $this->res['ErrorObj']['ErrorMsg'] = 'Media Files are not correct.';

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

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }   

    public function pre_certificate(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);

        $req = $arr['RequestData'];
        $userToken = $req['userToken'];

        $access = $this->ApiCommonHelper->check_valid_version($req['v_code'], $req['apikey']);

        if($access == 1){

            // creating Hash for Image.
            if((!empty($req['user_id'])) && (!empty($req['title'])) && (!empty($req['product_id'])) && (!empty($req['blockchain_timestamp'])) && (!empty($req['description']))){

                $users  = User::where(array('id' => $req['user_id']))->first();

                $pro = DB::table('products')->select('bike_name', 'upload_step_status')->where('id', $req['product_id'])->first();
                $certi_number = mt_rand(1000000000, 9999999999);
                $bike_name = (!empty($pro->bike_name))? $pro->bike_name : '';
                $title = (!empty($req['title']))? $req['title'] : '';
                $description = (!empty($req['description']))? $req['description'] : '';
                $nickname = (!empty($users->nickname))? $users->nickname : '';
                $blockchain_timestamp = (!empty($req['blockchain_timestamp']))? $req['blockchain_timestamp'] : '';
                    $data= array(
                        "user_id"                => $req['user_id'],
                        "product_id"             => $req['product_id'],
                        "user_motorcycle"        => $bike_name,
                        "title"                  => $title,
                        "blockchain_timestamp"   => $blockchain_timestamp,
                        "description"            => $req['description'],
                        "user_name"              => $nickname,
                        "certi_number"           => $certi_number,
                        "media_ids"              => $req['media_ids']
                    );

                    $media_data = array();

                    $m_ids = $req['media_ids'];
                    $me_ids = explode(',', $m_ids);
                    $medias = Media::select('*')->whereIn('id', $me_ids)->get();

                    foreach ($medias as $media) {

                        $media_data[] = array('media_id'=>$media->id,'user_id' => $media->user_id, 'product_id' => $media->product_id, 'category' => $media->category, 'title' => $media->title, 'description' => $media->description, 'media_type' => $media->media_type, 'file' => url('/public').'/images/'.$media->user_id.'/'.$media->product_id.'/'.$media->hash_code.'.'.$media->media_type, 'hash_code' => $media->hash_code,'app_timestamp'=>$media->app_timestamp, 'gps'=>$media->gps);

                    }
                    //$media->user_id
                    $get_certi = certificate::where('user_id', $req['user_id'])->get();
                    // Update Steps

                    $u_st = (!empty($pro->upload_step_status)) ? $pro->upload_step_status : '';
                    $u_s = explode(',',$u_st);

                    if(is_array($u_s)){
                        if(in_array(4, $u_s)){
                            $u_s = $u_s;
                        }else{
                            array_push($u_s, 4);
                        }
                    }
                    $status_u = implode(',', $u_s);
                    //////////////////

                    if($get_certi->count()){
                        //$media->user_id
                        $update_cert = DB::table('pre_certificate')->where('user_id', $req['user_id'])->update($data);
                        if($update_cert){

                            DB::table('products')
                            ->where('user_id', $req['user_id'])
                            ->where('id', $req['product_id'])
                            ->update(array('upload_step_status'=> $status_u));

                            $data['media_ids'] = $media_data;
                            $this->res['successBool']  = true;
                            $this->res['successCode']  = "200";
                            $this->res['responseType'] = "add_media";
                            $this->res['response']['message'] = 'certificate Updated Successfully..';
                            $this->res['response']['data'] = $data;

                        }else{

                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = 'Some thing went wrong in Query..'; 

                        }

                    }else{

                        if(DB::table('pre_certificate')->insert($data)){
/*
                            DB::table('products')
                            ->where('user_id', $req['user_id'])
                            ->where('product_id', $req['product_id'])
                            ->update(array('upload_step_status'=> $status_u));
*/

                            $data['media_ids'] = $media_data;

                            $this->res['successBool']  = true;
                            $this->res['successCode']  = "200";
                            $this->res['responseType'] = "add_media";
                            $this->res['response']['message'] = 'certificate Created Successfully..';
                            $this->res['response']['data'] = $data;

                        }else{

                            $this->res['successBool'] = false;
                            $this->res['ErrorObj']['ErrorCode'] = "105";
                            $this->res['ErrorObj']['ErrorMsg'] = 'Some thing went wrong in Query..'; 

                        }

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

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }  
    // get bike list for user profile.
    public function user_dashboard(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        $req = $arr['RequestData'];
        $userToken = $req['userToken'];
        $access = $this->ApiCommonHelper->check_valid_version($req['v_code'], $req['apikey']);

        if($access == 1){

            if(!empty($req['user_id'])){
                // Bike Listing.
                $products = DB::table('products')->where('user_id', $req['user_id'])->get();
                $bike = array();
                foreach($products as $product){
                    $bike[] = $product;
                }

                $this->res['successBool']  = true;
                $this->res['successCode']  = "200";
                $this->res['responseType'] = "bike_list";
                $this->res['response']['message'] = 'Bike Listing.';
                $this->res['response']['data'] = $bike;

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

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }
    /*End */
    
    
    /*To check the steps completed by the users for a product*/
    public function product_upload_step_status(){
        $input       =   file_get_contents('php://input');
        $arr         =  json_decode($input,true);
        $req         =  $arr['RequestData'];
        $userToken   =    $req['userToken'];
        $access      =     $this->ApiCommonHelper->check_valid_version($req['v_code'], $req['apikey']);

        if($access == 1){
            $product_id = $req['product_id'];
            $user_id = $req['user_id'];
            $product = Product::where('id',$product_id)->first();
                $comple_bike = array();
                $pending_bike_ids = array();
                if(count($product) >0){
                   

                       if(strpos($product->upload_step_status, ','))
                       {
                           if(strlen(str_replace(',', '', $product->upload_step_status)) >= 4)
                           {
                             $comple_bike[] =  $product->id;
                               
                           }else{
                                $pending_bike_ids[] = array('id'=> $product->id, 'status' => $product->upload_step_status); 
                           }
                       }else{
                           $pending_bike_ids[] = array('id'=> $product->id, 'status' => $product->upload_step_status);
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
                        if($k1 == 4){
                            $arr_m[$k1] = "true";
                        }else{
                           $arr_m[$k1] = $status; 
                        }
                        
                    
                        $it++;
                    }
                  // $pb_ids[]=array('id'=>$k['id'], 'step_status'=> $arr_m);
                }
                
               // print_r($pb_ids);
               $get_pro_invoice ='';
               $get_pro_invoice_count = DB::table('product_invoice')->where('product_id', $product_id)->count();
               if($get_pro_invoice_count>0){


                   $get_pro_invoice = DB::table('product_invoice')->select("product_invoice.*", "product_invoice.id as invoice_id","media_files.title", "media_files.description", "media_files.media_type", "media_files.category", "media_files.category", "media_files.file", "media_files.hash_code", "media_files.status")
                   ->leftjoin('media_files', 'media_files.id', '=', 'product_invoice.media_id')
                   ->where('product_invoice.product_id', $product_id)
                   ->where('product_invoice.user_id', $user_id)
                   ->first();

                   $image = $this->base_url.'/public/images/'.$get_pro_invoice->user_id.'/'.$get_pro_invoice->product_id.'/'.$get_pro_invoice->invoice_photo_tmp_name;
                    $get_pro_invoice->invoice_photo_tmp_name = $image;

                    
               }else{
                   $get_pro_invoice =array(
                                    "id" => '',
                                    "user_id" => '',
                                    "product_id" => '',
                                    "media_id" => '',
                                    "related_id" => '',
                                    "name"=> '',
                                    "invoice_type" => '',
                                    "invoice_name" => '',
                                    "invoice_other_name" => '',
                                    "currency_code" => '',
                                    "invoice_details" => '',
                                    "total_money_spent"=> '',
                                    "t_m_spent_accessories"=> '',
                                    "t_m_spent_components"=> '',
                                    "t_m_spent_invoice"=> '',
                                    "t_m_spent_replacement"=> '',
                                    "invoice_photo_o_name"=> '',
                                    "invoice_photo_tmp_name"=> '',
                                    "privacy"=> '',
                                    "created_at"=> '',
                                    "updated_at"=> '',
									"invoice_id"=> '',
									"title"=> '',
									"description"=> '',
									"media_type"=> '',
									"category"=> '',
									"file"=> '',
									"hash_code"=> '',
									"status"=> ''
                                    
                    );
                   /*
"title"=> '',
                                    "description"=> '',
                                    "media_type"=> '',
                                    "category"=> '',
                                    "file"=> '',
                                    "hash_code"=> '',
                                    "app_timestamp"=> '',
                                    "gps"=> '',
                                    "status"=> ''
                   */
               }
             
                
                        $this->res['successBool']               = true;
                        $this->res['successCode']               = "200";
                        $this->res['responseType']              = "upload_step_status";
                        $this->res['response']['message']       = 'Upload Steps Status';
                        $this->res['response']['data']          = (object)$arr_m;
                        $this->res['response']['invoice_detail']= $get_pro_invoice;
                        
                
            
            
        }else{
            $this->res['successBool']           = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg']  = $access;
        }
        
        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    public function add_photo_list(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $product_id = $arr['RequestData']['product_id'];
            $list = DB::table('add_photo_list')->select('id', 'name', 'sequence_no')->orderBy('sequence_no', 'asc')->get();
           
            
            if($list)
            {
                $this->res['successBool']           = true;
                $this->res['successCode']           = "200";
                $this->res['responseType']          = "add_photo_list";
                $this->res['response']['message']   = 'Add photo List';
                $this->res['response']['data']      = $list;
            }else{
                
            }
            
        }else{
            $this->res['successBool']           = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg']  = $access;
        }
        
        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    
    public function photos_upload_status(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $product_id = $arr['RequestData']['product_id'];
            $list = DB::table('add_photo_list')->select('id', 'name')->get();
            $pro_cat = DB::table('media_files')->where('product_id',$product_id)->get();
            //1,
            $c = array(10,11,12,13);
            $category = array();
            foreach($pro_cat as $cat)
            {  
                $category[] = $cat->category;
                
            }
            
            $aa = array_values(array_diff($c, $category));
            if($list)
            {
                $this->res['successBool']  = true;
                $this->res['successCode']  = "200";
                $this->res['responseType'] = "upload_photo_status";
                $this->res['response']['message'] = 'Upload photo status';
                $this->res['response']['data'] = $aa;
               
            }else{
                
            }
            
        }else{
            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;
        }
        
        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    
    //Media list
     public function all_product_media_list(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $product_id = $arr['RequestData']['product_id'];
            $where_media = array('product_id'=>$product_id,'status'=>'0');
            if(!empty($arr['RequestData']['category_id'])){
                $where_media['category'] = $arr['RequestData']['category_id'];
            }
            $lists = DB::table('media_files')->where($where_media)->get();
             $list_data = array();
             $final_data = array();
            foreach($lists as $list)
            {
                $cats_name = DB::table('add_photo_list')->where(array('id'=>$list->category))->first();

                $list_data['id'] = $list->id;
                $list_data['user_id'] = $list->user_id;
                $list_data['product_id'] = $list->product_id;
                $list_data['title'] = $list->title;
                $list_data['description'] = $list->description;
                $list_data['media_type'] = $list->media_type;
                $list_data['category'] = $list->category;
                $list_data['category_name'] = $cats_name->name;
                
               $list_data['file'] =  $this->base_url.'/public/images/'.$list->user_id.'/'.$list->product_id.'/'.$list->file;
               $list_data['privacy'] = $list->privacy;
               $list_data['hash_code'] = $list->hash_code;
               $list_data['app_timestamp'] = $list->app_timestamp;
               $list_data['gps'] = $list->gps;
               $list_data['created_at'] = $list->created_at;
               $list_data['updated_at'] = $list->updated_at;
               
               $final_data[] = $list_data;
            }
         
                $this->res['successBool']  = true;
                $this->res['successCode']  = "200";
                $this->res['responseType'] = "all_media_list";
                $this->res['response']['message'] = 'Media List';
                
                $this->res['response']['data'] = $final_data;
           
            
        }else{
            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;
        }
        
        $this->ApiCommonHelper->error_log('all_product_media_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    /*End */
    
    //remove Media list
     public function remove_media_from_list(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $media_id = $arr['RequestData']['media_id'];
            
           $data = array(
                'status' => 1,
               );
            $update = DB::table('media_files')->where('id',$media_id)->update($data);
            if($update)
            {
                 $this->res['successBool']  = true;
                $this->res['successCode']  = "200";
                $this->res['responseType'] = "remove_media_from_list";
                $this->res['response']['message'] = 'Successfully Removed Media  ';
                
            }else{
                $this->res['successBool'] = false;
                $this->res['ErrorObj']['ErrorCode'] = "105";
                $this->res['ErrorObj']['ErrorMsg'] = "Failed !! Please try Again";
                
            }
         
               
           
            
        }else{
            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;
        }
        
        $this->ApiCommonHelper->error_log('all_product_media_list', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }
    
    /*End*/
    
    
    
   /* public function photos_upload_status_testing(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $product_id = $arr['RequestData']['product_id'];
            $check_required_status = Media::where('product_id',$product_id)->get();
           $required = array(1,10,11,12);
           $uploaded = array();
            foreach($check_required_status as $status)
            {
                $uploaded[] = $status->category;
            }        
            
          $aa = array_values(array_intersect($required,$uploaded));
          sort($required);
          sort($aa);
          if($required==$aa)
          {  
             $pro = DB::table('products')->where('id',$product_id)->first();
             $string = $pro->upload_step_status;
             $step_status= explode(',', $string);
            // print_r($step_status);
              if(in_array(2, $step_status))
              {
                  echo "in array";
              }else{
                  $final_string = $string.",2";
                  DB::table('products')->where('id',$product_id)->update(array('upload_step_status'=>$final_string));
              }
          }else{
             echo "mot matched";
          }
                $this->res['successBool']  = true;
                $this->res['successCode']  = "200";
                $this->res['responseType'] = "upload_photo_status";
                $this->res['response']['message'] = 'Upload photo status';
                $this->res['response']['data'] = $aa;
               
          
        }else{
            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;
        }
        
        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
        
    }*/

        ######################## list Of Invoice Receipt #############################

        public function list_invoice(){

        $input = file_get_contents('php://input');
        $arr = json_decode($input,true);
        
        $apikey = $arr['RequestData']['apikey'];
        $v_code = $arr['RequestData']['v_code'];
        $userToken = $arr['RequestData']['userToken'];
        
        
        $access = $this->ApiCommonHelper->check_valid_version($v_code, $apikey);

        if($access == 1){
            $product_id =  $arr['RequestData']['product_id'];
            $user_id =  $arr['RequestData']['user_id'];

            $result = DB::table('product_invoice')
            ->select("product_invoice.*", "product_invoice.id as invoice_id","media_files.title", "media_files.description", "media_files.media_type", "media_files.category", "media_files.category", "media_files.file", "media_files.hash_code", "media_files.status")
            ->leftjoin('media_files', 'media_files.id', '=', 'product_invoice.media_id')
            ->where('product_invoice.user_id', $user_id)
            ->where('product_invoice.product_id', $product_id)
            ->get();

             if(!empty($result)){
                //$this->base_url.'/public/images/'.
                $re = [];
                foreach($result as $res){
                    if(empty($res->file)){
                        $res->file = $this->base_url.'/public/images/default_images/default_bike.png';
                    }else{
                    $res->file = $this->base_url.'/public/images/'.$res->user_id.'/'.$res->product_id.'/'.$res->file;
                    }
                    $re[] = $res;
                }

                  $this->res['successBool']  = true;
                    $this->res['successCode']  = "200";
                    $this->res['responseType'] = "invoice_list";
                    $this->res['response']['message'] = 'Invoice list';
                    $this->res['response']['data'] = $re;
                 
             }else{
                 $this->res['successBool'] = false;
                $this->res['ErrorObj']['successCode'] = "200";
                $this->res['responseType'] = "invoice_list";
                $this->res['response']['message'] = 'No data found';
                $this->res['response']['data'] = array();
                 
             }
        }else{

            $this->res['successBool'] = false;
            $this->res['ErrorObj']['ErrorCode'] = "105";
            $this->res['ErrorObj']['ErrorMsg'] = $access;

            } 

        $this->ApiCommonHelper->error_log('', $this->res);
        header('access-control-allow-credentials: true');
        header('content-type: application/json');
        return response()->json($this->res);
    }    

}
