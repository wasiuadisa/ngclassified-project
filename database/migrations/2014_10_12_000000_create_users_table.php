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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('banned')->default(0);
            $table->boolean('suspended')->default(0);
            $table->boolean('deactivated')->default(0);
            $table->string('username', 50)->unique()->nullable();
            $table->string('firstname', 30)->nullable();
            $table->string('middlename', 30)->nullable();
            $table->string('surname', 30)->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('profileimage')->nullable()->default('profile.png');
            $table->unsignedTinyInteger('privilege')->default(1);
            $table->enum('role', ['Member', 'Vetted Member', 'Contributor', 'Supervisor', 'Moderator', 'Administrator'])->default('Member');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
