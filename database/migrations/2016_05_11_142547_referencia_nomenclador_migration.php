<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReferenciaNomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referencia_nomenclador', function(Blueprint $table){
            $table->timestamps();
            $table->rename('nomenclator_reference_requests');
        });

        \DB::statement("
            ALTER TABLE nomenclator_reference_requests COMMENT 'Reference-Nomenclator many-to-many relationship.'");

        \DB::statement("
            ALTER TABLE nomenclator_reference_requests
              CHANGE referencia_id reference_request_id INT(11) COMMENT 'Identifier of the reference request.'");

        \DB::statement("
            ALTER TABLE nomenclator_reference_requests
              CHANGE nomenclador_id nomenclator_id INT(11) COMMENT 'Identifier of the nomenclator associated with the reference request.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE nomenclator_reference_requests
              CHANGE nomenclator_id nomenclador_id INT(11)");

        \DB::statement("
            ALTER TABLE nomenclator_reference_requests
              CHANGE reference_request_id referencia_id INT(11)");

        \DB::statement("
            ALTER TABLE nomenclator_reference_requests");

        Schema::table('nomenclator_reference_requests', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('referencia_nomenclador');
        });
    }
}
