<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_relationships', function (Blueprint $table) {
            $table->id();
            $table->foreignId("class_id")->constrained("school_classes")->cascadeOnDelete();
            $table->integer("referensi_id");
            $table->string("referensi_type");
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
        Schema::dropIfExists('class_relationships');
    }
}
