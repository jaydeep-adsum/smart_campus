<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->unsignedInteger('institute_id');
            $table->unsignedInteger('department_id');
            $table->unsignedInteger('semester_id');
            $table->date('dob');
            $table->enum('gender',['male','female']);
            $table->string('student_id');
            $table->unsignedInteger('year_id');
            $table->string('mobile_no');
            $table->string('emergency_contact');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->enum('is_active',[0,1])->default(0);
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
            $table->timestamps();

            $table->foreign('semester_id')->references('id')->on('semesters')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('year_id')->references('id')->on('years')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('institute_id')->references('id')->on('institutes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('department_id')->references('id')->on('departments')
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
        Schema::dropIfExists('students');
    }
}
