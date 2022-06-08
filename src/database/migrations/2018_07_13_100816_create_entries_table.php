<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('tour')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('operator_id')->nullable();
            $table->integer('description_type_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('chef_id')->nullable();
            $table->integer('studio_id')->nullable();
            $table->tinyInteger('mark')->nullable();
            $table->tinyInteger('announcement')->nullable();
            $table->tinyInteger('mail')->nullable();
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
        Schema::dropIfExists('events');
    }
}
