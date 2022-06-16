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
            $table->unsignedInteger('year_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('institute_id')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('year_id')->references('id')->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('institute_id')->references('id')->on('institutes')
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
