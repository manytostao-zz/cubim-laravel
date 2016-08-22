<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DsiMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dsi', function (Blueprint $table) {
            $table->timestamps();
            $table->timestamp('answered_at')->nullable();
            $table->rename('sdi_requests');
        });

        \DB::statement("
            ALTER TABLE sdi_requests COMMENT 'Selective Disemmination of the Information (SDI) requests.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE usuario_id customer_id INT(11) COMMENT 'Identifier of the customer that made the sdi request.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE pregunta question VARCHAR(255) COMMENT 'Question of the sdi request.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE respuesta answer VARCHAR(255) COMMENT 'Answer of the sdi request.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE documento document TINYINT(1) COMMENT 'If the answer is of type document.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE referencia reference TINYINT(1) COMMENT 'If the answer is of type reference.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE verbal verbal TINYINT(1) COMMENT 'If the answer is of type verbal.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE name attachment_name VARCHAR(255) COMMENT 'Attachment name associated to the sdi answer.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE path attachment_path TINYTEXT COMMENT 'Attachment path associated to the sdi answer.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE appUser_id user_id INT(11) COMMENT 'Identifier of the user that made the sdi answer.'");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE viaSolicitud_id request_via_id INT(11) COMMENT 'Identifier of the via by which the request was made.'");

        \DB::statement("
            UPDATE sdi_requests
              SET created_at = fechaSolicitud");

        \DB::statement("
            UPDATE sdi_requests
              SET answered_at = fechaRespuesta");

        Schema::table('sdi_requests', function (Blueprint $table) {
            $table->dropColumn('fechaSolicitud');
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
        Schema::table('sdi_requests', function (Blueprint $table) {
            $table->dateTime('fechaSolicitud');
            $table->dateTime('fechaRespuesta');
        });

        \DB::statement("
            UPDATE sdi_requests
              SET fechaRespuesta = answered_at");

        \DB::statement("
            UPDATE sdi_requests
              SET fechaSolicitud = created_at");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE request_via_id viaSolicitud_id INT(11)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE user_id appUser_id INT(11)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE attachment_path path TINYTEXT");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE attachment_name name VARCHAR(255)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE verbal verbal TINYINT(1)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE reference referencia TINYINT(1)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE document documento TINYINT(1)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE answer respuesta VARCHAR(255)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE question pregunta VARCHAR(255)");

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE customer_id usuario_id INT(11)");

        \DB::statement("
            ALTER TABLE sdi_requests");

        Schema::table('sdi_requests', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropColumn('answered_at');
            $table->rename('dsi');
        });
    }
}
