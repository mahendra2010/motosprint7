<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('surname1')->nullable();
            $table->string('surname2')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('access_token')->nullable();
            $table->string('token')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_id')->nullable();
            $table->string('device_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verified_status')->nullable();
            $table->string('dni')->nullable();
            $table->string('nickname')->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('user_type')->nullable();
            $table->string('email_notification')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
