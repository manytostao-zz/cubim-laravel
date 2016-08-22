<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeUsuarioTableColumnNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("usuario", function (Blueprint $table) {
            $table->timestamps();
            $table->rename("customers");
        });

        \DB::statement("
            ALTER TABLE customers COMMENT 'Customers.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE carnetBib library_card DECIMAL(10,0) COMMENT 'Library card number of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE carnetId id_card VARCHAR(255) COMMENT 'Identity card number of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE nombres name VARCHAR(255) COMMENT 'Name of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE apellidos last_name VARCHAR(255) COMMENT 'Last name of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE email email VARCHAR(255) COMMENT 'Email of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE telefono phone DECIMAL(10,0) COMMENT 'Phone number of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE experiencia experience INT(11) COMMENT 'Experience in years of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE observaciones comments LONGTEXT COMMENT 'Comments about the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE temaInv topic LONGTEXT COMMENT 'Research topic of the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE atendidoPor_id attended_by_id INT(11) COMMENT 'Id of the specialist that is attending the customer.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE estudiante student TINYINT(1) COMMENT 'If the customer is a student.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE banned banned TINYINT(1) COMMENT 'If the customer is banned.'");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE activo active TINYINT(1) COMMENT 'If the customer is active.'");

        \DB::statement("
            UPDATE cubim.customers
              SET created_at = fechaIns");

        Schema::table("customers", function (Blueprint $table) {
            $table->dropColumn("fechaIns");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("customers", function (Blueprint $table) {
            $table->dateTime("fechaIns");
        });

        \DB::statement("
            UPDATE cubim.customers
              SET fechaIns = created_at");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE active activo TINYINT(1)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE banned banned TINYINT(1)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE student estudiante TINYINT(1)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE attended_by_id atendidoPor_id INT(11)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE topic temaInv LONGTEXT");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE comments observaciones LONGTEXT");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE experience experiencia INT(11)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE phone telefono DECIMAL(10,0)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE email email VARCHAR(255)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE last_name apellidos VARCHAR(255)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE name nombres VARCHAR(255)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE id_card carnetId VARCHAR(255)");

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE library_card carnetBib DECIMAL(10,0)");

        \DB::statement("
            ALTER TABLE customers");

        Schema::table("customers", function (Blueprint $table) {
            $table->dropTimestamps();
            $table->rename("usuario");
        });
    }
}
