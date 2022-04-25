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
            $table->id();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->string('institute_name');
            $table->string('department');
            $table->string('semester');
            $table->date('dob');
            $table->enum('gender',['male','female']);
            $table->string('student_id');
            $table->string('year');
            $table->string('mobile_no');
            $table->string('emergency_contact');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->enum('is_active',[0,1])->default(0);
            $table->string('device_token')->nullable();
            $table->string('device_type')->nullable();
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
        Schema::dropIfExists('students');
    }
}
