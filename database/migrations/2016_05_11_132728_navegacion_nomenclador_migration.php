<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NavegacionNomencladorMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navegacion_nomenclador', function (Blueprint $table) {
            $table->timestamps();
            $table->rename('internet_browsing_service_nomenclators');
        });

        \DB::statement("
            ALTER TABLE internet_browsing_service_nomenclators COMMENT 'Internet browsing service-Nomenclator many-to-many relationship.'");

        \DB::statement("
            ALTER TABLE internet_browsing_service_nomenclators
              CHANGE navegacion_id internet_browsing_service_id INT(11) COMMENT 'Identifier of the internet browsing service request.'");

        \DB::statement("
            ALTER TABLE internet_browsing_service_nomenclators
              CHANGE nomenclador_id nomenclator_id INT(11) COMMENT 'Identifier of the nomenclator associated with the internet browsing service request.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE internet_browsing_service_nomenclators
              CHANGE nomenclator_id nomenclador_id INT(11)");

        \DB::statement("
            ALTER TABLE internet_browsing_service_nomenclators
              CHANGE internet_browsing_service_id navegacion_id INT(11)");

        \DB::statement("
            ALTER TABLE internet_browsing_service_nomenclators");

        Schema::table('internet_browsing_service_nomenclators', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->rename('navegacion_nomenclador');
        });
    }
}
