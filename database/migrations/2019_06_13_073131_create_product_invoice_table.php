<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_invoice', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('user_id');
            $table->Integer('product_id');
            $table->string('name');
            $table->string('invoice_type');
            $table->string('total_money_spent');
            $table->string('t_m_spent_accessories');
            $table->string('t_m_spent_components');
            $table->string('invoice_photo_o_name');
            $table->string('invoice_photo_tmp_name');
            $table->string('privacy');
            $table->string('additional_note');
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
        Schema::dropIfExists('product_invoice');
    }
}
