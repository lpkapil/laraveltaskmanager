<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('product_image');
            $table->unsignedInteger('product_category_id');
            $table->string('product_name');
            $table->float('product_mrp');
            $table->float('product_price');
            $table->string('product_quantity');
            $table->string('product_quantity_type');
            $table->text('product_description');
            $table->tinyInteger('product_status');
            $table->timestamps();

            //FOREIGN KEY CONSTRAINTS
            $table->foreign('product_category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
