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
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('users_id')->nullable()->index();
            $table->string('security_question')->nullable();
            $table->string('security_answer')->nullable();
            $table->string('date_of_birth', 10)->nullable();//dd-mm-yyyy
            $table->enum('gender', ['male','female'])->nullable();
            $table->string('state', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('postcode', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('about_me')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('religion', 20)->nullable();
            $table->enum('religious_level', ['very religious', 'moderately religious','a little religious', 'not religious'])->nullable();
            $table->bigInteger('view_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
