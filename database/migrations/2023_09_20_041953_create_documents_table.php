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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classification_id')->constrained('classifications','id');
            $table->foreignId('department_id')->constrained('departments','id');
            $table->foreignId('document_type_id')->constrained('document_types','id');
            $table->foreignId('file_id')->constrained('files','id');
            $table->integer('document_unique_identifier')->unique();
            $table->integer('code')->unique();
            $table->foreignId('reference_id')->nullable()->constrained('documents','id');
            $table->string('reference')->nullable();
            $table->string('subject');
            $table->text('body');
            $table->foreignId('created_by')->constrained('users','userID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
