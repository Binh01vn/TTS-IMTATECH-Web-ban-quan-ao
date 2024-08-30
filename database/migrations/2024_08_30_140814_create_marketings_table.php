<?php

use App\Models\Marketing;
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
        Schema::create('marketings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('slug', 150);
            $table->text('description')->nullable();
            $table->enum('status', [Marketing::STATUS_ACTIVE, Marketing::STATUS_ARCHIVED, Marketing::STATUS_DRAFT])->default(Marketing::STATUS_ACTIVE);
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketings');
    }
};
