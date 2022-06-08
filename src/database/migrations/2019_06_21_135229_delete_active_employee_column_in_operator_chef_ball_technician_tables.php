<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteActiveEmployeeColumnInOperatorChefBallTechnicianTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operators', function (Blueprint $table) {
            $table->dropColumn('active_employee');
        });

        Schema::table('chefs', function (Blueprint $table) {
            $table->dropColumn('active_employee');
        });

        Schema::table('ball_technicians', function (Blueprint $table) {
            $table->dropColumn('active_employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
