<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMechanicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_mechanic_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mechanic_name');
            $table->string('mechanic_web');
            $table->string('mechanic_phone');
            $table->string('mechanic_email');
            $table->string('mechanic_address');
            $table->string('privacy');
            
            
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
        Schema::dropIfExists('product_mechanic_details');
    }
}
