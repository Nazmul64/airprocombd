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
        Schema::create('solutionsub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('subcategory_name');
            $table->string('subcategory_slug')->unique(); // unique constraint
            $table->unsignedBigInteger('category_id');   // foreign key
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solutionsub_categories');
    }
};
