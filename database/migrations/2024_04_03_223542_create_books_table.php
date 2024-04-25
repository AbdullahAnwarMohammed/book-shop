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
            $table->string("name_book")->nullable()->unique();
            $table->string("name_author")->nullable();
            $table->string("descrption")->nullable();
            $table->integer("quantity");
            $table->integer("price");
            $table->integer("tax")->nullable();
            $table->string("featured_image")->nullable();
            $table->enum("active",[0,1])->default(1);
            $table->integer('number_of_pages')->nullable();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
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
