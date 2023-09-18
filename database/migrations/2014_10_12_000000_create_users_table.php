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
            $table->id('userID');
            $table->foreignId('userTypeID')->constrained('userType','userTypeID');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->timestamp('lastLogin')->nullable();
            $table->integer('statusID')->unsigned()->default(1);
            $table->ipAddress('lastLoginIP')->nullable();
            $table->timestamp('emailVerifiedAt')->nullable();
            $table->string('password');
            $table->string('rememberToken')->nullable();
            $table->timestamp('dateCreated')->useCurrent();
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
