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
        Schema::create('doc_reads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('document_id')->constrained('documents','id');
            $table->foreignId('userID')->constrained('users','userID');
            $table->foreignId('department_id')->constrained('departments','id');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_reads');

    }
};
