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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('product_slug')->unique();
            $table->text('product_description')->nullable();
            $table->text('brand')->nullable();
            $table->text('country')->nullable();
            $table->text('origin')->nullable();
            $table->text('category_id')->nullable();
            $table->text('subcategory_id')->nullable();
            $table->text('product_image')->nullable();
            $table->text('multi_image')->nullable();
            $table->text('company_details')->nullable();
            $table->text('button_title')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
