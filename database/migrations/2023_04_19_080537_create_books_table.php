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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('writer_id')->nullable()->constrained('writers')->nullOnDelete();
            $table->foreignId('publisher_id')->nullable()->constrained('publishers')->nullOnDelete();
            $table->foreignId('translator_id')->nullable()->constrained('translators')->nullOnDelete();
            $table->string('code')->unique();
            $table->string('name');
            $table->integer('price')->default(0);
            $table->string('thumbline')->default('https://fakeimg.pl/320x220/');
            $table->string('image')->default('https://fakeimg.pl/320/');
            $table->integer('like')->default(0);
            $table->integer('quantity')->default(0);
            $table->enum('inventoryStatus', ['INSTOCK', 'LOWSTOCK', 'OUTOFSTOCK'])->default('OUTOFSTOCK');
            $table->integer('rating')->default(0);
            $table->enum('language', ['persain', 'english', 'arabic'])->nullable()->default('persain');
            $table->string('voice')->nullable();
            $table->string('file')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('subject')->nullable();
            $table->string('skin')->nullable();
            $table->string('format')->nullable();
            $table->integer('pages')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
