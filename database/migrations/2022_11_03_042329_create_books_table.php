<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
//            $table->foreignId('author_id');
            $table->foreignId('category_id');
            $table->foreignId('shelf_id');
//            $table->foreignId('user_id');
//            $table->foreignId('order_id');
            $table->string('image_path');
            $table->integer('number_of_pages');
            $table->boolean('is_digit')->default(FALSE);
            $table->string('book_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
