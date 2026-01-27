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
        Schema::create('contactinfos', function (Blueprint $table) {
            $table->id();
            $table->string('call_now_title')->nullable();
            $table->string('call_now_number')->nullable();
            $table->string('call_photo')->nullable();
            $table->string('location_title')->nullable();
            $table->string('location_address')->nullable();
            $table->string('location_photo')->nullable();

            $table->string('email_title')->nullable();
            $table->string('email_address')->nullable();
            $table->string('email_photo')->nullable();

            $table->longText('google_map')->nullable();
            $table->string('main_photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactinfos');
    }
};
