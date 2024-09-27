<?php

use App\Models\ColorAttribute;
use App\Models\Product;
use App\Models\SizeAttribute;
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
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(ColorAttribute::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(SizeAttribute::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('sku')->unique()->comment('mã sản phẩm biến thể');
            $table->double('price_default', 15, 2)->nullable()->default(0);
            $table->double('price_sale', 15, 2)->nullable()->default(0);
            $table->dateTime('start_date')->nullable()->comment('ngày bắt đầu khuyến mại');
            $table->dateTime('end_date')->nullable()->comment('ngày kết thúc khuyến mại');
            $table->integer('quantity')->default(0);
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
