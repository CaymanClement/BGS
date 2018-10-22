<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('budget_track', function (Blueprint $table) {
            $table->increments('bt_id')->unsigned()->index();
            $table->integer('budget_id')->unsigned()->index()->references('budget_id')->on('budget')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('user_id')->unsigned()->index()->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->string('status_info');
            $table->string('comment');
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
        Schema::drop('budget_track'); 
    }
}
