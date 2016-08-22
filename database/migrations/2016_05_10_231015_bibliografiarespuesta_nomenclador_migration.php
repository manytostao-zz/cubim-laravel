<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BibliografiarespuestaNomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bibliografiarespuesta_nomenclador', function(Blueprint $table){
            $table->timestamps();
            $table->rename('bibliography_request_answer_nomenclators');
        });

        \DB::statement("
            ALTER TABLE bibliography_request_answer_nomenclators COMMENT 'Bibliography-Answer-Nomenclator many-to-many relationship.'");

        \DB::statement("
            ALTER TABLE bibliography_request_answer_nomenclators
              CHANGE bibliografiarespuesta_id bibliography_answer_id INT(11) COMMENT 'Identifier of the bibliography answer.'");

        \DB::statement("
            ALTER TABLE bibliography_request_answer_nomenclators
              CHANGE nomenclador_id nomenclator_id INT(11) COMMENT 'Identifier of the nomenclator associated with the bibliography answer.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE bibliography_request_answer_nomenclators
              CHANGE nomenclator_id nomenclador_id INT(11)");

        \DB::statement("
            ALTER TABLE bibliography_request_answer_nomenclators
              CHANGE bibliography_answer_id bibliografiarespuesta_id INT(11)");

        \DB::statement("
            ALTER TABLE bibliography_request_answer_nomenclators");

        Schema::table('bibliography_request_answer_nomenclators', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('bibliografiarespuesta_nomenclador');
        });
    }
}
