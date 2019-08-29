<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blogmodel as Blog;
use App\Models\MoterCycleBrand as brand;
use App\Models\MoterCycleModels as model;
use App\Models\Productmodel as Product;
use App\Http\Helpers\ApiCommonHelper as myhelper;
use Illuminate\Support\Facades\Mail;
use App\Mail\Simple;
use Auth;
class Shop extends Controller{

    private $base_url;

    public function __construct(){
        //blockio init
        $this->base_url = url('/');
      
    }
 
    public function index(){
        $brands = brand::all();
        if(!empty($_GET['brand'])){
            $models = model::where('brand_id',$_GET['brand'])->get();  
        }else{
          $models = model::all();  
        }
        
        $query= DB::table('products')
            ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->leftjoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
            ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->leftjoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
            ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name');

            if(!empty($_REQUEST['brand'])){
            	$query->where('products.brand_id', $_REQUEST['brand']);
            }
            if(!empty($_REQUEST['model'])){
            	$query->where('products.model_id', $_REQUEST['model']);
            }
            if(!empty($_REQUEST['from_year'])){
            	$query->orwhere('products.year', $_REQUEST['from_year']);
            }
            if(!empty($_REQUEST['to_year'])){
            	$query->orwhere('products.year', $_REQUEST['to_year']);
            }
            $query->orderBy('id','DESC');
            $products = $query->get();
        return view('catalog', compact('products', 'products', 'models','models', 'brands','brands'));
    }
    public function product($id){
        //$datas = array('product_id' => $slug, 'user_id' => @Auth::user()->id);
        $brands = brand::all();
        $models = model::all();
        $datas  = DB::table('products')
            ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->leftjoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
            ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->leftjoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
            ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name')
            ->where('products.id', $id)
            ->first();
        if($datas){
            $brand_id = $datas->brand_id;
            $related_products = Product::take(4)->where('brand_id',$brand_id)->get();
            
            $receiver_id = @Auth::user()->id;
            $sender_id  = $datas->user_id;
            $product_id = $id;
            $contact_sellers = DB::table('contact_seller')
                              ->where(function($q) use ($sender_id,$receiver_id,$product_id){
                                  $q->where('contact_seller.sender_id', $sender_id)
                                    ->where('contact_seller.receiver_id', $receiver_id)
                                    ->where('contact_seller.product_id', $product_id);
                              })
                              ->orwhere(function($q) use ($sender_id,$receiver_id,$product_id){
                                  $q->where('contact_seller.sender_id', $receiver_id )
                                    ->where('contact_seller.receiver_id', $sender_id)
                                    ->where('contact_seller.product_id', $product_id);
                              })
                              ->leftjoin('users','users.id','=','contact_seller.sender_id')
                              ->get();    
            //echo "<pre>";
            //print_r($contact_sellers);
            return view('product_single', compact('models','models', 'brands','brands', 'datas','datas','contact_sellers','related_products'));
        }else{
            echo "<script>alert('No products found ');</script>";
        }
        
    }

    public function visit_product(Request $request){
    	if(Auth::user()->id){
	    	$product_id = $request->input('product_id');
	    	$user_id = $request->input('user_id');

	    	$check = DB::table('search_motorcycles')
	    	->where('product_id', $product_id)
	    	->where('user_id', $user_id)
	    	->first();

	    	if(!empty($check)){

	    		DB::table('search_motorcycles')
	    		->where('user_id', $user_id)
	    		->where('product_id', $product_id)
	    		->update(['user_id' => $user_id, 'product_id' => $product_id, 'status' => 0]);
	    		echo "update";

	    	}else{

	    		DB::table('search_motorcycles')->insert(['user_id' => $user_id, 'product_id' => $product_id, 'status' => 0]);

	    		echo "save";

	    	}
    	}
    }

    public function save_product(Request $request){

    	$user_id = @Auth::user()->id;

    	if(!empty($user_id)){

	    	$product_id = $request->input('product_id');
	    	$noti = (!empty($request->input('noti')))? $request->input('noti') : '';
	    	if(!empty($noti)){
	    		$status = 2;
	    	}else{
	    		$status = 1;
	    	}
	    	$check = DB::table('search_motorcycles')
	    	->where('product_id', $product_id)
	    	->where('user_id', $user_id)
	    	->where('status', $status)
	    	->first();

	    	if(!empty($check)){

	    		DB::table('search_motorcycles')
	    		->where('user_id', $user_id)
	    		->where('product_id', $product_id)
	    		->update(['user_id' => $user_id, 'product_id' => $product_id, 'status' => $status]);
	    		echo 2;

	    	}else{

	    		DB::table('search_motorcycles')->insert(['user_id' => $user_id, 'product_id' => $product_id, 'status' => $status]);

	    		echo 1;

	    	}

    	}else{
    		echo 3;
    	}
    }

    public function ask_to_seller(Request $request){

    	$user_id = @Auth::user()->id;

    	if(!empty($user_id)){

	    	$product_id = $request->input('product_id');
	    	$seller_id = $request->input('seller_id');
	    	$question = htmlspecialchars($request->input('question'));
    		DB::table('contact_seller')->insert(['product_id' => $product_id, 'sender_id' => $user_id, 'receiver_id' => $seller_id, 'message'=>$question]);
	    	echo 1;

    	}else{
    		echo 3;
    	}
    }

    public function search_filter(Request $request){

        $models = (!empty($request->input('model')))? $request->input('model') : '';
        if(!empty($request->input('brand'))){
            $brands = $request->input('brand');
            //$models = (!empty($request->input('model')))? $request->input('model') : '';
        }else{
            $brands = '';
            //$models = '';
        }

         $seach_keys = '<div id="searched_by_key">';
         $bid=array();

		 $query= DB::table('products')
            ->leftjoin('motorcycle_brand', 'motorcycle_brand.id', '=', 'products.brand_id')
            ->leftjoin('motorcycle_model', 'motorcycle_model.id', '=', 'products.model_id')
            ->leftjoin('motor_cycle_category', 'motor_cycle_category.id', '=', 'products.category_id')
            ->leftjoin('motor_cycle_cc', 'motor_cycle_cc.id', '=', 'products.bike_cc')
            ->leftjoin('motor_cycle_cv_original', 'motor_cycle_cv_original.id', '=', 'products.cv_original')
            ->select('products.*', 'motorcycle_brand.brand_name', 'motorcycle_model.model_name','motor_cycle_category.category_name','motor_cycle_cc.cc_name','motor_cycle_cv_original.cv_original_name');
            
            if($brands != ''){

            	foreach($brands as $brand){
            		$query->orwhere('products.brand_id', $brand);
                    $bid[] = $brand;
                    $s_brand = myhelper::get_brand_name($brand);
                    $seach_keys .= '<div class="alert alert-success alert-dismissible filter_label"><span>'.$s_brand.'</span><button active_check="brand_'.$brand.'" type="button" class="close filter_close" data-dismiss="alert">&times;</button></div>'; 
            	}

            }

            if($models != ''){
            	
            	foreach($models as $model){
                   $mid[] = $model;
            	   //$query->orwhere('products.model_id', $model);
                   $s_model = myhelper::get_model_name($model);
                   $seach_keys .= '<div class="alert alert-success alert-dismissible filter_label"><span>'.$s_model.'</span><button active_check="model_'.$model.'" type="button" class="close filter_close" data-dismiss="alert">&times;</button></div>';
            	}
                $query->whereIn('products.model_id', $mid);
            }

            $from_year =(!empty($request->input('from_year')))? $request->input('from_year') : '';
            $to_year =(!empty($request->input('to_year')))? $request->input('to_year') : '';

            if($from_year != '' && $to_year !=''){

                $seach_keys .='<div class="alert alert-success alert-dismissible filter_label"><span>From : '.$from_year.' To '.$to_year.'</span><button active_check="dselect" type="button" class="close filter_close" data-dismiss="alert">&times;</button></div>';
                $query->whereBetween('products.year', array($from_year, $to_year));
            	
            }

            $query->orderBy('id','DESC');
            $products = $query->get();

            $result = '';

            if(empty($products)){

                $result .='<div style="margin: 0 auto; width: 40%;" class="alert alert-warning alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          Motorcycles are not found.</div>';
                $c_prod = 0;

            }else{
                
                $result .='<ul class="row">';
                $c_prod = count($products);
                if($c_prod >= 1){
                    foreach($products as $product){
                      $result .='<li class="col-md-4 brand_'.$product->brand_id.' model_'.$product->model_id.'">
                            <figure>
                            <a href="'.$this->base_url.'/product/'.$product->id.'">';
                              if(!empty($product->bike_imgs)){
                                $result .='<img src="'.$this->base_url.'/public/images/'.$product->user_id.'/'.$product->id.'/'.$product->bike_imgs.'" alt="">';
                              }else{
                                 $result .='<img src="'.$this->base_url.'/public/images/default_images/default_bike.png" alt="">';
                              }
                            $result .='</a>';
                            if(!empty($product->selling_price)){
                                $result .='<span>sale</span>';
                            }
                            $price = ($product->selling_price) ? '$'.$product->selling_price : '';
                            $created_date = date('d M Y h:i A', strtotime($product->created_at));
                            $result .='</figure>
                            <div class="automobile-shop-grid-text">
                                <h4 style="margin: 0;"><a class="visit" data-productid="'.$product->id.'" data-userid="'.$product->user_id.'" href="'.$this->base_url.'/product/'.$product->id.'">'.$product->bike_name.'</a></h4>';
                                $result .='<time class="small" datetime=""><strong>Create Date :</strong> '.$created_date.'</time>';
                                $result .='<span class="small"><strong>Number of Blockchain Certificates :</strong>'. myhelper::count_certificate($product->id) .'</span>
                                <span class="small"><strong>Modified :</strong> '. myhelper::get_modified($product->id) .'</span>
                                <span>'.$price.'
                                </span>
                            </div>
                        </li>';
                      }
                    $result .='</ul>';
                }else{
                    $result .='<div style="margin: 0 auto; width: 40%;" class="alert alert-warning alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                          Motorcycles are not found.</div>';
                    $c_prod = 0;
                }
            }
            if(!empty($request->input('brand'))){
            $models_data = DB::table('motorcycle_model')
                ->select('*')->whereIn('brand_id', $bid)->orderBy('brand_id')
                ->get();
            }else{
                $models_data = model::all();
            }

            $model_data = '';

            if(!empty($models_data)){

                $model_data = '<div class="automobile-widget-heading"><h2>Models</h2><i class="fa fa-angle-down"></i></div>
                    <ul class="overflow-auto">';
                            $mci = 0;

                              foreach($models_data as $model){
                                $checked = '';
                                if(!empty($models)){
                                    //$req_model_count = (count($models)) - 1;
                                    //if($req_model_count >=  $mci){
                                        
                                        if (in_array($model->id, $models)){
                                            $checked = 'checked="checked"';
                                        }
                                    //}
                                }

                                $brand_id = (!empty($model->brand_id))? $model->brand_id : '';
                                $model_data .= '<li class="item_for_brand_'.$brand_id.'">
                                    <div class="automobile-check widget-check widget-true">
                                        <input name="model[]" class="search_filter" id="model_'.$model->id .'" data-type="model" value="'.$model->id .'" type="checkbox" '.$checked.'>
                                        <label for="model_'. $model->id .'">'. $model->model_name .'</label>
                                    </div>
                                </li>';
                                $mci++;
                              }
                              //die();
                            $model_data .= '</ul>';
            }
            $seach_keys .= '</div>';

            $res = array('model'=>$model_data, 'product_lists'=>$result, 'product_count'=>$c_prod, 'filter_key'=>$seach_keys);
            echo json_encode($res);
            die;

    }
    // Request To access Media or Title
    public function request_media(Request $request){

        $user_id = @Auth::user()->id;
        $user_name = @Auth::user()->name;

        if(!empty($user_id)){

            $product_id = $request->input('product_id');
            $media_id = $request->input('media_id');
            $type = $request->input('type');
            $seller_id = $request->input('seller_id');
            $privacy = 0;

            if(!empty($request->input('private'))){

                if($request->input('private') == 'true'){
                    $privacy = 1;
                }else{
                    $privacy = 0;
                }

            }

            $comment = strip_tags($request->input('comment'));

            $mc = DB::table('media_permission')->where('media_id', $media_id)->where('user_id', $user_id)->count();

            ##################################################################
                
                $seller  = myhelper::get_user_profile($seller_id);
                $product = myhelper::get_product($product_id);
                $email = $seller->email;

                if($privacy == 1){
                    $msg = "Dear ".$seller->name.", <br /><br /> ".$user_name." has requested you to visualize the content of a Private Document. He is only able to see the title of the document.<br />";
                    if($comment){
                        $msg .= $user_name." wrote: \"".$comment."\". <br /><br />";
                    }
                    $msg .="You can give him access by following <a href='".url('/')."/my-profile?tab=requested_doc'>This Link</a>.";
                }
                if($privacy == 0 && $comment != ''){
                    $msg = "Dear ".$seller->name.", you have received a question about your motorcycle ".$product->bike_name." by the user ".$user_name.". Please follow this link 
                    <a href='".url('/')."/my-profile?tab=requested_doc'>Follow This Link</a> to answer the question<br />";
                }
                $user_data = array(
                        'sender_email'  => 'admin@motoblockchain.es',
                        'name'          => $seller->name,
                        'email'         => @Auth::user()->email,
                        'subject'       => 'Document Request',
                        'message'       => $msg,
                );
                //$email = 'mahendra.depex@gmail.com';

                ##################################################################
                
            if($mc > 0){
                Mail::to($email)->send(new Simple($user_data));
                echo "Your request to Access the private document was already sent to the owner. Please wait for the reply";
            }else{
                DB::table('media_permission')->insert(['product_id' => $product_id, 'media_id' => $media_id, 'user_id' => $user_id, 'seller_id' => $seller_id, 'type' => $type, 'status'=>0, 'comment' => $comment, 'privacy'=>$privacy]);
                Mail::to($email)->send(new Simple($user_data));
                echo "Your request to Access the private document was correctly sent to the owner. Please wait for the reply";
            }
        }else{
            $product_id = (!empty($request->input('product_id')))? '?req=product/'.$request->input('product_id') : '';
            $login_url = url('/').'/login'.$product_id;
            echo 'Login is Required <em> : Please Login <a href="'.$login_url.'">Click Here</a>';
        }
    }
    // Request To access Media or Title Approval
    public function request_media_approve(Request $request){

        $user_id = @Auth::user()->id;

        if(!empty($user_id)){

            $media_id = $request->input('media_id');
            $status = $request->input('status');

            $mc = DB::table('media_permission')->where('media_id', $media_id)->where('seller_id', $user_id)->count();
            if($mc > 0){

                DB::table('media_permission')->where('media_id', $media_id)->update(['status' => $status]);
                echo $status == 1;
            }

        }else{
            echo 'Login is Required <em> : Please Login <a href="'.url('/').'/login">Click Here</a>';
        }
    }
    public function update_doc(Request $request){

        $model_category = (!empty($request->input('model_category'))) ? $request->input('model_category') :'';
        $title      = $request->input('title');
        $desc       = $request->input('desc');
        $privacy    = $request->input('privacy');
        $id         = $request->input('doc_id');

        if((!empty($request->input('doc_id'))) && (!empty($request->input('title')))){

            $updte = DB::table('media_files')->where('id', $id)->update(array('title' => $title,'description'=>$desc, 'privacy'=>$privacy));
            if($updte){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 0;
        }

        if($model_category == 1 || $model_category == 2){

            $currency_invoice = $request->input('currency_invoice');
            $user_id = $request->input('user_id');
            $product_id = $request->input('product_id');
            $currency_code = $request->input('currency_invoice');

        $spend_invoice = (!empty($request->input('spend_invoice')))? $request->input('spend_invoice') : 0;
            $spend_acces = (!empty($request->input('spend_acces')))? $request->input('spend_acces'):0;
            $spend_tuning = (!empty($request->input('spend_tuning')))? $request->input('spend_tuning'):0;
        $spend_replace = (!empty($request->input('spend_replace')))? $request->input('spend_replace'):0;
        $related_media = (!empty($request->input('related_media')))? $request->input('related_media'):0;
            $total = $spend_invoice+$spend_acces+$spend_tuning+$spend_replace;

        $media_ids = preg_split("/\,/", $related_media);

        if(in_array($id, $media_ids)){
            unset($media_ids[$id]);
            $m_ids = array_unique($media_ids);  
        }else{
            $m_ids = array_unique($media_ids);
        }
        

            $pic = DB::table('product_invoice')
            ->where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->where('media_id', $id)
            ->count();

            $pic_data = array(
                'user_id'               =>$user_id,
                'product_id'            =>$product_id, 
                'media_id'              =>$id,
                'related_id'            =>implode(',',$m_ids),
                'name'                  =>$title,
                'invoice_name'          =>$title,
                'invoice_other_name'    =>$title,
                'currency_code'         =>$currency_code,
                'invoice_details'       =>$desc,
                't_m_spent_accessories' =>$spend_acces,
                't_m_spent_components'  =>$spend_tuning,
                't_m_spent_invoice'     =>$spend_invoice,
                't_m_spent_replacement' =>$spend_replace,
                'invoice_type'          =>'INVOICE',
                'total_money_spent'     =>$total,
                'privacy'               =>$privacy,
                'updated_at'            =>NOW()
            );

            if($pic){
                $updte = DB::table('product_invoice')
                        ->where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->where('media_id', $id)
                        ->update($pic_data);
                        echo 1;
            }else{
                $pic_data['created_at']  = NOW();
                DB::table('product_invoice')->insert($pic_data);
                echo 1;
            }
        }

        
    }
public static function document_model_view($dc, $doc_id, $title,$desc, $img, $privacy, $category= null, $user_id = null, $product_id = null, $tot = null){

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

         $model = '<div id="document_view_'.$doc_id.'_'.($dc+ $tot) .'" class="modal fade">
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
                                    $model .= '<div class="clearfix"></div>'.$img;
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
    public static function document_files($p_id, $user_id, $medias){
       $doc =' <div class="container">
                <div class="row">';
                $c_user_id = (@Auth::user()->id)? @Auth::user()->id :0;
                $mec = count($medias);
                if($mec > 0){
                    $i = 1;
                    foreach($medias as $media){ 
                        $doc .='<div class="col-lg-3 col-6 padding-5 magnify">';
                        $dc_img = myhelper::check_media_permission($media->id, $c_user_id, 'doc_img');
                        $dc_title = myhelper::check_media_permission($media->id, $c_user_id, 'doc_title');

                        if($media->privacy == 1){ 
                            $doc_req_type = "'doc_title'"; 
                        }else if($media->privacy == 2){ 
                            $doc_req_type = "'doc_img'"; 
                        }else{
                            $doc_req_type = '';
                        }
                        $d_view_btn ='<button class="btn btn-sm btn-success" style="margin:0px;position: absolute;background: #fa6a2f;border: 0;border-radius: 0;right: 10px;top: 10px;" data-toggle="modal" data-target="#document_view_'.$media->id.'_'.($i+ $mec).'"><i class="fa fa-eye" aria-hidden="true"></i></button>';
                        $d_img = '<a data-magnify="gallery" href="'.url('/').'/public/images/'.$user_id .'/'.$p_id.'/'.$media->file.'">';
                        $d_img .='<img style="width:100%;" class="img-responsive img-thumbnail img-fluid" src="'.url('/').'/public/images/'.$user_id.'/'.$p_id.'/'.$media->file.'" alt=""></a>';

                        $d_time ='<time class="small" datetime="'.$media->created_at.'"><strong>Date :</strong>'. date("d M Y h:i A", strtotime($media->created_at)).'</time>';
                        if(!empty($media->title)){
                            $d_title ='<div class="doc_title">'.$media->title.'</div>';
                        }

                        $pri_img ='<div class="img_container"><span class="ask_to_access">Ask access to private document</span>';
                        $pri_img .='<img src="'.url('/').'/public/images/default_images/private_lock.png" alt="Private Document">';
                        $pri_img .='<small><a onclick="return request_media('.$media->id.', '.$doc_req_type.')"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a></small>
                            </div>';

                        if($media->privacy == 2 && $dc_img == 0){ 
                            $doc .= $pri_img;
                        }else if($media->privacy == 1){
                            //$doc .= $d_view_btn;
                            $doc .= $pri_img;
                            $doc .= $d_time;
                            $doc .= $d_title; 
                           // $doc .= self::document_model_view($i, $media->id, $media->title, $media->description, $pri_img, $media->privacy, $media->category, $user_id, $media->product_id);
                        }else{
                            $doc .= $d_view_btn;
                            $doc .= $d_img;
                            $doc .= $d_time;
                            $doc .= $d_title; 

                            $doc .= self::document_model_view($i, $media->id, $media->title, $media->description, $d_img, $media->privacy, $media->category, $user_id, $media->product_id, $mec); 
                        }
                        $doc .='</div>';
                        $i++;
                    }
                }else{
                    $doc .='<div class="alert alert-warning alert-dismissible fade show" role="alert">There is no data to display</div>';
                }
                    
            $doc .='</div>
                </div>';
    return $doc;
    }

    public function view_doc(Request $request){
        
        if(!empty($request->input('id'))){
            DB::table('media_permission')->where('id', $request->input('id'))->update(['view' => 1]);
            echo 1;
        }
    }
}
