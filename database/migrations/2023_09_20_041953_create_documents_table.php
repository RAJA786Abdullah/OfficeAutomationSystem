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
            $table->integer('documentID')->nullable();
            $table->foreignId('classification_id')->constrained('classifications','id');
            $table->foreignId('department_id')->constrained('departments','id');
            $table->foreignId('document_type_id')->constrained('document_types','id');
            $table->foreignId('file_id')->constrained('files','id');
            $table->integer('document_unique_identifier');
            $table->integer('code')->nullable();
            $table->foreignId('reference_id')->nullable()->constrained('documents','id');
            $table->string('reference')->nullable();
            $table->foreignId('in_dept')->nullable()->constrained('users','userID');
            $table->foreignId('out_dept')->nullable()->constrained('users','userID');
            $table->string('subject');
            $table->text('body');
            $table->integer('signing_authority_id');
            $table->foreignId('created_by')->constrained('users','userID');
            $table->boolean('is_draft')->default(1);
            $table->boolean('is_new')->default(1);
            $table->boolean('is_allDte')->nullable();
            $table->boolean('is_archived')->default(0);
            $table->string('archived_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
