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
        Schema::create('mallposts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('deleted')->default(0);
            $table->boolean('blocked')->default(0);
            $table->tinyInteger('mallcategories_id')->nullable();
            $table->foreignId('users_id')->nullable()->index();
            $table->string('title', 500)->nullable();
            $table->text('description', 4000)->nullable();
            $table->string('price', 15)->nullable();
            $table->string('age', 15)->nullable();
            $table->enum('condition', ['used', 'new'])->nullable();
            $table->string('state', 40)->nullable();
            $table->string('city', 40)->nullable();
            $table->string('contact_name', 50)->nullable();
            $table->string('contact_address', 150)->nullable();
            $table->string('contact_phone', 20)->nullable();
            $table->string('contact_email', 50)->nullable();
            $table->integer('views')->default(0);
            $table->string('url_slug', 500)->nullable()->unique();
            $table->string('filename', 500)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mallposts');
    }
};
