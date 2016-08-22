<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModalidadDetalleMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('modalidad_detalle', function (Blueprint $table) {
            $table->timestamps();
            $table->rename('reading_service_mode_details');
        });

        \DB::statement("
            ALTER TABLE reading_service_mode_details COMMENT 'Details of the reading service mode.'");

        \DB::statement("
            ALTER TABLE reading_service_mode_details
              CHANGE detalle detail VARCHAR(255) COMMENT 'Detail of the reading service mode.'");

        \DB::statement("
            ALTER TABLE reading_service_mode_details
              CHANGE tipo type VARCHAR(255) COMMENT 'Type of the detail.'");

        \DB::statement("
            ALTER TABLE reading_service_mode_details
              CHANGE lecturaModalidad_id reading_service_mode_id INT(11) COMMENT 'Identifier of the reading service mode.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE reading_service_mode_details
              CHANGE reading_service_mode_id lecturaModalidad_id INT(11)");

        \DB::statement("
            ALTER TABLE reading_service_mode_details
              CHANGE type tipo VARCHAR(255)");

        \DB::statement("
            ALTER TABLE reading_service_mode_details
              CHANGE detail detalle VARCHAR(255)");

        \DB::statement("
            ALTER TABLE reading_service_mode_details");

        Schema::table('reading_service_mode_details', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->rename('modalidad_detalle');
        });
    }
}
