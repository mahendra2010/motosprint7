<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('model_id')->nullable();
            $table->string('frame_no')->nullable();
            $table->string('frame_img')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('new_or_used')->nullable();
            $table->string('previous_owner_no')->nullable();
            $table->string('bike_imgs')->nullable();
            $table->string('mileage')->nullable();
            $table->string('mileage_img')->nullable();
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
        Schema::dropIfExists('products');
    }
}
