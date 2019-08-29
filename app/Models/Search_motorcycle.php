<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search_motorcycle extends Model
{
    //
     protected $table='search_motorcycles';
    
    public function search_bike_data()
    {
        return $this->belongsTo(Productmodel::class,'product_id','id'); // don't forget to add your full namespace
    }
    
}
