<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnqueteurProjetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enqueteur_projet', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('enqueteur_id')->unsigned();
            $table->foreign('enqueteur_id')->references('id')->on('enqueteurs')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('projet_id')->unsigned();
            $table->foreign('projet_id')->references('id')->on('projets')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('enqueteur_projet');
    }
}
