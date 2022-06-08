<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValueInOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operators', function (Blueprint $table) {
            $table->boolean('active_employee')->default(1)->nullable()->change();
        });

        Schema::table('chefs', function (Blueprint $table) {
            $table->boolean('active_employee')->default(1)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('operators', function (Blueprint $table) {
            $table->boolean('active_employee')->default(0)->change();
        });
        Schema::table('chefs', function (Blueprint $table) {
            $table->boolean('active_employee')->default(0)->change();
        });
    }
}
