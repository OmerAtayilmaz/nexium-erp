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
        Schema::create('pages', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->string('keywords');
            $table->string('description');
            $table->string('slug');
            $table->string('featured_image');
            $table->longText('content');
            $table->enum('status',['a','i','d']);
            $table->unsignedBigInteger('category_id')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
