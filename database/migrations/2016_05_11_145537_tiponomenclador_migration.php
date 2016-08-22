<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TiponomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tiponomenclador', function(Blueprint $table){
            $table->timestamps();
            $table->rename('nomenclator_types');
        });

        \DB::statement("
            ALTER TABLE nomenclator_types COMMENT 'Nomenclator types.'");

        \DB::statement("
            ALTER TABLE nomenclator_types
              CHANGE descripcion description VARCHAR(255) COMMENT 'Description of the nomenclator type.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE nomenclator_types
              CHANGE description descripcion VARCHAR(255)");

        \DB::statement("
            ALTER TABLE nomenclator_types");

        Schema::table('nomenclator_types', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('tiponomenclador');
        });
    }
}
