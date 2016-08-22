<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNomencladorUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("SET foreign_key_checks = 0");

        Schema::create('customer_nomenclators', function (Blueprint $table) {
            $table->integer('nomenclator_id');
            $table->foreign('nomenclator_id')->references('id')->on('nomenclador')->onDelete('restrict');
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('id')->on('usuario')->onDelete('restrict');
            $table->timestamps();
        });

        \DB::statement("SET foreign_key_checks = 1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customer_nomenclators');
    }
}
