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
        Schema::create('mallimages', function (Blueprint $table) {
            $table->id();
            $table->boolean('deleted')->default(0);
            $table->boolean('blocked')->default(0);
            $table->bigInteger('mallposts_id')->nullable();
            $table->string('caption', 50)->nullable();
            $table->string('filename', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mallimages');
    }
};
