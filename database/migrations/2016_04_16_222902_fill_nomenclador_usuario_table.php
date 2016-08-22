<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class FillNomencladorUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        #region Especialidad
        \DB::statement(
            'INSERT INTO 
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.especialidad_id
                FROM cubim.usuario
                WHERE cubim.usuario.especialidad_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C116A490EC');
            $table->dropColumn('especialidad_id');
        });
        #endregion

        #region Profesion
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.profesion_id
                FROM cubim.usuario
                WHERE cubim.usuario.profesion_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1C5AF4D0F');
            $table->dropColumn('profesion_id');
        });
        #endregion

        #region Cargo
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.cargo_id
                FROM cubim.usuario
                WHERE cubim.usuario.cargo_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1813AC380');
            $table->dropColumn('cargo_id');
        });
        #endregion

        #region Institucion
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.institucion_id
                FROM cubim.usuario
                WHERE cubim.usuario.institucion_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1B239FBC6');
            $table->dropColumn('institucion_id');
        });
        #endregion

        #region Dedicacion
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.dedicacion_id
                FROM cubim.usuario
                WHERE cubim.usuario.dedicacion_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C19A14E72');
            $table->dropColumn('dedicacion_id');
        });
        #endregion

        #region Tipo de Usuario
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.tipoUsua_id
                FROM cubim.usuario
                WHERE cubim.usuario.tipoUsua_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C126159461');
            $table->dropColumn('tipoUsua_id');
        });
        #endregion

        #region Tipo de Profesional
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.tipoPro_id
                FROM cubim.usuario
                WHERE cubim.usuario.tipoPro_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1489F97D8');
            $table->dropColumn('tipoPro_id');
        });
        #endregion

        #region Categoria Ocupacional
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.categOcup_id
                FROM cubim.usuario
                WHERE cubim.usuario.categOcup_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C17915D2A1');
            $table->dropColumn('categOcup_id');
        });
        #endregion

        #region Categoria Cientifica
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.categCien_id
                FROM cubim.usuario
                WHERE cubim.usuario.categCien_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1CF082C9D');
            $table->dropColumn('categCien_id');
        });
        #endregion

        #region Categoria Investigativa
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.categInv_id
                FROM cubim.usuario
                WHERE cubim.usuario.categInv_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C13EC0111C');
            $table->dropColumn('categInv_id');
        });
        #endregion

        #region Categoria Docente
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.categDoc_id
                FROM cubim.usuario
                WHERE cubim.usuario.categDoc_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1D8F98CDF');
            $table->dropColumn('categDoc_id');
        });
        #endregion

        #region Pais
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(cubim.customer_nomenclators.customer_id, cubim.customer_nomenclators.nomenclator_id)
                SELECT cubim.usuario.id, cubim.usuario.pais_id
                FROM cubim.usuario
                WHERE cubim.usuario.pais_id IS NOT NULL;');
        Schema::table('usuario', function (Blueprint $table) {
            $table->dropForeign('FK_EDD889C1C604D5C6');
            $table->dropColumn('pais_id');
        });
        #endregion

        #region Servicio
        \DB::statement(
            'INSERT INTO
                cubim.customer_nomenclators(
                  cubim.customer_nomenclators.customer_id,
                  cubim.customer_nomenclators.nomenclator_id,
                  cubim.customer_nomenclators.created_at
                )
                SELECT
                  cubim.usuario_servicio.usuario_id,
                  cubim.usuario_servicio.servicio_id,
                  cubim.usuario_servicio.fecha
                FROM cubim.usuario_servicio;');
        \DB::statement('DROP TABLE cubim.usuario_servicio');
        #endregion
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        #region Especialidad
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('especialidad_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.especialidad_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 2);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 2
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('especialidad_id', 'FK_EDD889C116A490EC')->references('id')->on('nomenclador');
        });
        #endregion

        #region Profesion
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('profesion_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.profesion_id=
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 3);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 3
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('profesion_id', 'FK_EDD889C1C5AF4D0F')->references('id')->on('nomenclador');
        });
        #endregion

        #region Cargo
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('cargo_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.cargo_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 4);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 4
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('cargo_id', 'FK_EDD889C1813AC380')->references('id')->on('nomenclador');
        });
        #endregion

        #region Institucion
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('institucion_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.institucion_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 5);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 5
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('institucion_id', 'FK_EDD889C1B239FBC6')->references('id')->on('nomenclador');
        });
        #endregion

        #region Dedicacion
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('dedicacion_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.dedicacion_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 6);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 6
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('dedicacion_id', 'FK_EDD889C19A14E72')->references('id')->on('nomenclador');
        });
        #endregion

        #region Tipo de Usuario
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('tipoUsua_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.tipoUsua_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 11);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 11
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('tipoUsua_id', 'FK_EDD889C126159461')->references('id')->on('nomenclador');
        });
        #endregion

        #region Tipo de Profesional
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('tipoPro_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.tipoPro_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 1);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 1
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('tipoPro_id', 'FK_EDD889C1489F97D8')->references('id')->on('nomenclador');
        });
        #endregion

        #region Categoria Ocupacional
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('categOcup_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.categOcup_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 8);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 8
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('categOcup_id', 'FK_EDD889C17915D2A1')->references('id')->on('nomenclador');
        });
        #endregion

        #region Categoria Investigativa
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('categInv_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.categInv_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 9);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 9
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('categInv_id', 'FK_EDD889C13EC0111C')->references('id')->on('nomenclador');
        });
        #endregion

        #region Categoria Docente
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('categDoc_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.categDoc_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 7);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 7
                );');
        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('categDoc_id', 'FK_EDD889C1D8F98CDF')->references('id')->on('nomenclador');
        });
        #endregion

        #region Categoria Cientifica
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('categCien_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.categCien_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 10);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 10
                );');

        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('categCien_id', 'FK_EDD889C1CF082C9D')->references('id')->on('nomenclador');
        });
        #endregion

        #region Pais
        Schema::table('usuario', function (Blueprint $table) {
            $table->integer('pais_id')->nullable();
        });

        \DB::statement(
            'UPDATE
                    cubim.usuario
                    SET cubim.usuario.pais_id =
                      (SELECT cubim.customer_nomenclators.nomenclator_id
                      FROM cubim.customer_nomenclators
                        JOIN cubim.nomenclador
                          ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
                      WHERE cubim.customer_nomenclators.customer_id = cubim.usuario.id
                        AND cubim.nomenclador.tiponom_id = 12);');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id
                  FROM cubim.nomenclador
                  WHERE cubim.nomenclador.tiponom_id = 12
                );');

        Schema::table('usuario', function (Blueprint $table) {
            $table->foreign('pais_id', 'FK_EDD889C1C604D5C6')->references('id')->on('nomenclador');
        });
        #endregion

        #region Servicio
        Schema::create('usuario_servicio', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario_id');
            $table->foreign('usuario_id', 'FK_234700B3DB38439E')->references('id')->on('usuario');
            $table->integer('servicio_id');
            $table->foreign('servicio_id', 'FK_234700B371CAA3E7')->references('id')->on('nomenclador');
            $table->timestamp('fecha');
        });
        \DB::statement(
            'INSERT INTO
              cubim.usuario_servicio(
                cubim.usuario_servicio.usuario_id,
                cubim.usuario_servicio.servicio_id,
                cubim.usuario_servicio.fecha
            )
            SELECT
              cubim.customer_nomenclators.customer_id,
              cubim.customer_nomenclators.nomenclator_id,
              cubim.customer_nomenclators.created_at
            FROM
              cubim.customer_nomenclators JOIN cubim.nomenclador
              ON cubim.customer_nomenclators.nomenclator_id = cubim.nomenclador.id
            WHERE cubim.nomenclador.tiponom_id = 13
        ');
        \DB::statement(
            'DELETE
                FROM cubim.customer_nomenclators
                WHERE cubim.customer_nomenclators.nomenclator_id IN (
                  SELECT cubim.nomenclador.id 
                  FROM cubim.nomenclador 
                  WHERE cubim.nomenclador.tiponom_id = 13
                );');
        #endregion
    }
}
