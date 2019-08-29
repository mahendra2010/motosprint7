<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Blogmodel extends Model
{
    protected $table='blogs';

    protected $fillable = ['title', 'blog_cat', 'blog_img', 'blog_content', 'posted_by', 'status','created_at', 'updated_at'];
	
	public function tag_data() {
        return $this->belongsTo(TagsModel::class); // don't forget to add your full namespace
    }
}
