<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artist_id')->constrained('artists')->nullable();
            $table->foreignId('venue_id')->constrained('venues')->nullable();
            $table->foreignId('author_id')->constrained('users')->nullable();
            $table->string('topic');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_accept')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
