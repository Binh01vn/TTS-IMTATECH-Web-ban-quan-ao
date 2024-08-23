<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique()->comment('mã quản lý sản phẩm');
            $table->string('image_thumbnail')->nullable();
            $table->double('price_default', 15, 2)->nullable()->default(0);
            $table->double('price_sale', 15, 2)->nullable()->default(0);
            $table->integer('sale_percent')->nullable()->default(0);
            $table->string('description')->nullable()->comment('mô tả sản phẩm');
            $table->string('material')->nullable()->comment('chất liệu sản phẩm');
            $table->string('user_manual')->nullable()->comment('hướng dẫn sử dụng');

            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_new')->default(true);
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
