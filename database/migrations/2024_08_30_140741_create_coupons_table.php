<?php

use App\Models\Coupons;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->text('description')->nullable();
            $table->enum('discount_type', [Coupons::TYPE_FIXED, Coupons::TYPE_PERCENT])->default(Coupons::TYPE_FIXED)->comment('fixed: ưu đãi cố định, percent: ưu đãi phần trăm');
            $table->double('discount_amount', 10, 2)->default(0);
            $table->bigInteger('usage_limit')->default(0);
            $table->bigInteger('used_count')->default(0);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->double('minimum_spend', 10, 2)->nullable()->default(0);
            $table->double('maximum_spend', 10, 2)->nullable()->default(0);
            $table->boolean('individual_use')->default(false)->comment('Chỉ dùng một mã duy nhất -không kết hợp với mã khác-');
            $table->boolean('exclude_sale_items')->default(false)->comment('Loại trừ các sản phẩm đang giảm giá');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
