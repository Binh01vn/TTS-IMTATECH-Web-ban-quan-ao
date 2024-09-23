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
            $table->string('slug');
            $table->string('sku')->unique()->comment('mã quản lý sản phẩm');
            $table->string('image_thumbnail')->nullable();
            $table->double('price_default', 15, 2)->nullable()->default(0);
            $table->double('price_sale', 15, 2)->nullable()->default(0);
            $table->integer('sale_percent')->nullable()->default(0);
            $table->date('start_date')->nullable()->comment('ngày bắt đầu khuyến mại');
            $table->date('end_date')->nullable()->comment('ngày kết thúc khuyến mại');
            $table->text('description')->nullable()->comment('mô tả sản phẩm');
            $table->text('material')->nullable()->comment('chất liệu sản phẩm');
            $table->text('user_manual')->nullable()->comment('hướng dẫn sử dụng');
            $table->bigInteger('quantity')->nullable()->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
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
