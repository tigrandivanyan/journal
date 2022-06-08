<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chefs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ru')->nullable();
            $table->string('name_lv')->nullable();
            $table->integer('number')->nullable();
            $table->integer('user_id')->nullable()->unsigned()->nullable();
            $table->tinyInteger('active_employee')->nullable();
            $table->timestamp('deleted_at')->nullable()->after('active_employee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chefs');
    }
}
