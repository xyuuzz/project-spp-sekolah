<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users", "id")->cascadeOnDelete();
//            $table->foreignId("class_id")->constrained("school_classes")->cascadeOnDelete();
            $table->string("nisn")->unique();
            $table->string("nis")->unique();
            $table->integer("no_absen");
            $table->string("photo_profile")->default("dafult.png");
//            $table->string("address");
//            $table->string("number_phone")->unique();
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
        Schema::dropIfExists('profiles');
    }
}
