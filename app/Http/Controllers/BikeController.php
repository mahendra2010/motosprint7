<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productmodel as Product;
use App\Models\Mediamodel as Media;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\File;

use Auth;
use Hash;

class BikeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function add_motor_cycle(Request $request) {
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
            'user_id' => $user_id,
            'bike_name' => $request->input('bike_name'),
            'category_id' =>  $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'model_id' => $request->input('model_id'),
            'year' => $request->input('year'),
            'bike_cc' => $request->input('bike_cc'),
            'cv_original' => $request->input('cv_original'),
            'other_cv_original' => $request->input('other_cv_original'),
            'current_cv' => $request->input('current_cv'),
            'current_cv_image'  => $current_cv_image,
            'frame_no' => $request->input('frame_no'),
            'plate_no' => $request->input('plate_no'),
            'country' => $request->input('country'),
            'state' => $request->input('region'),
            'city' => $request->input('city'),
            'new_or_used' => $request->input('new_or_used'),
            'bike_imgs' =>  $bike_imgs,
            'currency_code' => $request->input('currency_code'),
            'selling_price' => $request->input('selling_price'),
            'c_mileage_type' => $request->input('c_mileage_type'),
            'c_mileage' => $request->input('c_mileage'),
            'add_alarm_mileage' => $request->input('set_alarm_mileage'),
            'add_alarm_assurance' =>str_replace(' ', '',  $request->input('add_alarm_assurance') ),
            'add_alarm_chain_lube' => $request->input('set_alarm_chain_lube'),
            'status' => 1,
            'created_at' => NOW(),
            'updated_at' => NOW()

         );

         $result_id = DB::table('products')->insertGetId($data);
         if($result_id)
         {
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
            
            return redirect('/owner_registration_status')->with('info','success');

         }else{
                return back()->with('fail_info',' Failed to insert data');
         }
    }

    
    public function edit_bike($id){
        
        $product_id= decrypt($id);
        
        $product= Product::where('id',$product_id)->with('brand','model','category','cc_data','cv_original_data','user_data','country_data','state_data')->first();
        
        $previous_owner = DB::table("previous_owners_details")->where("product_id",$product_id)->get();
        
        $add_photo_list  = DB::table("add_photo_list")->get();
        foreach($add_photo_list as $list)
        {
            $list_id =  $list->id;
            $list_name = $list->name;
            $media_files = DB::table("media_files")->where(array('category'=>$list_id, 'product_id' =>$product_id ))->get();
            $documentation[] = array('list_id' => $list_id,'list_name' => $list_name, 'media_files' =>$media_files);
            
        }
        
    
        //echo "<pre>";
        //print_r($documentation); die;
       $cv_original = DB::table("motor_cycle_cv_original")->pluck("cv_original_name","id");
        $cc =     DB::table("motor_cycle_cc")->pluck("cc_name","id");
        $brands = DB::table("motorcycle_brand")->pluck("brand_name","id");
        $country = DB::table("country")->pluck("country_name","id");
        $category = DB::table("motor_cycle_category")->pluck("category_name","id");
          
        return view('edit-bike',compact('brands','country','category','cc','cv_original'))->with(array('product'=>$product, 'previous_owner' =>$previous_owner, 'documentation' => $documentation));
        
    }
    
    public function get_document_files(Request $request)
    {
      $list_id= $request->input('id');  
       $media_file = DB::table('media_files')
                            ->where('media_files.id',$list_id)
                            ->select('media_files.*', 'add_photo_list.name')
                            ->leftjoin('add_photo_list','add_photo_list.id','=','media_files.category')
                            
                            ->first();
       if($media_file)
       {
           $base_url = url("/");
          
            echo ' <div class="modal-header">
                   
                    <h4 class="modal-title">'. $media_file->name .' </h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                    <div class="col-sm-12">
                       <center> <b><span id="s_message"></span> </b></center>
                    </div>
                        <div class="col-sm-4">
                            <img src="'.$base_url.'/public/images/'.$media_file->user_id.'/'.$media_file->product_id.'/'.$media_file->file.'" width="100%">
                        </div>
                         <div class="col-sm-8">
                         <form action="'.$base_url.'/update_document_files"  method="post" id="update_document_form" class="was-validated"> 
                        '. csrf_field() .'
                            <input type="hidden" name="media_id" class="form-control"  value="'. encrypt($media_file->id) .'" required>
                            <input type="hidden" name="pro_id" class="form-control"  value="'. encrypt($media_file->product_id) .'" required>
                            <div class="form-group">
                                  <label>Title</label>
                                  <input type="text" name="title" class="form-control" placeholder="Enter title " value="'. $media_file->title .'" required>
                              </div>
                              <div class="form-group">
                                  <label>Description</label>
                                  <textarea  class="form-control" name="description" placeholder="Description here" rows="5" required>  '. $media_file->description .' </textarea>
                              </div>
                             <div class="form-group">
                                  <input type="submit" id="update_document_btn"  class=" btn-hover pull-right color-4 " value="Update">
                              </div>
                            </form>
                        </div>
                    </div>
                    
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="close_doc_modal" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>';
           
       }else{
          
       }
     
    }
    
    //to update documents details
    public function update_document_files(Request $request)
    {
       $id = decrypt($request->input('media_id'));
       $product_id = $request->input('pro_id');
       $title = $request->input('title');
       $description = $request->input('description');
      $media = Media::find($id);
       if($media->title != $title){
           $title_data = array(
                'media_id' =>  $id,
                'updated_title'  =>  $title,
                'created_at' =>NOW(),
                'updated_at' => NOW()
               );
          DB::table('media_title_modification')->insert($title_data);
          
       }
        if($media->description != $description){
           $desc_data = array(
                'media_id' =>  $id,
                'updated_description'  =>  $description,
                'created_at' =>NOW(),
                'updated_at' => NOW()
               );
          DB::table('media_description_modification')->insert($desc_data);
       }
      
       $data    = array(
            'title'  => $title ,
            'description' => $description,
            'updated_at' => NOW()
           );
       $update = DB::table('media_files')->where('id',$id)->update($data);
       if($update)
        {
            $results = array(
    			'result'    =>'TRUE',
    			'id'        => $id,
    			'title'     => $title,
    			'desc'       => $description,
    			'message'   =>'Successfully Updated !!!'
    		);
            
        }else{
            $results = array(
    			'result'=>'FALSE',
    			'message'=>'Failed !!! Please Try Again'
    		);
        }
        echo json_encode($results);
       
    }
    
    //update description of the product
    public function update_description(Request $request)
    {
        $id = decrypt($request->input('product_id'));
        $description = $request->input('description');
        $data = array('description'=> $description);
        $update    =   DB::table('products')->where('id',$id)->update($data);
        if($update)
        {
            echo 1;
        }else{
            echo 2;
        }
        
    }
    
    
    public function update_motor_cycle_info(Request $request)
    {
        $product_id  =  decrypt($request->input('pro_id'));
        $user_id     =  Auth::user()->id;
        $product    =   DB::table('products')->where('id',$product_id)->first();
       
        
        if ($request->hasFile('bike_imgs')) {
            $b_img = $request->file('bike_imgs');
            $bike_imgs = time().'b.'.$b_img->getClientOriginalExtension();
           
        }else{
            $bike_imgs=$product->bike_imgs;
        }
         
         
            if ($request->hasFile('current_cv_image')) {
                $c_img = $request->file('current_cv_image');
                $current_cv_image = time().'ccm.'.$c_img->getClientOriginalExtension();
            }else{
               $current_cv_image= $product->current_cv_image;
            }
            
       
         
         
         $data = array(
            'bike_name' => $request->input('bike_name'),
            /*'category_id' =>  $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
            'model_id' => $request->input('model_id'),
            'year' => $request->input('year'),
            'bike_cc' => $request->input('bike_cc'),
            'cv_original' => $request->input('cv_original'),
            'other_cv_original' => $request->input('other_cv_original'),*/
            'current_cv' => $request->input('current_cv'),
            'current_cv_image'  => $current_cv_image,
            /*'frame_no' => $request->input('frame_no'),
            'frame_no_2' => $request->input('frame_no_2'),
            'plate_no' => $request->input('plate_no'),*/
            'country' => $request->input('country'),
            'state' => $request->input('region'),
            'city' => $request->input('city'),
            /*'new_or_used' => $request->input('new_or_used'),
            'bike_imgs' =>  $bike_imgs,
            'currency_code' => $request->input('currency_code'),
            'selling_price' => $request->input('selling_price'),
            'c_mileage_type' => $request->input('c_mileage_type'),
            'c_mileage' => $request->input('c_mileage'),
            'add_alarm_mileage' => $request->input('set_alarm_mileage'),
            'add_alarm_assurance' =>str_replace(' ', '',  $request->input('add_alarm_assurance') ),
            'add_alarm_chain_lube' => $request->input('set_alarm_chain_lube'),
            'status' => 1,*/
            'updated_at' =>NOW()

         );

         $result_id = DB::table('products')->where('id',$product_id)->update($data);
         if($result_id)
         {
             
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
                
            
            return redirect('/my-profile')->with('info','success');

         }else{
                return back()->with('fail_info',' Failed to insert data');
         }  
    }
    
    public static function get_category_name($id)
    {
        $category = DB::table('motor_cycle_category')->select('*')->where('id',$id)->first();
        if($category)
        {
            return $category->category_name;
        }else{
            return '';
        }
    }
    
    public static function get_brand_name($id)
    {
        $brand = DB::table('motorcycle_brand')->select('*')->where('id',$id)->first();
        if($brand)
        {
            return $brand->brand_name;
        }else{
            return '';
        }
    }
    public static function get_model_name($id)
    {
        $model = DB::table('motorcycle_model')->where('id',$id)->first();
        if($model)
        {
            return $model->model_name;
        }else{
            return '';
        }
    }
    public static function get_cc_name($id)
    {
        $model = DB::table('motor_cycle_cc')->select('*')->where('id',$id)->first();
        if($model)
        {
            return $model->cc_name;
        }else{
            return '';
        }
    }
    public static function get_cv_original_name($id)
    {
        $model = DB::table('motor_cycle_cv_original')->select('*')->where('id',$id)->first();
        if($model)
        {
            return $model->cv_original_name;
        }else{
            return '';
        }
    }
    public static function get_country_name($id)
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
    public static function get_state_name($id)
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
    
}
