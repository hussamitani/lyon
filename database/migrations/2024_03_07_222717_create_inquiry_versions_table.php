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
        Schema::create('inquiries_versions', function (Blueprint $table) {
            $table->foreignId('inquiry_id')->constrained()->references('id')->on('inquiries')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->references('id')->on('patients')->onDelete('cascade');
            $table->foreignId('type_id')->constrained()->references('id')->on('inquiries_types');
            $table->string('subject', 255);
            $table->string('description', 255);

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users');

            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('updated_by_id')->references('id')->on('users');

            $table->unsignedBigInteger('deleted_by_id')->nullable();
            $table->foreign('deleted_by_id')->references('id')->on('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiries_versions');
    }
};
