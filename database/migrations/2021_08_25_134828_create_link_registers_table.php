<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId("class_id")->constrained("school_classes")->cascadeOnDelete();
            $table->string("role");
            $table->date("valid_from");
            $table->date("valid_until");
            $table->string("link")->default(uniqid());
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
        Schema::dropIfExists('link_registers');
    }
}
