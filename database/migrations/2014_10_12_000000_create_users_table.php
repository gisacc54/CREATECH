<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number')->unique();
            $table->string('email')->unique()->nullable();
            $table->enum('gender',['Male','Female']);
            $table->string('dob');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status',['Active','Disabled'])->default('Active');
            $table->string('profile_image')->default('/upload/profile/image/default/default.jpg');
            $table->string('profile_image_thumbnail')->default('/upload/profile/image/default/default.jpg');
            $table->string('password');
            $table->unsignedBigInteger('role_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
