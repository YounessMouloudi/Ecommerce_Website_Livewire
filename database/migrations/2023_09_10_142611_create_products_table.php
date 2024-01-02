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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->unsignedBigInteger('categorie_id');

            $table->mediumText('small_description')->nullable();
            $table->longText('description')->nullable();
            $table->integer('original_price');
            $table->integer('selling_price');
            $table->integer('quantity');

            $table->tinyInteger('trending')->default('0')->comment('1 = trending , 0 = not-trending');
            $table->tinyInteger('featured')->default('0')->comment('1 = featured , 0 = not-featured');
            $table->tinyInteger('status')->default('0')->comment('1 = hidden , 0 = visible');

            $table->string('meta_title')->nullable();
            $table->mediumText('meta_keyword')->nullable();
            $table->mediumText('meta_description')->nullable();

            $table->foreign('categorie_id')->references('id')->on('categories')->cascadeOnDelete();
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
