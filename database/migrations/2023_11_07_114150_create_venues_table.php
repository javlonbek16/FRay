<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration
{

    public function up(): void
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->id();
            $table->string('venue_name')->unique();
            $table->string('city_state');
            $table->string('address');
            $table->string('phone');
            $table->string('facebook_link');
            $table->string('image');
            $table->string('website_link');
            $table->boolean('looking_for_talent');
            $table->foreignId('genres_id')->constrained('genres');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('venues');
    }
}
