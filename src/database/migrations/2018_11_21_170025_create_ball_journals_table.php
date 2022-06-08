<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBallJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     *
     */
    public function up()
    {
        Schema::create('ball_journals', function (Blueprint $table) {
            $table->increments('id')->index()->unique();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->integer('ball_technician_id')->nullable()->unsigned();
            $table->integer('event_type_id')->nullable()->unsigned();
            $table->text('description')->nullable();
            $table->integer('studio_id')->nullable()->unsigned();
            $table->integer('ball_set_number')->nullable()->unsigned();
            $table->tinyInteger('ball_set_status')->nullable()->unsigned();
            $table->integer('ball_number')->nullable()->unsigned();
            $table->integer('ball_change_reason')->nullable()->unsigned();
            $table->tinyInteger('entry_completion_status')->nullable()->unsigned();
            $table->tinyInteger('announcement')->nullable()->unsigned();
            $table->tinyInteger('mail')->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ball_journals');
    }
}
