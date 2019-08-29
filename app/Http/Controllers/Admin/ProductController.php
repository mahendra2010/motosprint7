<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Productmodel as Product;


use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\File;
/*
Controller : Product Controller
Descrption : this controller is for implemention of all product list  related to MotoBlockchain motorcycle with combination of all related method.
Author : Dharma Chand Kumar
*/
class ProductController extends Controller
{
    private $base_url;

    public function __construct()
    {
        //base url of the website
        $this->base_url = url('/');
      
    }
    //
    /*To load product list view*/
    public function display_products()
    {
        
        return view('admin.products-list');
    }
    /*End of product list view*/
    
    /*Product List method to fetch all products using serverside ajax*/
    public function product_list()
    {
         //$product = Product::with('brand','model','category','cc_data','cv_original_data','user_data')->get();
         $product = Product::query()->with('brand','model','category','cc_data','cv_original_data','user_data')->orderByDesc('id');
     
      return Datatables::of($product)
          ->addColumn('bike_imgs', function ($product){
                 if(!empty($product->bike_imgs))
                 {
                     return '<a href="motor-cycle-detail/'.encrypt($product->id).'"><img src="'.$this->base_url.'/public/images/'.$product->user_id.'/'.$product->id.'/'.$product->bike_imgs.'" style="width:40px; height:40px"></a>';
                 }else{
                    return '<a href="motor-cycle-detail/'.encrypt($product->id).'"><img src="'.$this->base_url.'/public/images/default_images/default_bike.png" style="width:40px; height:40px"></a>';
                 }
              })
          
            ->addColumn('name_category', function ($product) {
                  return @$product->bike_name .' / '. @$product->category->category_name;
                })
            ->addColumn('brand_model', function ($product) {
                  return @$product->brand->brand_name .'/ '. @$product->model->model_name ;
                })
            ->addColumn('cc_cv', function ($product) {
                  return @$product->cc_data->cc_name .' / '.@$product->cv_original_data->cv_original_name;
                })
            ->addColumn('posted_by', function ($product) {
                  return @$product->user_data->name ;
                })
            ->addColumn('status', function ($product) {
              if($product->status=='1')
              {
                  return '<a href="javascript:void(0)" id="'.$product->id.'" onclick="disable_product(this.id)"><span class="label label-success">Active</span></button>';
              }else{
                  return '<a href="javascript:void(0)" id="'.$product->id.'" onclick="Activate_product(this.id)"><span class="label label-danger">Deactive</span></a>';
              }
                })
          ->addColumn('action', function ($product) {
                  return '<a href="motor-cycle-detail/'.encrypt($product->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open" title="View"></i> </a>
                  <button type="button" id="'.$product->id.'" onclick="deleteProduct(this.id)"   class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash" title="Delete"></i> </button> ';
                })
            ->rawColumns(['bike_imgs', 'name_category','brand_model','cc_cv','posted_by', 'status', 'action'])

         ->make(true); 
    }
    /*End method*/
    
    /*Delete the Product by paricular id*/
    public function delete_product($id)
    {
             $product_id    =  $id;
            $getproduct     =  DB::table('products')->where('id',$product_id)->first();
            $user_id = $getproduct ->user_id;
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
         
       
       
      $delete= DB::table('products')->where('id', $product_id)->delete();
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
    /*End of method*/
    
    
    /*Disable any Product by id*/
    public function disable_product($id)
    {
       
        $data=array(
            'status' => '0'
            );
      
       $update= DB::table('products')->where('id', $id)->update($data);
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
    
    /*This method turns the product in active mode*/
     public function active_product($id)
    {
       
        $data=array(
            'status' => '1'
            );
       $update= DB::table('products')->where('id', $id)->update($data);
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
    
    /*Product Discription View data*/
    public function motor_cycle_detail($id)
    {
        $product_id = decrypt($id);
       // echo $product_id;
       
       $product = Product::where('id',$product_id)->with('brand','model','category','cc_data','cv_original_data','user_data', 'country_data', 'state_data')->first();
       
       $previous_owner = DB::table("previous_owners_details")->where("product_id",$product_id)->get();
       $add_photo_list  = DB::table("add_photo_list")->get();
        foreach($add_photo_list as $list)
        {
            $list_id =  $list->id;
            $list_name = $list->name;
            $media_files = DB::table("media_files")->where(array('category'=>$list_id, 'product_id' =>$product_id ))->get();
            $documentation[] = array('list_id' => $list_id,'list_name' => $list_name, 'media_files' =>$media_files);
            
        }
        
        //print_r($product_det);
        if($product)
        {
           return view('admin.motor-cycle-detail',compact('product'))->with(array('previous_owner'=>$previous_owner,'documentation'=>$documentation));  
        }else{
            echo "<script>alert('No User Found')</script>";
        } 
	     
    }
    /*End of Product description method*/
    
    
    
}
