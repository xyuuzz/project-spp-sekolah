<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChangeDataProfileStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_data_profile_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->string("name");
            $table->string("gender");
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->foreignId("class_id")->constrained("school_classes");
            $table->string("nisn")->unique();
            $table->string("nis")->unique();
            $table->string("photo_profile")->nullable();
            $table->string("number_phone")->unique();
            $table->integer("status")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('change_data_profile_students');
    }
}
