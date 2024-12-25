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
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('short_description')->nullable();
            $table->string('description')->nullable();
            $table->double('regular_price')->nullable();
            $table->double('sale_price')->nullable();
            $table->string('sku')->nullable();
            $table->string('stock')->nullable();
            $table->string('featured')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('main_image')->nullable();
            $table->string('aux_image')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('category')->nullable();
            $table->string('model')->nullable();
            $table->integer('reorder_level')->nullable();
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('brand')->nullable();
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            $table->string('supplier')->nullable();
            $table->timestamps();
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
