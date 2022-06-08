<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtRowToBallTechniciansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ball_technicians', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('ball_tech_admin');
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
            $table->dropColumn('deleted_at');
        });
    }
}
