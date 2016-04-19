<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnqueteurIdReponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enqueteur_id_reponse', function (Blueprint $table) {
            $table->increments('id');
            $table->string('champs1');
            $table->integer('champs2');
            $table->integer('champs3');
            $table->integer('champs4');
            $table->integer('champs5');
            $table->integer('champs6');
            $table->integer('enqueteur_id')->unsigned();
            $table->foreign('enqueteur_id')->references('id')->on('enqueteurs')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('enqueteur_id_reponse');
    }
}
