<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nomenclador', function (Blueprint $table) {
            $table->timestamps();
            $table->rename('nomenclators');
        });

        \DB::statement("
            ALTER TABLE nomenclators COMMENT 'Nomenclators.'");

        \DB::statement("
            ALTER TABLE nomenclators
              CHANGE tiponom_id nomenclator_type_id INT(11) COMMENT 'Identifier of the nomenclator type.'");

        \DB::statement("
            ALTER TABLE nomenclators
              CHANGE descripcion description VARCHAR(255) COMMENT 'Description of the nomenclator.'");

        \DB::statement("
            ALTER TABLE nomenclators
              CHANGE activo active TINYINT(1) COMMENT 'If the nomenclator is active.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE nomenclators
              CHANGE active activo TINYINT(1)");

        \DB::statement("
            ALTER TABLE nomenclators
              CHANGE description descripcion VARCHAR(255)");

        \DB::statement("
            ALTER TABLE nomenclators
              CHANGE nomenclator_type_id tiponom_id INT(11)");

        \DB::statement("
            ALTER TABLE nomenclators");

        Schema::table('nomenclators', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->rename('nomenclador');
        });
    }
}
