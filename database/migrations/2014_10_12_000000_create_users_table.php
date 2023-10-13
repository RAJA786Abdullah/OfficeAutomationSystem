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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('lastLogin')->nullable();
            $table->integer('status')->default(1);
            $table->ipAddress('lastLoginIP')->nullable();
            $table->string('password');
            $table->foreignId('department_id')->constrained('departments','id');
            $table->foreignId('branch_id')->constrained('branches','id');
            $table->boolean('is_signing_authority')->default(0);
            $table->string('arm_designation')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
