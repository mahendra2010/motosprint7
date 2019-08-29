<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/contact-us','BlogController@contactus');
Route::post('/contact_us','BlogController@contact_us');
Route::get('/what-we-do','BlogController@whatwedo');
Route::get('/blog','BlogController@index');
Route::get('/blog-description/{id}/{slug}','BlogController@blog_description');
Route::get('/search-blog/{id}','BlogController@search_blog');
Route::post('/insert_comment','BlogController@insert_comment');
Route::get('/testing', function () {  return view('dc_test');  });
Route::get('/', function () {  return view('index');  });

Route::get('/products','Shop@index');
Route::get('/product/{id}','Shop@product');
Route::post('/visit_product','Shop@visit_product');
Route::post('/save_product','Shop@save_product');
Route::post('/ask_to_seller','Shop@ask_to_seller');
Route::post('/search_filter','Shop@search_filter');
Route::post('/request_media','Shop@request_media');
Route::post('/request_media_approve','Shop@request_media_approve');
Route::post('/update_doc','Shop@update_doc');
Route::post('/view_doc','Shop@view_doc');

/*  santosh */
    Route::get('/show','SantoshController@index');
    Route::post('/submitform','SantoshController@submitforms')->name('submitform');
/*  End santosh */


Route::get('/get-state-list','UserController@getStateList');
Route::get('/get-model-list','UserController@getModelList');

#######################################################
//To change language 
Route::get('lang/{lang}',function ($lang){
    Session::put('lang',$lang);
    return redirect()->back();
});

 
 Route::get('/','LoginController@welcome');

#########################################################
//only can view if user is not logged in if they are logged in then they will be redirect to dashboard

Route::group(['middleware' => ['no_auth:users']], function () {
  
    Route::get('/login', function () { return view('login'); });
    Route::get('/register', function () { return view('register'); });
    Route::get('/verify', function () { return view('verify'); });
    Route::get('/forgot-password', function () { return view('forgot-password'); });
    Route::post('/user_registration','LoginController@insert_users');
    Route::post('/user_login','LoginController@login_user');
    Route::get('/verify/{id}/{token}','LoginController@verify_mail');
    Route::post('/forgot_pass','LoginController@forgot_password');
    Route::get('/reset_password/{id}/{token}','LoginController@reset_password');
    Route::post('/generate_new_password','LoginController@generate_new_password');   
    
});

############################################################

########################################################
//only can view if user is logged in
Route::group(['middleware' => ['guest:users']], function () {
    Route::get('/success-login', function () { return view('success-login'); });
    Route::get('/registration-step-1','UserController@registration_step_1');
    Route::get('/motor-cycle-registration', 'UserController@motor_cycle_registration');
   
    Route::post('/reg_step_1_insert','UserController@insert_reg_step1');
    Route::post('/step_1_reg_insert','UserController@step_1_reg_insert');
    Route::get('/owner_registration_status', 'UserController@owner_reg_status');
    Route::get('/logout','UserController@logout');
    //Route::get('/logout','UserController@logout');
    Route::get('/my-profile','UserController@my_profile'); 
    Route::get('/edit-bike/{id}','BikeController@edit_bike');
    Route::get('/view-bike/{id}','BikeController@edit_bike');
    Route::get('/remove_bike/{id}','UserController@remove_bike');
    Route::get('/remove_search_bike/{id}','UserController@remove_search_bike');
    Route::post('/reply_to_user','UserController@reply_to_user');
    Route::post('/related_invoice','UserController@related_invoice');
    Route::post('/add_document','UserController@add_document');

    Route::post('/update_motor_cycle_info','BikeController@update_motor_cycle_info');
    Route::post('/update_user_profile','UserController@update_user_profile');
    Route::post('/add-motor-cycle','BikeController@add_motor_cycle');
    Route::post('/change_user_password','UserController@change_user_password');  
    Route::post('/set_email_subscription','UserController@set_email_subscription');  
    Route::post('/get_document_files','BikeController@get_document_files');  
    Route::post('/update_document_files','BikeController@update_document_files'); 
    Route::post('/update_description','BikeController@update_description');
    Route::post('/get_contact_users_chat','UserController@get_contact_users_chat');
    Route::post('/reply_contact_users_chat','UserController@reply_contact_users_chat');
    Route::post('/cancel_motorcycle_data','UserController@cancel_motorcycle_data');
    Route::post('/cancel_my_acount_data','UserController@cancel_my_acount_data');
    
   
    Route::post('/delete_notify_product','UserController@delete_notify_product');
    
    
    
});

//only can view if Admin is logged in

Route::group(['middleware' => ['guest:admin']], function () {
    
	Route::get('/admin/test', function () { return view('admin.testing'); });
    Route::get('/admin/dashboard','Admin\AdminController@index');
    
    
    
    Route::get('/admin/client_testimonial','Admin\AdminController@client_testimonial');
    Route::get('/admin/client_testimonial_list','Admin\AdminController@client_testimonial_list');
    Route::post('/admin/testimonial_layout','Admin\AdminController@testimonial_layout');
    Route::post('/admin/testimonial_update','Admin\AdminController@testimonial_update');
    Route::get('/admin/disable_testimonial/{id}','Admin\AdminController@disable_testimonial');
    Route::get('/admin/active_testimonial/{id}','Admin\AdminController@active_testimonial');
    Route::get('/admin/delete_testimonial/{id}','Admin\AdminController@delete_testimonial');
    
    
    Route::get('/admin/profile','Admin\AdminController@profile');
    Route::post('/admin/change_password','Admin\AdminController@change_password');
    Route::post('/admin/change_photo','Admin\AdminController@change_photo');
    
    Route::get('/admin/users','Admin\AdminController@display_users');
    Route::get('/admin/unverified_users','Admin\AdminController@unverified_users');
    Route::get('/admin/users_data','Admin\AdminController@users_list');
    Route::get('/admin/unverified_users_list','Admin\AdminController@unverified_users_list');
    Route::post('/admin/send_mail_layout','Admin\AdminController@send_mail_layout');
    
    Route::get('/admin/userdetails/{id}','Admin\AdminController@user_detail');
    Route::get('/admin/deleteuser/{id}','Admin\AdminController@delete_user');
    Route::get('/admin/disable_user/{id}','Admin\AdminController@disable_user');
    Route::get('/admin/activate_user/{id}','Admin\AdminController@active_user');
    
    Route::get('/admin/deactivate_email_notification/{id}','Admin\AdminController@deactivate_email_notification');
    Route::get('/admin/activate_email_notification/{id}','Admin\AdminController@activate_email_notification');
    
    Route::get('/admin/blogs','Admin\AdminController@display_blogs');
    Route::get('/admin/blog_data','Admin\AdminController@blog_list');
    
    Route::get('/admin/blog_description/{id}','Admin\AdminController@blog_description');
    Route::get('/admin/deleteblog/{id}','Admin\AdminController@delete_blog');
    Route::get('/admin/disable_blog/{id}','Admin\AdminController@disable_blog');
    Route::get('/admin/activate_blog/{id}','Admin\AdminController@active_blog');
    Route::get('/admin/delete_blog_media/{id}','Admin\AdminController@delete_blog_media');
    
    Route::get('admin/create', 'Admin\AdminController@create');
    Route::get('admin/index', 'Admin\AdminController@index');
    
    Route::get('admin/add_blog', 'Admin\AdminController@add_blog');
    Route::post('admin/send_mail', 'Admin\AdminController@send_mail');
    
    Route::post('admin/modification_layout', 'Admin\AdminController@modification_layout');
    
   
    Route::post('admin/add_tag', 'Admin\AdminController@add_tag');
    Route::post('/admin/create_blog', 'Admin\AdminController@create_blog');
    Route::post('admin/auto_insert_blog', 'Admin\AdminController@auto_insert_blog');
    Route::get('/admin/edit-blog/{id}', 'Admin\AdminController@edit_blog');
    Route::post('/admin/update_blog', 'Admin\AdminController@update_blog');
    Route::post('/admin/auto_update_blog', 'Admin\AdminController@auto_update_blog');
    Route::get('/admin/blog-comments', 'Admin\AdminController@blog_comments');
    Route::get('/admin/blog_comment_list','Admin\AdminController@blog_comment_list');
    Route::get('/admin/publish_blog_comment/{id}','Admin\AdminController@publish_blog_comment');
    Route::get('/admin/reject_blog_comment/{id}','Admin\AdminController@reject_blog_comment');
    Route::get('/admin/delete_blog_comment/{id}','Admin\AdminController@delete_blog_comment');
    
    
    Route::get('/admin/products','Admin\ProductController@display_products');
    Route::get('/admin/motor_cycle_data','Admin\ProductController@product_list');
    Route::get('/admin/deleteproduct/{id}','Admin\ProductController@delete_product');
    Route::get('/admin/disable_product/{id}','Admin\ProductController@disable_product');
    Route::get('/admin/activate_product/{id}','Admin\ProductController@active_product');
    Route::get('/admin/motor-cycle-detail/{id}','Admin\ProductController@motor_cycle_detail');
    
    Route::get('/admin/uncomplete_products','Admin\ProductController@uncomplete_products');
    Route::get('/admin/uncomplete_products_list','Admin\ProductController@uncomplete_products_list');
    Route::get('/admin/logout','Admin\LoginController@logout');
});

//only can view if admin is not logged in if they are logged in then they will be redirect to dashboard
Route::group([ 'middleware' => ['no_auth:admin']], function () {
   Route::get('/admin/login','Admin\LoginController@index');
    Route::post('/admin/admin_login','Admin\LoginController@admin_login');
});

##########################################################
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

