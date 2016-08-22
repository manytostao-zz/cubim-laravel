<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LecturaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lectura', function (Blueprint $table) {
            $table->timestamp('entered_at');
            $table->timestamp('exited_at')->nullable();
            $table->rename('reading_services');
        });

        \DB::statement("
            ALTER TABLE reading_services COMMENT 'Reading services.'");

        \DB::statement("
            ALTER TABLE reading_services
              CHANGE usuario_id customer_id INT(11) COMMENT 'Identifier of the customer that requested the reading service.'");

        \DB::statement("
            ALTER TABLE reading_services
              CHANGE observaciones comments VARCHAR(255) COMMENT 'Comments on the reading service.'");

        \DB::statement("
            UPDATE reading_services
              SET entered_at = entrada");

        \DB::statement("
            UPDATE reading_services
              SET exited_at = salida");

        Schema::table('reading_services', function (Blueprint $table) {
            $table->dropColumn('entrada');
            $table->dropColumn('salida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reading_services', function (Blueprint $table) {
            $table->dateTime('entrada');
            $table->dateTime('salida')->nullable();
        });

        \DB::statement("
            UPDATE reading_services
              SET salida = exited_at");

        \DB::statement("
            UPDATE reading_services
              SET entrada = entered_at");

        \DB::statement("
            ALTER TABLE reading_services
              CHANGE comments observaciones VARCHAR(255)");

        \DB::statement("
            ALTER TABLE reading_services");

        \DB::statement("
            ALTER TABLE reading_services
              CHANGE customer_id usuario_id INT(11)");

        Schema::table('reading_services', function (Blueprint $table) {
            $table->dropColumn('entered_at');
            $table->dropColumn('exited_at');
            $table->rename('lectura');
        });
    }
}
