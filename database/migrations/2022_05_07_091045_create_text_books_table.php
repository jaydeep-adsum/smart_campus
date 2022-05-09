<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('written_by');
            $table->text('description');
            $table->string('year');
            $table->unsignedInteger('stream_id');
            $table->timestamps();

            $table->foreign('stream_id')->references('id')->on('streams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('text_books');
    }
}
