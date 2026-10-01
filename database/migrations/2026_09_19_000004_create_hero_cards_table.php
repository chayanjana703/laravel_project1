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
        Schema::create('hero_cards', function (Blueprint $table) {
            $table->id();
            $table->string('section')->default('hero_carousel'); // 'hero_carousel', 'flash_sale', 'exclusive_release'
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('badge')->nullable(); // e.g. "FLASHSALE 50% OFF", "Hot Pick", "EXCLUSIVE RELEASE"
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->string('rating')->default('4.9');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_cards');
    }
};
