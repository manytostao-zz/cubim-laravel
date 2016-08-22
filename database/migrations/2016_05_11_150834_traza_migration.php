<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrazaMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traza', function (Blueprint $table) {
            $table->timestamps();
            $table->rename('traces');
        });

        \DB::statement("
            ALTER TABLE traces COMMENT 'Traces.'");

        \DB::statement("
            ALTER TABLE traces
              CHANGE operacion operation VARCHAR(255) COMMENT 'Operation executed.'");

        \DB::statement("
            ALTER TABLE traces
              CHANGE objeto object VARCHAR(255) COMMENT 'Object on which the operation was executed.'");

        \DB::statement("
            ALTER TABLE traces
              CHANGE appUser user VARCHAR(255) COMMENT 'User that executed the operation.'");

        \DB::statement("
            ALTER TABLE traces
              CHANGE observaciones comments LONGTEXT COMMENT 'Comments on the entry.'");

        \DB::statement("
            ALTER TABLE traces
              CHANGE modulo module VARCHAR(100) COMMENT 'Module in which the operation was executed.'");

        \DB::statement("
            UPDATE traces
              SET created_at = fecha");

        Schema::table('traces', function (Blueprint $table) {
            $table->dropColumn('fecha');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traces', function (Blueprint $table) {
            $table->dateTime('fecha');
        });

        \DB::statement("
            UPDATE traces
              SET fecha = created_at");

        \DB::statement("
            ALTER TABLE traces
              CHANGE module modulo VARCHAR(100)");

        \DB::statement("
            ALTER TABLE traces
              CHANGE comments observaciones LONGTEXT");

        \DB::statement("
            ALTER TABLE traces
              CHANGE user appUser VARCHAR(255)");

        \DB::statement("
            ALTER TABLE traces
              CHANGE object objeto VARCHAR(255)");

        \DB::statement("
            ALTER TABLE traces
              CHANGE operation operacion VARCHAR(255)");

        \DB::statement("
            ALTER TABLE traces");

        Schema::table('traces', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->rename('traza');
        });
    }
}
