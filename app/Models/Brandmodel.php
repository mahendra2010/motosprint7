<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Brandmodel extends Model{
    protected $table='motorcycle_brand';
    protected $fillable = ['brand_name'];	
}
