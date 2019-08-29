<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productmodel extends Model
{
    //
    protected $table='products';
    
    public function brand() {
        return $this->belongsTo(MoterCycleBrand::class,'brand_id','id'); // don't forget to add your full namespace
    }
    
    public function model()
    {
        return $this->belongsTo(MoterCycleModels::class,'model_id','id'); // don't forget to add your full namespace
    }
    
    public function category()
    {
        return $this->belongsTo(MotorCycleCategory::class,'category_id','id'); // don't forget to add your full namespace
    }
   
    public function cc_data()
    {
        return $this->belongsTo(CCModel::class,'bike_cc','id'); // don't forget to add your full namespace
    }
    
    public function cv_original_data()
    {
        return $this->belongsTo(CV_OriginalModel::class,'cv_original','id'); // don't forget to add your full namespace
    }
    
    public function user_data()
    {
        return $this->belongsTo(Usermodel::class,'user_id','id'); // don't forget to add your full namespace
    }
    public function country_data()
    {
        return $this->belongsTo(CountryModel::class,'country','id'); // don't forget to add your full namespace
    }
    public function state_data()
    {
        return $this->belongsTo(StateModel::class,'state','id'); // don't forget to add your full namespace
    }
    
   
    
}
