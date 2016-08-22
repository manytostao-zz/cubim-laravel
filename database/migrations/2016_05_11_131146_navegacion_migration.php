<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NavegacionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navegacion', function (Blueprint $table) {
            $table->timestamp('entered_at');
            $table->timestamp('exited_at')->nullable();
            $table->rename('internet_browsing_services');
        });

        \DB::statement("
            ALTER TABLE internet_browsing_services COMMENT 'Internet browsing services.'");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE usuario_id customer_id INT(11) COMMENT 'Identifier of the customer that requested the internet browsing service.'");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE pc_id pc_id INT(11) COMMENT 'Identifier of the pc on which the customer sat.'");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE correo email TINYINT(1) COMMENT 'If the customer wanted only to check the email.'");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE necesidad necessity LONGTEXT COMMENT 'Internet browsing necessity of the customer.'");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE observaciones comments LONGTEXT COMMENT 'Comments on the entry.'");

        \DB::statement("
            UPDATE internet_browsing_services
              SET entered_at = entrada");

        \DB::statement("
            UPDATE internet_browsing_services
              SET exited_at = salida");

        Schema::table('internet_browsing_services', function (Blueprint $table) {
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
        Schema::table('internet_browsing_services', function (Blueprint $table) {
            $table->dateTime('entrada');
            $table->dateTime('salida')->nullable();
        });

        \DB::statement("
            UPDATE internet_browsing_services
              SET salida = exited_at");

        \DB::statement("
            UPDATE internet_browsing_services
              SET entrada = entered_at");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE comments observaciones LONGTEXT");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE necessity necesidad LONGTEXT");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE email correo TINYINT(1)");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE pc_id pc_id INT(11)");

        \DB::statement("
            ALTER TABLE internet_browsing_services
              CHANGE customer_id usuario_id INT(11)");

        \DB::statement("
            ALTER TABLE internet_browsing_services");

        Schema::table('internet_browsing_services', function (Blueprint $table) {
            $table->dropColumn('entered_at');
            $table->dropColumn('exited_at');
            $table->rename('navegacion');
        });
    }
}
