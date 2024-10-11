<?php

use App\Models\ColorAttribute;
use App\Models\ProductVariant;
use App\Models\SizeAttribute;
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
        Schema::create('variant_values', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProductVariant::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(ColorAttribute::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(SizeAttribute::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('color_value');
            $table->string('size_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_values');
    }
};
