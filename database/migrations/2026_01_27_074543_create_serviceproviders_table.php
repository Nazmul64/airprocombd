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
        Schema::create('serviceproviders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('side', ['left', 'right']);
            $table->integer('order')->default(0); // Order for sorting
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serviceproviders');
    }
};
