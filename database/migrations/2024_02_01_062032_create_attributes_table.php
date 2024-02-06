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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name')->nullable();
            $table->enum('type',['select','multi_select','radio','text_box','text_area'])->nullable();
            $table->unsignedInteger('priority')->nullable();
            $table->tinyInteger('has_default_value')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->boolean('is_filterable')->default(0);
            $table->boolean('is_required')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
