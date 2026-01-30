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
        Schema::create('workreferencecs', function (Blueprint $table) {
            $table->id();
            $table->string('work_image')->nullable();
            $table->text('work_title')->nullable();
            $table->text('work_slug')->unique();
            $table->text('work_content')->nullable();
            $table->unsignedBigInteger('work_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workreferencecs');
    }
};
