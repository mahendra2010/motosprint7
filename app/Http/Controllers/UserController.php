<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Mail\GeneralMail;
use App\Mail\AdminMail;
use App\Mail\Simple;
use Illuminate\Support\Facades\File;
use App\Models\Usermodel as User;
use App\Models\Search_motorcycle;
use App\Models\Productmodel as Product;
use App\Models\Search_motorcycle as SearchBikes;
use App\Http\Helpers\ApiCommonHelper as myhelper;
use App\Models\Mediamodel as Media;
use Auth;
use Hash;
class UserController extends Controller{
    private $base_url;
    public function __construct(){
        //blockio init
        $this->base_url = url('/');      
    }
    public function insert_reg_step1(Request $request){
       
    	$user_id    =   Auth::user()->id;
    	$user_email =   Auth::user()->email;
    	$name       =  $request->input('name');
    	$user_type  =   Auth::user()->user_type;

    	$img_name='';
        if ($request->hasFile('profile_pic')) {
            
            $img = $request->file('profile_pic');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path().'/images/'.$user_id;;
        
            $img->move($destinationPath, $img_name);
           
        }

    	$data=array(
    		'name' => $name,
    		'surname1' => $request->input('surname1'),
    		'surname2' => $request->input('surname2'),
    		'dni' => $request->input('dni'),
    		'dni_expiry_date' => str_replace(' ', '',$request->input('dni_expiry_date') ),
    		'date_of_birth' => str_replace(' ', '',$request->input('date_of_birth') ),
    		'alarm_expiry_dni' => $request->input('alarm_expiry_dni') .' ' .$request->input('alarm_expiry_dni_days'),
    		'motorcycle_licence_typology' => $request->input('motorcycle_licence_typology'),
    		'm_other_licence_typology' => $request->input('m_other_licence_typology'),
    		'alarm_expiry_licence' => $request->input('alarm_expiry_licence') .' '. $request->input('alarm_expiry_licence_days'),
    		'm_licence_no' => $request->input('m_licence_no'),
    		 'm_licence_expiry_date' => str_replace(' ', '',$request->input('m_licence_expiry_date') ),
    		 'nickname' => $request->input('nickname'),
    		'profile_pic' => $img_name,
            'country' => $request->input('country'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),
            'updated_at' => NOW()
    	);
    	//print_r($data);
    	
        $update = User::where('id', $user_id)->update($data);
    	if($update)
    	{
               $reciever_email = "user@motoblockchain.es";
                $user_data=array(
                        'sender_email' => $user_email,
                        'name' => $name,
                        'type' => '',
                        'email' => $user_email,
                        'subject' => 'Successfully Registered: step 1',
                        'message' => "<p> The user <b>".$request->input('name'). "  ".$request->input('surname1')."</b> has completed the registration Step 1 on Motoblockchain with nickname as <b>".$request->input('nickname')."</b>, on ".date("d-m-Y")." at ".date("H:i").", with the email
                           ".$user_email ,
                        'url' => $this->base_url.'/admin/users',
                    );
                    Mail::to($reciever_email)->send(new AdminMail($user_data));
                    

    		if($user_type=='1')
    		{
    		    
    			return redirect('/motor-cycle-registration'); 
    		}
    		elseif($user_type=='0')
    		{
    			return redirect('/');
    		}else{
    			return redirect('/registration-step-1')->with('info', 'failed... to manage use type');
    		}

    	}else{
    		return redirect('/registration-step-1')->with('info', 'failed... Please try again');
    	
    	
    	} 
    } 
    public function update_user_profile(Request $request){
       
    	$user_id=Auth::user()->id;
    	$user_type=Auth::user()->user_type;

    	$img_name='';
        if ($request->hasFile('profile_pic')) {
            
            $img = $request->file('profile_pic');
            $img_name = time().'.'.$img->getClientOriginalExtension();
            $destinationPath = public_path().'/images/'.$user_id;;
        
            $img->move($destinationPath, $img_name);
           
        }

    	$data=array(
    		/*'name' => $request->input('name'),
    		'surname1' => $request->input('surname1'),
    		'surname2' => $request->input('surname2'),
    		'dni' => $request->input('dni'),*/
    		'dni_expiry_date' => str_replace(' ', '',$request->input('dni_expiry_date') ),
    		/*'date_of_birth' => str_replace(' ', '',$request->input('date_of_birth') ),
    		'alarm_expiry_dni' => $request->input('alarm_expiry_dni') .' ' .$request->input('alarm_expiry_dni_days'),
    		'motorcycle_licence_typology' => $request->input('motorcycle_licence_typology'),
    		'm_other_licence_typology' => $request->input('m_other_licence_typology'),
    		'alarm_expiry_licence' => $request->input('alarm_expiry_licence') .' '. $request->input('alarm_expiry_licence_days'),
    		'm_licence_no' => $request->input('m_licence_no'),*/
    		 'm_licence_expiry_date' => str_replace(' ', '',$request->input('m_licence_expiry_date') ),
    		/*'nickname' => $request->input('nickname'),
    		'profile_pic' => $img_name,
            'country' => $request->input('country'),
            'region' => $request->input('region'),
            'city' => $request->input('city'),*/
            'updated_at' => NOW()
    	);
    	//print_r($data);
    	
        $update = User::where('id', $user_id)->update($data);
    	if($update){
           return redirect('/my-profile')->with('info', 'Profile Successfully Updated');
    	}else{
    		return redirect('/my-profile')->with('info', 'failed... Please try again');
    	} 
    }
    public function step_1_reg_insert(Request $request){
      
      $bike_name    =  $request->input('bike_name');
      $category_id  =  $request->input('category_id');
      $brand_id     =  $request->input('brand_id');
      $model_id     =  $request->input('model_id');
      
      if(!empty($request->input('circuit_dedicated') )){
          $circuit_dedicated = 'yes';
      }else{
          $circuit_dedicated = 'no';
      }
      
         $bike_imgs='';
        if ($request->hasFile('bike_imgs')) {
            $b_img = $request->file('bike_imgs');
            $bike_imgs = time().'b.'.$b_img->getClientOriginalExtension();
            /*$destinationPath_m = public_path('/images/products');
            $b_img->move($destinationPath_m, $bike_imgs);*/
           
        }
         
         $current_cv_image='';
            if ($request->hasFile('current_cv_image')) {
                $c_img = $request->file('current_cv_image');
                $current_cv_image = time().'ccm.'.$c_img->getClientOriginalExtension();
                /*$destinationPath = public_path('/images/cv_images');
                $c_img->move($destinationPath, $current_cv_image);*/
               
            }
            
           $owner_name = $request->input('owner_name');
           $first_reg_date = $request->input('first_reg_date');
           $first_reg_date=str_replace(' ', '', $first_reg_date);
         
         $user_id=Auth::user()->id;
         $data = array(
            'user_id'            =>     $user_id,
            'bike_name'          =>     $bike_name,
            'category_id'        =>     $category_id,
            'circuit_dedicated'  =>     $circuit_dedicated,
            'brand_id'          =>      $brand_id,
            'model_id'          =>      $model_id,
            'year'              =>      $request->input('year'),
            'bike_cc'           =>      $request->input('bike_cc'),
            'cv_original'       =>      $request->input('cv_original'),
            'other_cv_original' =>      $request->input('other_cv_original'),
            'current_cv'         =>     $request->input('current_cv'),
            'current_cv_image'  =>      $current_cv_image,
            'frame_no'          =>      $request->input('frame_no'),
            'frame_no_2'         =>     $request->input('frame_no_2'),
            'plate_no'          =>      $request->input('plate_no'),
            'country'           =>      $request->input('country'),
            'state'             =>      $request->input('region'),
            'city'              =>      $request->input('city'),
            'new_or_used'       =>       $request->input('new_or_used'),
            'bike_imgs'         =>      $bike_imgs,
            'currency_code'      =>     $request->input('currency_code'),
            'selling_price'     =>      $request->input('selling_price'),
            'c_mileage_type'     =>     $request->input('c_mileage_type'),
            'c_mileage'          =>     $request->input('c_mileage'),
            'add_alarm_mileage'  =>      $request->input('set_alarm_mileage'),
            'add_alarm_assurance' =>    str_replace(' ', '',  $request->input('add_alarm_assurance') ),
            'add_alarm_chain_lube' =>   $request->input('set_alarm_chain_lube'),
            'status'              =>      1,
            'upload_step_status'  =>     1,
            'created_at'          =>     NOW(),
            'updated_at'          =>     NOW()

         );

         $result_id = DB::table('products')->insertGetId($data);
         if($result_id){
             $product_id = $result_id;
             //to create individual user directory for bike media files
                $path = public_path().'/images/'.$user_id.'/'.$product_id;
                if(!File::isDirectory($path))
                {
                    File::makeDirectory($path, 0777, true, true);
                }
                 $destinationPath = public_path().'/images/'.$user_id.'/'.$product_id;
                if ($request->hasFile('bike_imgs')) {
                    $b_img->move($destinationPath, $bike_imgs);
                }
                if ($request->hasFile('current_cv_image')) {
                    $c_img->move($destinationPath, $current_cv_image);
                }
                
                
            if($owner_name)
            {
                foreach($owner_name as $key => $n) {
                    DB::table('previous_owners_details')->insert(
                        array(
                            'product_id' => $result_id,
                            'owner_name' => $owner_name[$key],
                            'registration_date' => $first_reg_date[$key],
                            'created_at' => NOW(),
                            'updated_at' => NOW()
                        )
                    );
                } 
            }
            
            
            $user = DB::table('users')->where('id', $user_id)->first();
            $name = $user->name;
            $email = $user->email;
            $user_data=array(
                    'sender_email' => 'admin@motoblockchain.es',
                    'name'          => $name,
                    'email'         => $email,
                    'type'          => 'bike_reg',
                    'subject'        => 'Motorcycle Registration in Motoblockchain',
                    'message'       => "<p> You have successfully uploaded the information of your Motorcycle ". $bike_name ." (". $this->brand_name($brand_id) ." , ".
                                        $this->model_name($model_id) .") \n\n\n</p><p>  Please complete the upload documentation
                                        process by using the app. You are only one step to create your first
                                        Blockchain Certificate and the Digital Identity of your ". $bike_name."</p>",
                    'url' => '',
                );
            Mail::to($email)->send(new GeneralMail($user_data));
            return redirect('/owner_registration_status')->with('info','success');
         }else{
                return back()->with('fail_info',' Failed to insert data');
         }
    }
    public function owner_reg_status(){
        return view('owner-verification-status');
    }
    public function motor_cycle_registration(){
    
        $brands = DB::table("motorcycle_brand")->pluck("brand_name","id");
        $country = DB::table("country")->pluck("country_name","id");
        $category = DB::table("motor_cycle_category")->pluck("category_name","id");
        $cc = DB::table("motor_cycle_cc")->pluck("cc_name","id");
        $cv_original = DB::table("motor_cycle_cv_original")->pluck("cv_original_name","id");
        return view('motor-cycle-registration',compact('brands','country','category','cc','cv_original'));
    } 
    public function registration_step_1(){
        $user_id=Auth::user()->id;
        $user=DB::table("users")->select('name','user_type')->where('id',$user_id)->first();
        if($user)
        {
            if(empty($user->dni)){
                 $country = DB::table("country")->pluck("country_name","id");
                return view('registration-step-1',compact('country'));
             }else{
                 return redirect('/');
             }
            
        }else{
            echo "user with this id not found";
        }        
    }
    public function getModelList(Request $request){
        $models = DB::table("motorcycle_model")
            ->where("brand_id",$request->brand_id)
            ->pluck("model_name","id");
            return response()->json($models);
    }
    public function getStateList(Request $request){
        $states = DB::table("state")
            ->where("country_id",$request->country_id)
            ->pluck("state_name","id");
            return response()->json($states);
    }
    //get user country name
    public static function user_country($id){
        $country = DB::table('country')
                        ->select('*')->where('id',$id)->first();
        if($country){
            return $country->country_name;
        }else{
            return '';
        }       
    }
    //get user state name
    public static function user_state($id){
        $state = DB::table('state')
                        ->select('*')->where('id',$id)->first();
        if($state){
            return $state->state_name;
        }else{
            return '';
        }
    }
    //get brand name
    public static function brand_name($id){
        $brand = DB::table('motorcycle_brand')
                        ->select('*')->where('id',$id)->first();
        if($brand){
            return $brand->brand_name;
        }else{
            return '';
        }
    }
    //get model name
    public static function model_name($id){
        $model = DB::table('motorcycle_model')
                        ->select('*')->where('id',$id)->first();
        if($model){
            return $model->model_name;
        }else{
            return '';
        }
    }
    public function logout(){
        Session::flush();
        return redirect('/')->with('info','Sucessfully  Logged Out');
    }
    /*My Profile Details*/
    public function my_profile(){

        $user_id = Auth::user()->id;
       $data= Product::where('user_id',$user_id)->with('brand','model','category','cc_data','cv_original_data','user_data')->orderBy('id', 'desc')->get();
        $user_detail= User::where('id',$user_id)->with('country_data','state_data')->first();
        //print_r($user_detail);
        $display ='';
        $count_bikes = count($data);
        if($count_bikes==1)
        {
            $display = "1";
        }else{
            $display = "0";
        }

        $reqs_medias = DB::table('media_permission as mp')
            ->leftjoin('products as p', 'p.id', '=', 'mp.product_id')
            ->leftjoin('media_files as mf', 'mf.id', '=', 'mp.media_id')
            ->leftjoin('users as u', 'u.id', '=', 'mp.seller_id')
            ->select('p.id', 'mp.user_id', 'mp.media_id','mp.status', 'p.bike_name', 'mf.id as doc_id', 'mf.file', 'mf.title', 'mf.description','mp.id as req_id', 'mf.privacy', 'mp.type', 'mp.comment', 'mp.view', 'mp.privacy', 'mp.answer')
            ->where(array('mf.user_id'=>$user_id))
            ->orderBy('mp.view', 'ASC')
            ->get();

        $search_bikes = DB::table('search_motorcycles')
            ->where(array('search_motorcycles.user_id'=>$user_id, 'search_motorcycles.status'=>'1'))
            ->leftjoin('products', 'products.id', '=', 'search_motorcycles.product_id')
            ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->select('*', 'search_motorcycles.id as search_bike_id' )
            ->get();
        $brands = DB::table("motorcycle_brand")->pluck("brand_name","id");
        $country = DB::table("country")->pluck("country_name","id");
        $category = DB::table("motor_cycle_category")->pluck("category_name","id");
        $cc = DB::table("motor_cycle_cc")->pluck("cc_name","id");
        $cv_original = DB::table("motor_cycle_cv_original")->pluck("cv_original_name","id");
        $contact_seller = DB::table("contact_seller")->distinct()
                            ->select('*', 'products.id as pro_id', 'users.id as userid','contact_seller.id as cid','contact_seller.created_at as create_date')
                            ->where('receiver_id',$user_id)
                            ->leftjoin('products','products.id','=','contact_seller.product_id')
                            ->leftjoin('users','users.id','=','contact_seller.sender_id')
                            ->get();
        $notify_products = Search_motorcycle::where(array('user_id'=>$user_id, 'status'=>'2'))
                            ->with('search_bike_data')
                            ->get();
        $final_data = array('user_listing' =>$data,'user_detail'=>$user_detail , 'display' => $display,'search_bikes' => $search_bikes,'contact_seller'=>$contact_seller,'notify_products'=>$notify_products);
        $country = DB::table("country")->pluck("country_name","id");

        return view('my-profile',compact('brands','country','category','cc','cv_original','reqs_medias'))->with($final_data); 
    }

    public static function document_model($dc, $doc_id, $title,$desc, $img, $privacy, $category= null, $user_id = null, $product_id = null){

        $pic = DB::table('product_invoice')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('media_id', $doc_id)
            ->first();

        $rm_ids = (!empty($pic->related_id))? $pic->related_id : 0;
        $rm_imgs = '';
        if($rm_ids != 0){
            $rm = DB::table('media_files');
            if(strpos($rm_ids,',')){
                $re_ids = explode(',', $rm_ids);
                $rm->whereIn('id', $re_ids);
            }else{
               $rm->where('id', $rm_ids);
            }
            $rmds = $rm->get();
            foreach($rmds as $rmd){
                $rm_imgs .='<a style="flex: 0 0 120px;" data-magnify="gallery" href="'.url('/').'/public/images/'.$rmd->user_id.'/'.$rmd->product_id.'/'.$rmd->file.'"><img class="img-responsive img-thumbnail img-fluid" src="'.url('/').'/public/images/'.$rmd->user_id.'/'.$rmd->product_id.'/'.$rmd->file.'" alt="'.$rmd->title.'"></a>';
            }

        }

         $model = '<div id="document_'.$doc_id.'_'.$dc.'" class="modal fade">
                          <div class="modal-dialog modal-xl">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="position: absolute;">Edit Document</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">';
                                    $dc= $doc_id.'_'.$dc;
                                    $model .= '<div class="col-lg-7">';
                                    if($category == 1 || $category == 2){
                                        $model .= '<button type="button" class="btn btn-info pull-right mb-1" data-toggle="modal" data-target="#related_invoice">Choose related documents</button><div class="clearfix"></div>
                                        <div id="related_invoice_date" style="flex-direction: row;display: flex;flex-wrap: wrap;">'.$rm_imgs.'</div>';
                                    }
                                    $model .= '<div class="clearfix"></div><a data-magnify="gallery" href="'.$img.'" style="text-align:center;"><img class="img-fluid" style="max-height:250px;" src="'.$img.'" /></a>';
                                    $model .= '</div>';
                                    $model .= '<div class="col-lg-5">';
                                    $model .= '<div class="col-lg-12" id="msg_'.$dc.'"></div>';
                                    $model .= ' <div class="form-group">
                                            <div class="col-sm-12">
                                                <input id="doc_title_'.$dc.'" type="text" class="form-control" placeholder="Document Title" value="'.$title .'">
                                            </div>
                                        </div>';

                                        $model .= '<div class="form-group">  
                                            <div class="col-sm-12">
                                                <textarea id="doc_desc_'.$dc.'" class="form-control" placeholder="Document Title">'.$desc.'</textarea> 
                                            </div>
                                        </div>';
                                        if($category == 1 || $category == 2){
                                            $c_code = (!empty($pic->currency_code))? $pic->currency_code : '';
                                            $spent_invoice = (!empty($pic->t_m_spent_invoice))? $pic->t_m_spent_invoice: '';
                                            $spent_accessories = (!empty($pic->t_m_spent_accessories))? $pic->t_m_spent_accessories: '';
                                            $t_m_spent_components = (!empty($pic->t_m_spent_components))? $pic->t_m_spent_components: '';
                                            $t_m_spent_replacement = (!empty($pic->t_m_spent_replacement))? $pic->t_m_spent_replacement: '';

                                            $pi1 = ($c_code == 'USD')? 'selected' : "";
                                            $pi2 = ($c_code == 'EUR')? 'selected' : "";
                                            $pi3 = ($c_code == 'INR')? 'selected' : "";

                                            $model .= '<div class="form-group row spend_group">  
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        <div class="col-sm-8">
                                                            <label>Select Currency for Spend Money</label>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <select class="custom-select" id="currency_invoice_'.$dc.'">
                                                                <option value="">Select</option>
                                                                <option value="USD" '.$pi1.'>USD</option>
                                                                <option value="EUR" '.$pi2.'>EUR</option>
                                                                <option value="INR" '.$pi3.'>INR</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="width:100%" />
                                            <div class="col-sm-6">
                                            <div class="row">
                                                <label>Total Money spent (in the invoice)</label>
                                                <div class="col-sm-8 px-0">
                                                    <input id="spend_invoice_'.$dc.'" type="number" class="form-control" placeholder="Total Money spent (in the invoice)" value="'. $spent_invoice.'">
                                                </div>
                                                </div>
                                                </div>

                                           
                                                <div class="col-sm-6">
                                                <div class="row">
                                                <label>Money spent in accessories (only)</label>
                                                <div class="col-sm-8 px-0">
                                                    <input id="spend_acces_'.$dc.'" type="text" class="form-control" placeholder="Money spent in accessories (only)" value="'.$spent_accessories .'">
                                                </div>
                                                </div>
                                                </div>
                                           <hr style="width:100%" />
                                                <div class="col-sm-6">
                                                <div class="row">
                                                <label>Money spent in tuning (only)</label>
                                                    <div class="col-sm-8 px-0">
                                                    <input id="spend_tuning_'.$dc.'" type="text" class="form-control" placeholder="Money spent in tuning (only)" value="'.$t_m_spent_components .'">
                                                </div>
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                             <div class="row">
                                            <label>Money spent in replacement (only)</label> 
                                                 <div class="col-sm-8 px-0">
                                                <input id="spend_replace_'.$dc.'" type="text" class="form-control" placeholder="spent in replacement" value="'.$t_m_spent_replacement .'">
                                                </div>
                                            </div>
                                            </div>
                                            <hr style="width:100%" />
                                            </div>

                                            ';
                                        }

                                        $model .= '<div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="inputAddress2">Document Privacy</label>
                                                <select id="doc_privacy_'.$dc.'" class="form-control" style="width: 50%;">
                                                    <option>Select</option>';

                                                    $p1 = ($privacy == 0)? 'selected' : "";
                                                    $p2 = ($privacy == 1)? 'selected' : "";
                                                    $p3 = ($privacy == 2)? 'selected' : "";

                                                    $model .= '<option value="0" '.$p1.'>public document</option>';
                                                    $model .= '<option value="1" '.$p2.'>public title Only</option>';
                                                    $model .= '<option value="2" '.$p3.'>private document</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>';
                              $model .= '<div class="modal-footer">
                                <input type="hidden" id="doc_id_'.$dc.'" value="'.$doc_id.'" />
                                <button type="button" class="btn btn-success edit_doc" id="'.$dc.'">Save</button>
                                <input type="hidden" id="model_category_'.$dc.'" name="model_category_'.$dc.'" value="'.$category.'" />
                                <input type="hidden" id="model_userid_'.$dc.'" name="model_userid_'.$dc.'" value="'.$user_id.'" />
                                <input type="hidden" id="model_productid_'.$dc.'" name="model_productid_'.$dc.'" value="'.$product_id.'" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                
                              </div>
                            </div>
                          </div>
                        </div>';
                        return $model;
    }
    public static function document_model_view($dc, $doc_id, $title,$desc, $img, $privacy, $category= null, $user_id = null, $product_id = null){

        $pic = DB::table('product_invoice')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('media_id', $doc_id)
            ->first();

        $rm_ids = (!empty($pic->related_id))? $pic->related_id : 0;
        $rm_imgs = '';
        if($rm_ids != 0){
            $rm = DB::table('media_files');
            if(strpos($rm_ids,',')){
                $re_ids = explode(',', $rm_ids);
                $rm->whereIn('id', $re_ids);
            }else{
               $rm->where('id', $rm_ids);
            }
            $rmds = $rm->get();
            foreach($rmds as $rmd){
                $rm_imgs .='<a style="flex: 0 0 120px;" data-magnify="gallery" href="'.url('/').'/public/images/'.$rmd->user_id.'/'.$rmd->product_id.'/'.$rmd->file.'"><img class="img-responsive img-thumbnail img-fluid" src="'.url('/').'/public/images/'.$rmd->user_id.'/'.$rmd->product_id.'/'.$rmd->file.'" alt="'.$rmd->title.'"></a>';
            }

        }

         $model = '<div id="document_view_'.$doc_id.'_'.$dc.'" class="modal fade">
                          <div class="modal-dialog modal-xl">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="position: absolute;">View Document</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">';
                                    $dc= $doc_id.'_'.$dc;
                                    $model .= '<div class="col-lg-7">';
                                    if($category == 1 || $category == 2){
                                        $model .= '<div id="related_invoice_date" style="flex-direction: row;display: flex;flex-wrap: wrap;">'.$rm_imgs.'</div>';
                                    }
                                    $model .= '<div class="clearfix"></div><a data-magnify="gallery" href="'.$img.'" style="text-align:center;"><img class="img-fluid" style="max-height:250px;" src="'.$img.'" /></a>';
                                    $model .= '</div>';
                                    $model .= '<div class="col-lg-5">';
                                    $model .= '<div class="col-lg-12" id="msg_'.$dc.'"></div>';
                                    $model .= ' <div class="form-group">
                                                <label>Document Title</label>
                                                <input id="doc_title_'.$dc.'" type="text" readonly class="form-control-plaintext" placeholder="Document Title" value="'.$title .'">
                                        </div>';

                                        $model .= '<div class="form-group">  
                                                <label>Document description</label>
                                                <textarea id="doc_desc_'.$dc.'" readonly class="form-control-plaintext" placeholder="Document description">'.$desc.'</textarea> 
                                        </div>';
                                        if($category == 1 || $category == 2){
                                            $c_code = (!empty($pic->currency_code))? $pic->currency_code : '';
                                            $spent_invoice = (!empty($pic->t_m_spent_invoice))? $pic->t_m_spent_invoice: '0';
                                            $spent_accessories = (!empty($pic->t_m_spent_accessories))? $pic->t_m_spent_accessories: '0';
                                            $t_m_spent_components = (!empty($pic->t_m_spent_components))? $pic->t_m_spent_components: '0';
                                            $t_m_spent_replacement = (!empty($pic->t_m_spent_replacement))? $pic->t_m_spent_replacement: '0';

                                            $model .= '<div class="form-group row spend_group">  
                                                
                                                <hr style="width:100%" />
                                            <div class="col-sm-6">
                                            <div class="row">
                                                <label>Total Money spent (in the invoice)</label>
                                                <div class="col-sm-8 px-0">
                                                    <input id="spend_invoice_'.$dc.'" type="number" readonly class="form-control-plaintext" placeholder="Total Money spent (in the invoice)" value="'.$c_code.''. $spent_invoice.'">
                                                </div>
                                                </div>
                                                </div>
                                           
                                                <div class="col-sm-6">
                                                <div class="row">
                                                <label>Money spent in accessories (only)</label>
                                                <div class="col-sm-8 px-0">
                                                    <input id="spend_acces_'.$dc.'" type="text" readonly class="form-control-plaintext" placeholder="Money spent in accessories (only)" value="'.$c_code.''.$spent_accessories .'">
                                                </div>
                                                </div>
                                                </div>
                                           <hr style="width:100%" />
                                                <div class="col-sm-6">
                                                <div class="row">
                                                <label>Money spent in tuning (only)</label>
                                                    <div class="col-sm-8 px-0">
                                                    <input id="spend_tuning_'.$dc.'" type="text"  readonly class="form-control-plaintext" placeholder="Money spent in tuning (only)" value="'.$c_code.''.$t_m_spent_components .'">
                                                </div>
                                                </div>
                                            </div>
                                             <div class="col-sm-6">
                                             <div class="row">
                                            <label>Money spent in replacement (only)</label> 
                                                 <div class="col-sm-8 px-0">
                                                <input id="spend_replace_'.$dc.'" type="text"  readonly class="form-control-plaintext" placeholder="spent in replacement" value="'.$c_code.''.$t_m_spent_replacement .'">
                                                </div>
                                            </div>
                                            </div>
                                            <hr style="width:100%" />
                                            </div>

                                            ';
                                        }

                                        $model .= '<div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="inputAddress2">Document Privacy </label>';
                                                

                                                    $p1 = ($privacy == 0)? 'public document' : "";
                                                    $p2 = ($privacy == 1)? 'public title Only' : "";
                                                    $p3 = ($privacy == 2)? 'private document' : "";

                                                    $model .= ' <input type="text" readonly class="form-control-plaintext" value="'.$p1.''.$p2.''.$p3.'" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              </div>';
                              $model .= '<div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>';
                        return $model;
    }
    public static function document_tab($user_id, $cats= null, $orderby= null){

      $tabs = '<div class="row">';
      $all_docs = myhelper::get_medias($user_id, $cats, $orderby);
      $dc = count($all_docs);  

      if($dc > 0){

        $i = 1;

        foreach($all_docs as $doc){

            $tabs .='<div class="col-lg-3 col-6 padding-5 magnify">';
            $tabs .='<button class="btn btn-sm btn-success" style="margin:0px;position: absolute;background: #fa6a2f;border: 0;border-radius: 0;" data-toggle="modal" data-target="#document_'.$doc->id.'_'.$i.'"><i class="fa fa-pencil" aria-hidden="true"></i></button>';
            $tabs .='<button class="btn btn-sm btn-success" style="margin:0px;position: absolute;background: #fa6a2f;border: 0;border-radius: 0;right: 16px;" data-toggle="modal" data-target="#document_view_'.$doc->id.'_'.$i.'"><i class="fa fa-eye" aria-hidden="true"></i></button>';
            $bike_img = 'images/'.$user_id.'/'.$doc->product_id.'/'.$doc->file;
            $title = (!empty($doc->title)) ? $doc->title : '';
            $description = (!empty($doc->description)) ? $doc->description : '';
            $privacy = (!empty($doc->privacy)) ? $doc->privacy : '';

            if(file_exists(public_path($bike_img))) {
                $bike_img = url('/').'/public/images/'.$user_id.'/'.$doc->product_id.'/'.$doc->file;
            }else{
                $bike_img = url('/').'/public/images/default_images/default_bike.png';
            }
            
            $tabs .='<a id="mid_'.$doc->id.'" data-magnify="gallery" href="'.$bike_img.'">
            <img class="img-responsive img-thumbnail img-fluid" src="'.$bike_img.'" alt="">
            </a>';
            $tabs .='<time class="small" datetime="'.$doc->created_at.'"><strong>Date :</strong> '. date("d M Y h:i A", strtotime($doc->created_at)) .'</time>';
            $tabs .='<div class="doc_title">'.$title.'</div>';
            $tabs .='</div>';
            $tabs .= self::document_model($i, $doc->id, $title, $description, $bike_img, $privacy, $doc->category, $user_id, $doc->product_id);
            $tabs .= self::document_model_view($i, $doc->id, $title, $description, $bike_img, $privacy, $doc->category, $user_id, $doc->product_id);

        $i++;

        }
      }else{
        $tabs .='<div class="alert alert-warning alert-dismissible fade show" role="alert">There is no data to display</div>';
      }
        $tabs .='</div>';
        return $tabs;
    }
    public static function document_list_checkbox($user_id, $cats= null, $orderby= null){

      $tabs = '<div class="row">';
      $all_docs = myhelper::get_medias($user_id, $cats, $orderby);
      $dc = count($all_docs);  

      if($dc > 0){

        $i = 1;

        foreach($all_docs as $doc){

            $tabs .='<div class="col-lg-3 col-6 padding-5 magnify">';
            $tabs .='<label class="checkcontainer"><input type="checkbox" name="related" class="related_check" value="'.$doc->id.'"><span class="checkmark"></span></label>';
            $bike_img = 'images/'.$user_id.'/'.$doc->product_id.'/'.$doc->file;

            $title = (!empty($doc->title)) ? $doc->title : '';
            $description = (!empty($doc->description)) ? $doc->description : '';
            $privacy = (!empty($doc->privacy)) ? $doc->privacy : '';

            if(file_exists(public_path($bike_img))){
                $bike_img = url('/').'/public/images/'.$user_id.'/'.$doc->product_id.'/'.$doc->file;
            }else{
                $bike_img = url('/').'/public/images/default_images/default_bike.png';
            }
            
            $tabs .='<a id="mid_'.$doc->id.'" data-magnify="gallery" href="'.$bike_img.'">
            <img class="img-responsive img-thumbnail img-fluid" src="'.$bike_img.'" alt="">
            </a>';
            $tabs .='<time class="small" datetime="'.$doc->created_at.'"><strong>Date :</strong> '. date("d M Y h:i A", strtotime($doc->created_at)) .'</time>';
            $tabs .='<div class="doc_title">'.$title.'</div>';
            $tabs .='</div>';

        $i++;

        }
      }else{
        $tabs .='<div class="alert alert-warning alert-dismissible fade show" role="alert">There is no data to display</div>';
      }
        $tabs .='</div>';
        return $tabs;
    }
    
    //Contact user chat pupoup
    public function get_contact_users_chat(Request $request) {
     
     $id = $request->input('id'); 
      $sender_id = $request->input('sender_id'); 
      $product_id = $request->input('product_id'); 
      $receiver_id = Auth::user()->id;
      $base_url = url("/");
     
        // $ab =" SELECT * FROM `contact_seller` WHERE (`sender_id`='$sid' AND `reciver_id`='$rid') OR (`sender_id`='$rid' AND `reciver_id`='$sid') ";
        $pro_detail = Product::where('id',$product_id)->first();
       $contact_sellers = DB::table('contact_seller')
                          ->where(function($q) use ($sender_id,$receiver_id,$product_id) {
                              $q->where('contact_seller.sender_id', $sender_id)
                                ->where('contact_seller.receiver_id', $receiver_id)
                                ->where('contact_seller.product_id', $product_id);
                          })
                          ->orwhere(function($q) use ($sender_id,$receiver_id,$product_id) {
                              $q->where('contact_seller.sender_id', $receiver_id )
                                ->where('contact_seller.receiver_id', $sender_id)
                                ->where('contact_seller.product_id', $product_id);
                          })
                          ->leftjoin('users','users.id','=','contact_seller.sender_id')
                          ->get();
                            
                   
        /*echo "<pre>";
        print_r($contact_sellers);*/ 
       if(count($contact_sellers)>0){
           echo '<div class="modal-content">
                  <div class="modal-header" style="padding: 0rem 1rem; background:#bcbcbc">
                    <h4 class="modal-title"> '.$pro_detail->bike_name.' , '.$pro_detail->brand->brand_name.' </h4>
                  </div>
                  <div class="modal-body" id="chat_content" style="height:430px; overflow-y: scroll;">';
          
            echo '<div class="comments-area">
                      <ul class="comment-list">';
                      foreach($contact_sellers as $contact_seller){
                         echo'<li>';
                         if($contact_seller->sender_id != $receiver_id){
                              echo '<div class="thumb-list">';
                              if(!empty($contact_seller->profile_pic)){
                                      echo '<figure><img alt="" src="'.$base_url.'/public/images/'.$contact_seller->receiver_id.'/'.$contact_seller->profile_pic.'"></figure>';
                                  }else{
                                      echo '<figure><img alt="" src="'.$base_url.'/public/images/default_images/default_bike.png"></figure>';
                                  }
                                  echo'<div class="text-holder">
                                      <!--<a class="comment-reply-link automobile-color" href="#">Reply</a>-->
                                      <h6>'.$contact_seller->name.' </h6>
                                      <time class="post-date automobile-color" datetime="2008-02-14 20:00">18 / 05 / 2016</time><br/>
                                      <p>'.$contact_seller->message.'</p>
                                      
                                   </div>
                                </div>';
                                
                         }else{
                             echo '<ul class="children">
                               <li>
                                  <div class="thumb-list">';
                                  if(!empty($contact_seller->profile_pic)){
                                      echo '<figure><img alt="" src="'.$base_url.'/public/images/'.$receiver_id.'/'.$contact_seller->profile_pic.'"></figure>';
                                  }else{
                                      echo '<figure><img alt="" src="'.$base_url.'/public/images/default_images/default_bike.png"></figure>';
                                  }
                                     
                                     
                                 echo'<div class="text-holder">
                                        <h6>'.$contact_seller->name.'  </h6>
                                        <time class="post-date automobile-color" datetime="2008-02-14 20:00">19 / 05 / 2016</time><br/>
                                        <p>'.$contact_seller->message.'</p>
                                        
                                     </div>
                                  </div>
                               </li>
                               <!-- #comment-## -->
                            </ul>';
                         }
                         
                       
                            
                         echo '<!-- .children -->
                         </li>
                         <!-- #comment-## -->
                         ';
                      }
                      echo '</ul>
                      <div class="comment-respond" style="margin:0 !important">
                         <div class="automobile-section-heading"><h5 class="automobile-color">Leave a Reply</h5></div>
                         <form method="post" action="'.$base_url.'/reply_contact_users_chat" id="contact_users_chat_form">
                            '. csrf_field() .'
                             <input type="hidden" name="sender_id" class="form-control"  value="'. encrypt($receiver_id) .'" required>
                            <input type="hidden" name="receiver_id" class="form-control"  value="'. encrypt($sender_id) .'" required>
                            <input type="hidden" name="product_id" class="form-control"  value="'. encrypt($product_id) .'" required>
                            
                            <p class="automobile-full-form">
                               <textarea name="message"  placeholder="Your Reply" class="form-control "></textarea>
                            </p>
                            <p class="form-submit"><input class="automobile-bgcolor "  id="contact_users_chat_btn" type="submit" value="Submit"></p>
                         </form>
                      </div>
                    </div>';
            
            echo '</div>
              <div class="modal-footer" style="padding: 0rem 1rem; background:#bcbcbc">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
            ';
           
       }else{
          echo "No Reply ";
       }
    }
    //insert reply 
    public function reply_contact_users_chat(Request $request){
        //print_r($request->input());
        $sender_id = decrypt($request->input('sender_id'));
         $receiver_id = decrypt($request->input('receiver_id'));
         $product_id = decrypt($request->input('product_id'));
         $data = array(
             'product_id'    =>     $product_id,
             'sender_id'     =>     $sender_id,
             'receiver_id'   =>      $receiver_id,
             'message'       =>     $request->input('message'),
             'created_at'    =>     NOW(),
             'updated_at'    =>     NOW()
             );
        
         $insert = DB::table('contact_seller')->insert($data);
         if($insert)
         {
             return redirect('my-profile?tab=users_contact_u')->with('info_c', 'Successfully Sent');
         }else{
              return back()->with('fail_info_c', 'Failed !! Please try again');
         }
    }
    /*Remove Users listed bike*/
    public function remove_bike(){
        if(!empty($_GET['id'])){
            $id = decrypt($_GET['id']);
            
            DB::table('previous_owners_details')->where('product_id', $id)->delete();
            DB::table('product_mechanic_details')->where('product_id', $id)->delete();
            DB::table('media_files')->where('product_id', $id)->delete();
            DB::table('product_invoice')->where('product_id', $id)->delete();
            DB::table('products')->where('id', $id)->delete();
            
            return 1;
        }else{
            return 0;
        }
    }   
    public function delete_notify_product(Request $request){
        $id = $request->input('id');
        $delete = Search_motorcycle::where('id',$id)->delete();
        if($delete)
        {
            echo 1;
        }else{
            echo 2;
        }
    }
    /*Remove Users Searched bike*/
    public function remove_search_bike($id){
        if(!empty($id)){
           
            $delete = DB::table('search_motorcycles')->where('id', $id)->delete();
            if($delete)
            {
                return 1;
            }else{
                return 1;
            }
            
        }else{
            return 0;
        }
    }
    /*Cancel  Motorcycle data  bike*/
    public function cancel_motorcycle_data(Request $request){
                $user_id   =  decrypt($request->input('id'));
                $get_user     =  DB::table('users')->where('id',$user_id)->first();
                $getproducts     =  DB::table('products')->where('user_id',$user_id)->get();
                
                if(count($getproducts)>0){
                    foreach($getproducts as $getproduct){
                        
                         $product_id = $getproduct ->id;
                        DB::table('previous_owners_details')->where('product_id', $product_id)->delete();
                        DB::table('product_mechanic_details')->where('product_id', $product_id)->delete();
                        DB::table('media_files')->where('product_id', $product_id)->delete();
                        DB::table('product_invoice')->where('product_id', $product_id)->delete();
                         //To Remove The users directory
                         $path = public_path().'/images/'.$user_id.'/'.$product_id;
                         if(File::isDirectory($path))
                         {
                             File::deleteDirectory($path); 
                         }
                         
                         DB::table('products')->where('id', $product_id)->delete();
                    }
                    
                    $name = $get_user->name;
                    $email = $get_user->email;
                    
                    $user_data=array(
                        'sender_email' => 'info@motoblockchain.es',
                        'name'          => $name,
                        'email'         => $email,
                        'type'          => 'cancel_motorcycle_data',
                        'subject'        => 'Motorcycle Data are Cancelled in Motoblockchain',
                        'message'       => "<p> We receive your request to cancel your motorcycle  from our Database correctly. All documentation and motorcycle data are deleted from our database. </p><br/> <p>
                                            Please contact us at info@motoblockchain.es for more information about Digital Identity transmission.</p>",
                        'url' => '',
                    );
                    Mail::to($email)->send(new GeneralMail($user_data));
                    echo 1;
                    
                }else{
                    echo 2;
                }
    }
    /*End*/
    /*Cancel all user data(delete every thing related to user id)*/
    public function cancel_my_acount_data(Request $request){
         $user_id   =  decrypt($request->input('id'));
                $get_user     =  DB::table('users')->where('id',$user_id)->first();
                $getproducts     =  DB::table('products')->where('user_id',$user_id)->get();
                
                if(count($getproducts)>0){
                    foreach($getproducts as $getproduct){
                        
                         $product_id = $getproduct ->id;
                        DB::table('previous_owners_details')->where('product_id', $product_id)->delete();
                        DB::table('product_mechanic_details')->where('product_id', $product_id)->delete();
                        DB::table('media_files')->where('product_id', $product_id)->delete();
                        DB::table('product_invoice')->where('product_id', $product_id)->delete();
                        DB::table('pre_certificate')->where('product_id', $product_id)->delete();
                        DB::table('contact_seller')->where('product_id', $product_id)->delete();
                        
                         //To Remove The users directory
                         $path = public_path().'/images/'.$user_id.'/'.$product_id;
                         if(File::isDirectory($path)){
                             File::deleteDirectory($path); 
                         }
                         
                         DB::table('products')->where('id', $product_id)->delete();
                    } 
                    
                }
                
                $name = $get_user->name;
                    $email = $get_user->email;
                    
                    $user_data=array(
                        'sender_email' => 'info@motoblockchain.es',
                        'name'          => $name,
                        'email'         => $email,
                        'type'          => 'cancel_account_data',
                        'subject'        => 'You Cancelled Your Account from Motoblockchain',
                        'message'       => "<p> We receive your request to cancel your Motorcycle data and your data from our Database correctly. The full account including all motorcycle data is cancelled in.</p><p>
                                            Please contact us at info@motoblockchain.es for more information about Digital Identity
                                            transmission.</p>",
                        'url' => '',
                    );
                    Mail::to($email)->send(new GeneralMail($user_data));
                    
                   
               DB::table('media_permission')->where('user_id', $user_id)->orwhere('seller_id',$user_id)->delete();
               DB::table('search_motorcycles')->where('user_id', $user_id)->delete();
               
               $delete_user =  DB::table('users')->where('id', $user_id)->delete();
               if($delete_user){
                   echo 1;
               }else{
                   echo 2;
               }
    }
    /*End */
    public function change_user_password(Request $request){
        //print_r($request->input());
        $old_password=$request->input('old_password');
        $new_password =$request->input('current_password');
        $user_id=Auth::user()->id;
        $user = User::where('id', $user_id)
                        ->select('id', 'password')->first();
        
        if(Hash::check($old_password, $user->password)) {
            $data=array(
                    'password' => Hash::make($new_password),
                    's_pass' => $new_password,
                    'updated_at' => NOW()
                );
            $update=User::where('id', $user_id)->update($data);
            if($update){
                echo 1;
                //return redirect('/my-profile')->with('info','Password changed Successfully');
            }else{
                echo 2;
                //return back()->with('fail_info','Old Password Not mached');
            }
            
        }else{
            echo 2;
            //return back()->with('fail_info','Old Password Not mached');
        }
    }
    /*Ed*/
    /*Set Email subscription */
    public function set_email_subscription(Request $request){
        $email_subscription = $request->input('email_subscription');
        $user_id    =   Auth::user()->id;
        $data = array(
                'email_subscription' => $email_subscription,
                'updated_at' => NOW()
            );
        $update = DB::table('users')->where('id',$user_id)->update($data);
        if($update){
            echo 1;
            //return redirect ('my-profile')->with('info','Email Subscription Updated');;
        }else{
           // return back()->with('fail_info','Failed !! Please Try Again');
            echo 2;
        }
    }
    ######################## Add Related Invoice in to Model box #############################
    public function related_invoice(Request $request){
        $related_invoice = $request->input('related_invoice');
        if(!empty($related_invoice)){
            $related = array();
            foreach($related_invoice as $res){
               $related[] = $res['value'];
            } 

            $img ='';

            if(is_array($related)){

                $media_ids = implode(',', $related);
                $medias = myhelper::get_medias_by_id($related);
                
                foreach($medias as $media){
                    $img .= '<a style="flex: 0 0 120px;" data-magnify="gallery" href="'.$this->base_url.'/public/images/'.$media->user_id.'/'.$media->product_id.'/'.$media->file.'"><img class="img-responsive img-thumbnail img-fluid" src="'.$this->base_url.'/public/images/'.$media->user_id.'/'.$media->product_id.'/'.$media->file.'" alt="'.$media->title.'" /></a><input type="hidden" name="related_media" id="related_media" value="'.$media_ids.'">';
                }

            }
            echo $img;
        }
    }
    ##################### End Add Related Invoice in to Model box ############################
    public function reply_to_user(Request $request){

        if(!empty($request->input('answer'))){

            DB::table('media_permission')->where('id', $request->input('id'))->update(['answer' => strip_tags($request->input('answer'))]);

            $name       = $request->input('name');
            $email      = $request->input('email');
            $question   = $request->input('question');
            $answer     = $request->input('answer');
            $msg        = "Dear ".$name.",<p style='float:left;text-align:left; width:100%;'><strong> Your Comment : </strong>".$question."<br /><p style='float:left;text-align:left; width:100%;margin:0; padding:0;'><strong>Answer : </strong>".$answer."</p>";

            $user_data = array(
                        'sender_email'  => 'admin@motoblockchain.es',
                        'name'          => $name,
                        'email'         => $email,
                        'subject'       => 'Your Comment response',
                        'message'       => $msg,
                );

            Mail::to($email)->send(new Simple($user_data));

            echo 1;
        }
    }
    /* add_document */
    public function add_document(Request $request){
        
        $user_id        = $request->input('user_id');
        $product_id     = $request->input('add_doc_product');
        $title          = $request->input('add_doc_title');
        $description    = $request->input('add_doc_desc');
        $privacy        = $request->input('add_doc_privacy');
        $type           = $request->input('add_doc_image_category');

        if($user_id == '' || $product_id == '' || $title == '' || $description =='' || $type == ''){

            echo "Something Went Wrong.!";

        }else{

            $file = $request->file('add_doc_file');
            $destinationPath    = public_path().'/images/'.$user_id.'/'.$product_id;

            $ext                = $file->guessClientExtension();  
            $fullname           = $file->getClientOriginalName(); 
            $hash_code          = hash('sha256', $fullname . strval(time()));
            $hashname           = $hash_code.'.'.$ext;
            
            if($file->move($destinationPath, $hashname)){

                $models                = new Media;
                $models->user_id       = $user_id;
                $models->product_id    = $product_id;
                $models->category      = $type;
                $models->title         = $title;
                $models->description   = $description;
                $models->media_type    = $ext;
                $models->file          = $hashname;
                $models->privacy       = $privacy;
                $models->hash_code     = $hash_code;

                if($models->save()){
                    echo '<div class="alert alert-success alert-dismissible fade show c_alert" role="alert" style="display: block;margin-bottom: 1em;">Successfully Uploaded.!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                    
                }else{
                    echo '<div class="alert alert-danger alert-dismissible fade show c_alert" role="alert" style="display: block;margin-bottom: 1em;">Something Went Wrong.!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                }
            }else{
                echo '<div class="alert alert-danger alert-dismissible fade show c_alert" role="alert" style="display: block;margin-bottom: 1em;">Something Went Wrong.!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            }
        }

    }
    /* End add_document */
}
/*End Class*/