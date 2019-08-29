<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use DB;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    protected $table='admin_auth';
    protected $fillable = ['username', 'email', 'password'];

	protected $hidden   = ['password', 'remember_token'];
}
