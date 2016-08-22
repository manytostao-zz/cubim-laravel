<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BibliografiaRespuestaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bibliografia_respuesta', function(Blueprint $table){
            $table->timestamps();
            $table->dropForeign('FK_EAF6F5FEFCC176CE');
            $table->rename('answer_bibliography_requests');
        });

        \DB::statement("
            ALTER TABLE answer_bibliography_requests COMMENT 'Bibliography Answers.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE bibliografia_id bibliography_request_id INT(11) NOT NULL COMMENT 'Identifier of the bibliography request.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE descriptores descriptors VARCHAR(255) NOT NULL COMMENT 'Descriptors used when building the answer.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE citasRelevantes relevant_quotes INT(11) NOT NULL COMMENT 'Number of relevant quotes in answer.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE citasPertinentes pertinent_quotes INT(11) NOT NULL COMMENT 'Number of pertinent quotes in answer.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE citas quotes LONGTEXT NOT NULL COMMENT 'Answer quotes.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE observaciones comments VARCHAR(255) COMMENT 'Comments on the bibliography answer.'");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE appUser_id user_id INT(11) COMMENT 'Identifier of the user that made the bibliography request answer.'");

        \DB::statement("
            UPDATE answer_bibliography_requests SET created_at = fechaRespuesta");

        Schema::table('answer_bibliography_requests', function(Blueprint $table){
            $table->dropColumn('fechaRespuesta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answer_bibliography_requests', function(Blueprint $table){
            $table->dateTime('fechaRespuesta');
        });

        \DB::statement("
            UPDATE answer_bibliography_requests SET fechaRespuesta = created_at");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE user_id appUser_id INT(11)");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE comments observaciones VARCHAR(255)");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE quotes citas LONGTEXT NOT NULL");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE pertinent_quotes citasPertinentes INT(11) NOT NULL");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE relevant_quotes citasRelevantes INT(11) NOT NULL");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE descriptors descriptores VARCHAR(255) NOT NULL");

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE bibliography_request_id bibliografia_id INT(11) NOT NULL");

        Schema::table('answer_bibliography_requests', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('bibliografia_respuesta');
        });
    }
}
