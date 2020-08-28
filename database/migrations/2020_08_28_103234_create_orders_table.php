<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('store_id');
            $table->unsignedInteger('user_id');
            $table->string('status');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('customer_address');
            $table->string('customer_pincode');
            $table->string('customer_city');
            $table->string('items_count');
            $table->string('payment_method');
            $table->string('subtotal');
            $table->string('delivery_charge');
            $table->string('grand_total');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
