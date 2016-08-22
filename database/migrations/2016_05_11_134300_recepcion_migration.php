<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecepcionMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recepcion', function (Blueprint $table) {
            $table->timestamp('entered_at');
            $table->timestamp('exited_at')->nullable();
            $table->rename('receptions');
        });

        \DB::statement("
            ALTER TABLE receptions COMMENT 'Front desk customer welcome.'");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE usuario_id customer_id INT(11) COMMENT 'Identifier of the customer that was attended.'");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE chapilla ticket DOUBLE COMMENT 'Ticket that the customer receives for storing belongings.'");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE documento document LONGTEXT COMMENT 'Document with which the customer entered the library.'");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE observaciones comments LONGTEXT COMMENT 'Comments on the entry.'");

        \DB::statement("
            UPDATE receptions
              SET entered_at = entrada");

        \DB::statement("
            UPDATE receptions
              SET exited_at = salida");

        Schema::table('receptions', function (Blueprint $table) {
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
        Schema::table('receptions', function (Blueprint $table) {
            $table->dateTime('entrada');
            $table->dateTime('salida')->nullable();
        });

        \DB::statement("
            UPDATE receptions
              SET salida = exited_at");

        \DB::statement("
            UPDATE receptions
              SET entrada = entered_at");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE comments observaciones LONGTEXT");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE document documento LONGTEXT");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE ticket chapilla DOUBLE");

        \DB::statement("
            ALTER TABLE receptions
              CHANGE customer_id usuario_id INT(11)");

        \DB::statement("
            ALTER TABLE receptions");

        Schema::table('receptions', function (Blueprint $table) {
            $table->dropColumn('entered_at');
            $table->dropColumn('exited_at');
            $table->rename('recepcion');
        });
    }
}
