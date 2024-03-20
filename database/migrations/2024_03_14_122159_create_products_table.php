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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->tinyText('meta_description')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->float('price')->nullable();
//            $table->enum('discount_type', ['amount,percentage']);
            $table->float('discount_value')->nullable();
            $table->json('images')->nullable();
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
