<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Modelmodel extends Model{
    protected $table='motorcycle_model';
    protected $fillable = ['model_name','brand_id'];	
}
