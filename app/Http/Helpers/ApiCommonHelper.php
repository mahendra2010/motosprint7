<?php
namespace App\Http\Helpers;
use View;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Productmodel as Product;
use App\Models\Usermodel as User;
class ApiCommonHelper{
    public function check_valid_version($v_code, $key){
        $msg = 0;
        if($v_code !='' && $key != ''){
            
                // Get API Version 
                $get_api = DB::table('api_version')->get();

                foreach($get_api as $s_api){
                    $s_v_code = $s_api->v_code;
                    $s_apikey = $s_api->api_key;
                }
                // Match Version and code is matched
                if($s_v_code == $v_code){
                    // match Api key
                    if($s_apikey==$key){
                        $msg = 1;
                    }else{
                        $msg = 'Invalid APIkey..';
                    }
                }else{
                   $msg = 'Invalid Version Code..'; 
                }
            
        
        }else{
           $msg = 'Vesion Code or API key  is Required..';
        }
        return $msg;
    }
    public function check_valid_access($v_code, $key, $token){
        $msg = 0;
        if($v_code !='' && $key != '' && $token != ''){
            // get Token from Databsae.
            $token = User::where(array('token' => $token))->first();
            // if match Token
            if($token){
                // Get API Version 
                $get_api = DB::table('api_version')->get();

                foreach($get_api as $s_api){
                    $s_v_code = $s_api->v_code;
                    $s_apikey = $s_api->api_key;
                }
                // Match Version and code is matched
                if($s_v_code == $v_code){
                    // match Api key
                    if($s_apikey==$key){
                        $msg = 1;
                    }else{
                        $msg = 'Invalid APIkey..';
                    }
                }else{
                   $msg = 'Invalid Version Code..'; 
                }
            }else{
                $msg = 'Token mismatch..';
            }
        
        }else{
           $msg = 'Vesion Code, API key and Token is Required..';
        }
        return $msg;
    }
    public function error_log($request = null, $response){
        $result_response  = json_encode($response);
         $data = array( "serviceurl"=>'add_media',"request"=>$request,"response"=>$result_response,"created_at"=>date("Y-m-d H:i:s") );
         $insert = DB::table('error_log')->insert($data);
    }
    //to get brand_name  from id
    public static function get_brand_name($id){
        $brand = DB::table('motorcycle_brand')->where('id',$id)->first();
        if($brand)
        {
            return $brand->brand_name;
        }else{
            return '';
        }
    }
    //to get model name from id 
    public static function get_model_name($id){
        $model = DB::table('motorcycle_model')->where('id',$id)->first();
        if($model)
        {
            return $model->model_name;
        }else{
            return '';
        }
    }
	public static function has_permission($user_id, $permissions = ''){
		$permissions = explode('|', $permissions);
		$user_permissions = Permissions::whereIn('name', $permissions)->get();
		$permission_id = [];
		$i = 0;
		foreach ($user_permissions as $value) {
			$permission_id[$i++] = $value->id;
		}
		$role = RoleAdmin::where('admin_id', $user_id)->first();

		if(count($permission_id) && isset($role->role_id)){
			$has_permit = PermissionRole::where('role_id', $role->role_id)->whereIn('permission_id', $permission_id);
			return $has_permit->count();
		}
		else return 0;
	}
    function randomCode($length=20){
		$var_num = 3;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $num_set = '0123456789';
	    $low_ch_set = 'abcdefghijklmnopqrstuvwxyz';
	    $high_ch_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

	    $randomString = '';

	    $randomString .= $num_set[rand(0, strlen($num_set) - 1)];
	    $randomString .= $low_ch_set[rand(0, strlen($low_ch_set) - 1)];
	    $randomString .= $high_ch_set[rand(0, strlen($high_ch_set) - 1)];
	    
	    for ($i = 0; $i < $length-$var_num; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }

	    $randomString = str_shuffle($randomString);

	    return $randomString; 
	}
    public static function count_certificate($product_id){
        $count_certificate = DB::table('pre_certificate')->where('product_id',$product_id)->count();
        return $count_certificate;
    }
    public static function get_modified($product_id){

        $query= DB::table('media_files')
            ->leftjoin('add_photo_list', 'add_photo_list.id', '=', 'media_files.category')
            ->where('media_files.product_id',$product_id)
            ->count();
        if($query > 0){
            return 'Yes';
        }else{
            return 'No';
        }
    }
    public static function get_product_media($product_id, $cat_id){
        $query= DB::table('media_files AS m')
            ->where('m.product_id',$product_id)
            ->where('m.category', $cat_id)
            ->get();
        return $query;
    }
    public static function get_media_files($product_id, $cats = null, $orderBy = null){
        $q= DB::table('media_files')->select('*');
                if(!empty($cats)){
                    $q->whereIn('category', $cats);
                }
                $q->where('product_id', $product_id);
                if($orderBy !=''){
                    $q->orderBy($orderBy, 'DESC');
                }else{
                    $q->orderBy('id', 'DESC');
                }
                $query = $q->get();
        return $query;
    }
    public static function get_medias($userid, $cats = null, $orderBy = null){

        $q= DB::table('media_files')->select('*');
                if(!empty($cats)){
                    $q->whereIn('category', $cats);
                }
                $q->where('user_id', $userid);
                if($orderBy !=''){
                    $q->orderBy($orderBy, 'DESC');
                }
                $query = $q->get();

        return $query;
    }
    public static function get_medias_by_id($media_ids){

        $q= DB::table('media_files')->select('*');
                if(!empty($media_ids)){
                    $q->whereIn('id', $media_ids);
                }
                $query = $q->get();
        return $query;
    }

    public static function get_user_profile($user_id){

        $query= DB::table('users')
            ->where('id',$user_id)
            ->first();
        return $query;
    }
    public static function check_new($p, $s, $user_id){
        $query= DB::table('contact_seller')
            ->where('sender_id',$user_id)
            ->where('product_id',$p)
            ->count();
        return $query;
    }
    public static function check_media_permission($mid, $uid, $type){
        if((!empty($mid)) && (!empty($uid))){
            $get_media = DB::table('media_permission')
            ->where('media_id',$mid)
            ->where('user_id',$uid)
            ->where('type',$type)
            ->where('status',1)
            ->get();
            if($get_media->count() > 0){
                return 1;
            }else{
                return 0;
            }            
        }else{
            return 0;
        }
    }
	
    public static function check_doc_view($uid, $type= null){
      if(!empty($uid)){
            $m = DB::table('media_permission');
            if($type !=''){
                if($type = NULL || $type == ''){
                    $m->where('comment', '!=', '');    
                }
            }
            
            $m->where('status',0)->where('view',0);
            $m->where('seller_id',$uid);
            $count = $m->count();
            return $count;

            
        }
    }
	public static function get_product($id){
        $brand = DB::table('products')->where('id',$id)->first();
        return $brand;
    }

	
}