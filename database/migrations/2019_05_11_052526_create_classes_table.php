<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('deskripsi');
            $table->string('slug');
            $table->string('img');
            $table->string('video');
            $table->string('alamat_kursus')->nullable();
            $table->integer("harga");
            $table->integer("jml_jam");
            $table->unsignedBigInteger('talent_id');
            $table->foreign('talent_id')
                    ->references('id')->on('talents')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('mentor_id');
            $table->foreign('mentor_id')
                    ->references('id')->on('mentors')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('classes');
    }
}
