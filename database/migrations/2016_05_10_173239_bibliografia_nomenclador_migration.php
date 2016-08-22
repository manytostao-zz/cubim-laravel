<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BibliografiaNomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bibliografia_nomenclador', function(Blueprint $table){
            $table->timestamps();
            $table->rename('bibliography_request_nomenclators');
        });

        \DB::statement("
            ALTER TABLE bibliography_request_nomenclators COMMENT 'Bibliography-Nomenclator many-to-many relationship.'");

        \DB::statement("
            ALTER TABLE bibliography_request_nomenclators
              CHANGE bibliografia_id bibliography_id INT(11) COMMENT 'Identifier of the bibliography request.'");

        \DB::statement("
            ALTER TABLE bibliography_request_nomenclators
              CHANGE nomenclador_id nomenclator_id INT(11) COMMENT 'Identifier of the nomenclator associated with the bibliography request.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE bibliography_request_nomenclators
              CHANGE nomenclator_id nomenclador_id INT(11)");

        \DB::statement("
            ALTER TABLE bibliography_request_nomenclators
              CHANGE bibliography_id bibliografia_id INT(11)");

        \DB::statement("
            ALTER TABLE bibliography_request_nomenclators");

        Schema::table('bibliography_request_nomenclators', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('bibliografia_nomenclador');
        });
    }
}
