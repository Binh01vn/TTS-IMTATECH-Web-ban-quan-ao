<?php

use App\Models\ColorAttributes;
use App\Models\Products;
use App\Models\SizeAttributes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Products::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(ColorAttributes::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(SizeAttributes::class)->constrained()->cascadeOnDelete();
            $table->bigInteger('price_default')->nullable();
            $table->bigInteger('price_sale')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
