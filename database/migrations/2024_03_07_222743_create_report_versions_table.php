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
        Schema::create('reports_versions', function (Blueprint $table) {
            $table->foreignId('report_id')->constrained()->references('id')->on('reports')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained()->references('id')->on('patients')->onDelete('cascade');
            $table->string('subject');
            $table->string('diagnosis')->nullable();
            $table->string('treatment')->nullable();
            $table->text('files')->nullable();

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
        Schema::dropIfExists('reports_versions');
    }
};
