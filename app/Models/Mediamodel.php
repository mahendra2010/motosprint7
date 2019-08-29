<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Mediamodel extends Model
{
    protected $table='media_files';
    protected $fillable = ['user_id', 'product_id', 'title', 'description', 'media_type', 'category', 'file', 'hash_code'];
	
}
