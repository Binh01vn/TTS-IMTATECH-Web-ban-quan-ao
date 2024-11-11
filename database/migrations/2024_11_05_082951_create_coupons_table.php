<?php

use App\Models\Coupons;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->enum('discount_type', [Coupons::DISCOUNT_TYPE]);
            $table->bigInteger('discount_amount')->comment('Giá trị');
            $table->bigInteger('minimum_spend')->comment('chi tiêu tối thiểu');
            $table->bigInteger('maximum_spend')->comment('chi tiêu tối đa');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('quantity');
            $table->integer('quantity_received')->comment('số lượng đã nhận')->default(0);
            $table->integer('quantity_used')->comment('số lượng đã sử dụng')->default(0);
            $table->boolean('status_coupon')->default(1);
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
