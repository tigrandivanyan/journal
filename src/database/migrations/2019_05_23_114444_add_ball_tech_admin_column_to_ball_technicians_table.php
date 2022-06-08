<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBallTechAdminColumnToBallTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ball_technicians', function (Blueprint $table) {
            $table->tinyInteger('ball_tech_admin')->nullable()->after('active_employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ball_technicians', function (Blueprint $table) {
            $table->dropColumn('ball_tech_admin');
        });
    }
}
