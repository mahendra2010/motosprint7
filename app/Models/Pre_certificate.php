<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Pre_certificate extends Model
{
    protected $table='pre_certificate';
    protected $fillable = ['user_id', 'product_id', 'title', 'user_name', 'user_motorcycle', 'certi_number', 'blockchain_timestamp', 'description', 'media_ids', 'status'];
	
	
}
