<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Usermodel extends Model
{
    protected $table='users';
    
    protected $fillable = ['username', 'email', 'password'];

	protected $hidden   = ['password', 'remember_token'];
	
	public function country_data() {
        return $this->belongsTo(CountryModel::class,'country','id'); // don't forget to add your full namespace
    }
    public function state_data() {
        return $this->belongsTo(StateModel::class,'region','id'); // don't forget to add your full namespace
    }
}
