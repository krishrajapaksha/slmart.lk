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
        Schema::create('review_ratings', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->text('comment')->nullable();
            $table->integer('star_rating')->nullable();
            $table->string('user_id');
            $table->enum('status', ['active', 'deactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_ratings');
    }
};
