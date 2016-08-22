<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LecturaModalidadMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectura_modalidad', function (Blueprint $table) {
            $table->timestamps();
            $table->rename('reading_service_modes');
        });

        \DB::statement("
            ALTER TABLE reading_service_modes COMMENT 'Reading service modes.'");

        \DB::statement("
            ALTER TABLE reading_service_modes
              CHANGE lectura_id reading_service_id INT(11) COMMENT 'Identifier of the reading service that the customer requested.'");

        \DB::statement("
            ALTER TABLE reading_service_modes
              CHANGE modalidad_id mode_id INT(11) COMMENT 'Identifier of the mode associated to the reading service.'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement("
            ALTER TABLE reading_service_modes
              CHANGE mode_id modalidad_id INT(11)");

        \DB::statement("
            ALTER TABLE reading_service_modes
              CHANGE reading_service_id lectura_id INT(11)");

        \DB::statement("
            ALTER TABLE reading_service_modes");

        Schema::table('reading_service_modes', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->rename('lectura_modalidad');
        });
    }
}
