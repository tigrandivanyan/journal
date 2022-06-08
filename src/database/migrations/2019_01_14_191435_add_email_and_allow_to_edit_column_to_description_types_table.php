<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailAndAllowToEditColumnToDescriptionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('description_types', function (Blueprint $table) {
            $table->tinyInteger('email')->nullable()->default(1)->after('ru_name');
            $table->tinyInteger('allow_to_edit')->nullable()->default(1)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('description_types', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('allow_to_edit');
        });
    }
}
