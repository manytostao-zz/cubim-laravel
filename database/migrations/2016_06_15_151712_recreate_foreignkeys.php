<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateForeignkeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("SET foreign_key_checks = 0");

        Schema::table("customers", function (Blueprint $table) {
//            $table->dropForeign('FK_EDD889C1463E3A4A');
            $table->foreign('attended_by_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::table('bibliography_requests', function (Blueprint $table) {
            $table->dropForeign('FK_9E9397BD43798DA7');
//            $table->dropForeign('FK_9E9397BD74E3600A');
            $table->dropForeign('FK_9E9397BDDB38439E');
            $table->dropForeign('FK_9E9397BDF9E584F8');
            $table->foreign('style_id')->references('id')->on('nomenclators')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('motive_id')->references('id')->on('nomenclators')->onDelete('restrict');
        });

        Schema::table('bibliography_request_nomenclators', function (Blueprint $table) {
            $table->dropForeign('FK_89F47B84F874597B');
            $table->dropForeign('FK_89F47B84FCC176CE');
            $table->foreign('nomenclator_id')->references('id')->on('nomenclators')->onDelete('restrict');
            $table->foreign('bibliography_id')->references('id')->on('bibliography_requests')->onDelete('restrict');
        });

        Schema::table('answer_bibliography_requests', function (Blueprint $table) {
//            $table->dropForeign('FK_EAF6F5FEFCC176CE');
//            $table->dropForeign('FK_EAF6F5FE74E3600A');
            $table->foreign('bibliography_request_id')->references('id')->on('bibliography_requests')->onDelete('restrict');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });

        Schema::table('bibliography_request_answer_nomenclators', function(Blueprint $table){
            $table->dropForeign('FK_20ACDF15EB1C4139');
            $table->dropForeign('FK_20ACDF15F874597B');
            $table->foreign('bibliography_answer_id', 'bibliography_answer_id_foreign')->references('id')->on('answer_bibliography_requests')->onDelete('restrict');
            $table->foreign('nomenclator_id')->references('id')->on('nomenclators')->onDelete('restrict');
        });

        Schema::table('sdi_requests', function (Blueprint $table) {
//            $table->dropForeign('FK_80E3492774E3600A');
            $table->dropForeign('FK_80E349277DC6B578');
            $table->dropForeign('FK_80E34927DB38439E');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('request_via_id')->references('id')->on('nomenclators')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
        });

        Schema::table('nomenclator_sdi_requests', function (Blueprint $table) {
            $table->dropForeign('FK_C07ECE3F43FBD25B');
            $table->dropForeign('FK_C07ECE3FF874597B');
            $table->foreign('sdi_id')->references('id')->on('sdi_requests')->onDelete('restrict');
            $table->foreign('nomenclator_id')->references('id')->on('nomenclators')->onDelete('restrict');
        });

        Schema::table('reading_services', function (Blueprint $table) {
            $table->dropForeign('FK_C60ABD51DB38439E');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
        });

        Schema::table('reading_service_modes', function (Blueprint $table) {
            $table->dropForeign('FK_1D817051E092B9F');
            $table->dropForeign('FK_1D81705BA81B89A');
            $table->foreign('reading_service_id')->references('id')->on('reading_services')->onDelete('restrict');
            $table->foreign('mode_id')->references('id')->on('nomenclators')->onDelete('restrict');
        });

        Schema::table('reading_service_mode_details', function (Blueprint $table) {
            $table->dropForeign('FK_A9C98C87E9063F8B');
            $table->foreign('reading_service_mode_id')->references('id')->on('reading_service_modes')->onDelete('restrict');
        });

        Schema::table('internet_browsing_services', function (Blueprint $table) {
            $table->dropForeign('FK_4354C06D8F63531D');
            $table->dropForeign('FK_4354C06DDB38439E');
            $table->foreign('pc_id')->references('id')->on('nomenclators')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
        });

        Schema::table('internet_browsing_service_nomenclators', function (Blueprint $table) {
            $table->dropForeign('FK_FBE6357981B2DFA3');
            $table->dropForeign('FK_FBE63579F874597B');
            $table->foreign('internet_browsing_service_id', 'internet_browsing_service_id_foreign')->references('id')->on('internet_browsing_services')->onDelete('restrict');
            $table->foreign('nomenclator_id')->references('id')->on('nomenclators')->onDelete('restrict');
        });

        Schema::table('nomenclators', function (Blueprint $table) {
            $table->dropForeign('FK_6373503644966ABD');
            $table->foreign('nomenclator_type_id')->references('id')->on('nomenclator_types')->onDelete('restrict');
        });

        Schema::table('receptions', function (Blueprint $table) {
            $table->dropForeign('FK_9D18EA09DB38439E');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
        });

        Schema::table('reference_requests', function (Blueprint $table) {
//            $table->dropForeign('FK_C01213D874E3600A');
            $table->dropForeign('FK_C01213D87DC6B578');
            $table->dropForeign('FK_C01213D8DB38439E');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('request_via_id')->references('id')->on('nomenclators')->onDelete('restrict');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
        });

        Schema::table('nomenclator_reference_requests', function (Blueprint $table) {
            $table->dropForeign('FK_4D6ADE5A778D91A2');
            $table->dropForeign('FK_4D6ADE5AF874597B');
            $table->foreign('reference_request_id')->references('id')->on('reference_requests')->onDelete('restrict');
            $table->foreign('nomenclator_id')->references('id')->on('nomenclators')->onDelete('restrict');
        });

        Schema::table('traces', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
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
        //
    }
}
