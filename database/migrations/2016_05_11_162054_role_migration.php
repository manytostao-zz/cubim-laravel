<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoleMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            INSERT INTO roles (id, slug, name) SELECT id, name, role FROM role
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_SUPER_ADMINISTRATOR' WHERE name = 'ROLE_SÚPER_ADMINISTRACIÓN'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_ADMINISTRATOR' WHERE name = 'ROLE_ADMINISTRACIÓN'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_REGISTERER' WHERE name = 'ROLE_REGISTRO'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_RECEPTIONIST' WHERE name = 'ROLE_RECEPCION'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_REFERENCIST' WHERE name = 'ROLE_REFERENCIA'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_BIBLIOGRAPHER' WHERE name = 'ROLE_BIBLIOGRAFIA'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_SDI' WHERE name = 'ROLE_DSI'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_READING_SERVICE_SPECIALIST' WHERE name = 'ROLE_LECTURA'
        ");

        \DB::statement("
            UPDATE roles SET name = 'ROLE_WEB_BROWSING_SERVICE_SPECIALIST' WHERE name = 'ROLE_NAVEGACION'
        ");

        Schema::table('role', function (Blueprint $table) {
            $table->drop();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('role', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('role');
        });

        \DB::statement("
            INSERT INTO role (id, name, role) SELECT id, slug, name FROM roles
        ");

        \DB::statement("
            DELETE FROM roles
        ");
    }
}
