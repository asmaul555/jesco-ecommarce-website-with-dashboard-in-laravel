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
            $table->id();
            $table->string('product_name');
            $table->integer('old_price')->nullable(true);
            $table->integer('new_price');
            $table->text('short_description');
            $table->text('long_description');
            $table->string('product_image')->nullable(true);
            $table->string('product_slug');
            $table->string('product_sku');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('added_by');
            $table->integer('deleted_by')->nullable(true);
            $table->softDeletes();
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
