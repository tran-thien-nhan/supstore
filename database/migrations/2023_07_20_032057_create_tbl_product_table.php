<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->id('product_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('product_name');
            $table->integer('product_quantity');
            $table->text('product_desc');
            $table->text('product_content');
            $table->string('product_price');
            $table->integer('product_discount');
            $table->string('product_image');
            $table->string('product_flavour');
            $table->integer('product_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_product');
    }
};
