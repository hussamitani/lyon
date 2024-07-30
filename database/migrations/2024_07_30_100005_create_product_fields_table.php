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
        Schema::create('product_fields', function (Blueprint $table) {
            $table->id();
            $table->char('name', 144);
            $table->string('description')->nullable();
            $table->foreignId('family_id')
                ->constrained()
                ->references('id')
                ->on('families')
                ->onDelete('cascade');
            $table->string('field_type');
            $table->json('field_options')->nullable();
            $table->boolean('required')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_configurations');
    }
};
