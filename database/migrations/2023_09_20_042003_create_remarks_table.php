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
        Schema::create('remarks', function (Blueprint $table) {
            $table->id();
            $table->string('remark')->nullable();
            $table->string('recommendation')->nullable();
            $table->foreignId('userID')->constrained('users','userID');
            $table->foreignId('document_id')->constrained('documents','id');
            $table->foreignId('toUserID')->constrained('users','userID');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remarks');
    }
};
