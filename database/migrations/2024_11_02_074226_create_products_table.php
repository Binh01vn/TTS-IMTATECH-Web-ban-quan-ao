<?php

use App\Models\Categories;
use App\Models\Categorization;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Categorization::class)->nullable()->constrained();
            $table->foreignIdFor(Categories::class)->nullable()->constrained();
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('sku')->unique();
            $table->string('product_avatar');
            $table->bigInteger('price_default');
            $table->bigInteger('price_sale')->nullable();
            $table->integer('discount_percent')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('description')->nullable();
            $table->text('material')->nullable();
            $table->text('user_manual')->nullable();
            $table->bigInteger('quantity')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->boolean('status')->default(1);
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
