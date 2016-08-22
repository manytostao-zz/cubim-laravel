<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BibliografiaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bibliografia', function(Blueprint $table){
            $table->timestamps();
            $table->rename('bibliography_requests');
        });

        \DB::statement("
            ALTER TABLE bibliography_requests COMMENT 'Bibliography requests.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE usuario_id customer_id INT(11) COMMENT 'Identifier of the customer that made the bibliography request.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE motivo_id motive_id INT(11) COMMENT 'Identifier of the motive by which the customer made the bibliography request.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE estilo_id style_id INT(11) COMMENT 'Identifier of the bibliographic style requested.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE tema topic VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Topic of the search to be performed.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE fechaDesde since_year INT(11) NOT NULL COMMENT 'Starting year of the search to be performed.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE fechaHasta to_year INT(11) NOT NULL COMMENT 'Ending year of the search to be performed.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE appUser_id user_id INT(11) COMMENT 'Identifier of the specialist following the request.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE autoservicio self_service TINYINT(1) COMMENT 'If the request was made by the Self-Service option.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE referencia reference TINYINT(1) COMMENT 'If the request was made by the Reference option.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE dsi sdi TINYINT(1) COMMENT 'If the request was made by the Selective Dissemination of the Information (SDI) option.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              MODIFY created_at TIMESTAMP COMMENT 'The date on which the request was created.'");

        \DB::statement("
            ALTER TABLE bibliography_requests
              MODIFY updated_at TIMESTAMP COMMENT 'The date on which the request was updated.'");

        \DB::statement("
            UPDATE bibliography_requests
              SET created_at = fechaSolicitud");

        Schema::table('bibliography_requests', function(Blueprint $table){
            $table->dropColumn('fechaSolicitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bibliography_requests', function(Blueprint $table){
            $table->dateTime('fechaSolicitud');
        });

        \DB::statement('
            UPDATE bibliography_requests
              SET fechaSolicitud = created_at');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE sdi dsi TINYINT(1)');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE reference referencia TINYINT(1)');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE self_service autoservicio TINYINT(1)');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE user_id appUser_id INT(11)');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE to_year fechaHasta INT(11) NOT NULL');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE since_year fechaDesde INT(11) NOT NULL');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE topic tema VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE style_id estilo_id INT(11)');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE motive_id motivo_id INT(11)');

        \DB::statement('
            ALTER TABLE bibliography_requests
              CHANGE customer_id usuario_id INT(11)');

        Schema::table('bibliography_requests', function(Blueprint $table){
            $table->dropTimestamps();
            $table->rename('bibliografia');
        });
    }
}
