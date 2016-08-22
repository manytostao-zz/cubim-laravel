<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppuserRoleMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("
            INSERT INTO role_users (user_id, role_id) SELECT appuser_id, role_id FROM appuser_role
        ");

        Schema::table('appuser_role', function (Blueprint $table) {
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
        Schema::create('appuser_role', function(Blueprint $table){
            $table->integer('appuser_id');
            $table->integer('role_id');
        });

        \DB::statement("
            INSERT INTO appuser_role (appuser_id, role_id) SELECT user_id, role_id FROM role_users
        ");

        \DB::statement("
            DELETE FROM role_users
        ");
    }
}
