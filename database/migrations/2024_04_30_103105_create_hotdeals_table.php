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
        Schema::create('hotdeals', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('deal')->nullable();
            $table->string('brand')->nullable();
            $table->string('product_name')->nullable();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotdeals');
    }
};
