<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DsiNomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dsi_nomenclador', function(Blueprint $table){
            $table->timestamps();
            $table->rename('nomenclator_sdi_requests');
        });

        \DB::statement("
            ALTER TABLE nomenclator_sdi_requests COMMENT 'SDI-Nomenclator many-to-many relationship.'");

        \DB::statement("
            ALTER TABLE nomenclator_sdi_requests
              CHANGE dsi_id sdi_id INT(11) COMMENT 'Identifier of the sdi request.'");

        \DB::statement("
            ALTER TABLE nomenclator_sdi_requests
              CHANGE nomenclador_id nomenclator_id INT(11) COMMENT 'Identifier of the nomenclator associated with the sdi request.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE nomenclator_sdi_requests
              CHANGE nomenclator_id nomenclador_id INT(11)");

        \DB::statement("
            ALTER TABLE nomenclator_sdi_requests
              CHANGE sdi_id dsi_id INT(11)");

        \DB::statement("
            ALTER TABLE nomenclator_sdi_requests");

        Schema::table('nomenclator_sdi_requests', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('dsi_nomenclador');
        });
    }
}
