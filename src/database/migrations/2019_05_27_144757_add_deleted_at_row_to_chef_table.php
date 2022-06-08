<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAtRowToChefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chefs', function (Blueprint $table) {
            $table->timestamp('deleted_at')->nullable()->after('active_employee');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chefs', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
    }
}
