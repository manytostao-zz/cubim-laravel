<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppuserMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("SET foreign_key_checks = 0");

        \DB::statement("
            INSERT INTO users (id, email, first_name, last_name, created_at, password)
              SELECT id, username, nombre, apellidos, fechaAlta, '" . password_hash('cubim', 1) . "' FROM appuser
        ");

        Schema::table('answer_bibliography_requests', function (Blueprint $table) {
            $table->dropForeign('FK_EAF6F5FE74E3600A');
        });

        \DB::statement("
            ALTER TABLE answer_bibliography_requests
              CHANGE user_id user_id INT(10) UNSIGNED COMMENT 'Identifier of the user that made the bibliography request answer.'");
//
//        Schema::table('answer_bibliography_requests', function (Blueprint $table) {
//            $table->foreign('user_id', 'FK_EAF6F5FE74E3600A')->references('id')->on('users');
//        });

        Schema::table('bibliography_requests', function (Blueprint $table) {
            $table->dropForeign('FK_9E9397BD74E3600A');
        });

        \DB::statement("
            ALTER TABLE bibliography_requests
              CHANGE user_id user_id INT(10) UNSIGNED COMMENT 'Identifier of the specialist following the request.'");

//        Schema::table('bibliography_requests', function (Blueprint $table) {
//            $table->foreign('user_id', 'FK_9E9397BD74E3600A')->references('id')->on('users');
//        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1463E3A4A');
        });

        \DB::statement("
            ALTER TABLE cubim.customers
              CHANGE attended_by_id attended_by_id INT(10) UNSIGNED COMMENT 'Id of the specialist that is attending the customer.'");

//        Schema::table('customers', function (Blueprint $table) {
//            $table->foreign('attended_by_id', 'FK_EDD889C1463E3A4A')->references('id')->on('users');
//        });

        Schema::table('reference_requests', function (Blueprint $table) {
            $table->dropForeign('FK_C01213D874E3600A');
        });

        \DB::statement("
            ALTER TABLE reference_requests
              CHANGE user_id user_id INT(10) UNSIGNED COMMENT 'Identifier of the user that made the reference answer.'");

//        Schema::table('reference_requests', function (Blueprint $table) {
//            $table->foreign('user_id', 'FK_C01213D874E3600A')->references('id')->on('users');
//        });

        Schema::table('sdi_requests', function (Blueprint $table) {
            $table->dropForeign('FK_80E3492774E3600A');
        });

        \DB::statement("
            ALTER TABLE sdi_requests
              CHANGE user_id user_id INT(10) UNSIGNED COMMENT 'Identifier of the user that made the sdi answer.'");

//        Schema::table('sdi_requests', function (Blueprint $table) {
//            $table->foreign('user_id', 'FK_80E3492774E3600A')->references('id')->on('users');
//        });

        Schema::table('userimage', function (Blueprint $table) {
            $table->drop();
        });

        Schema::table('appuser', function (Blueprint $table) {
            $table->drop();
        });

        \DB::statement("SET foreign_key_checks = 1");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('appuser', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('username');
            $table->string('password');
            $table->string('salt');
            $table->dateTime('fechaAlta');
            $table->tinyInteger('activo');
        });

        Schema::create('userimage', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('path');
            $table->integer('appUser_id');
        });

        Schema::table('sdi_requests', function (Blueprint $table) {
            $table->dropForeign('FK_80E3492774E3600A');
            $table->foreign('user_id', 'FK_80E3492774E3600A')->references('id')->on('users');
        });

        \DB::statement("
            INSERT INTO users (id, email, first_name, last_name, created_at, password)
              SELECT id, username, nombre, apellidos, fechaAlta, '" . password_hash('cubim', 1) . "' FROM appuser
        ");


        Schema::table('answer_bibliography_requests', function (Blueprint $table) {
            $table->dropForeign('FK_EAF6F5FE74E3600A');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('bibliography_requests', function (Blueprint $table) {
            $table->dropForeign('FK_9E9397BD74E3600A');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1463E3A4A');
            $table->foreign('attended_by_id')->references('id')->on('users');
        });

        Schema::table('reference_requests', function (Blueprint $table) {
            $table->dropForeign('FK_C01213D874E3600A');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
