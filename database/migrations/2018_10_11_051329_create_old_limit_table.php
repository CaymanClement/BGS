<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldLimitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('old_limits', function (Blueprint $table) {
            $table->increments('b_limits_id')->unsigned()->index(); 
            $table->integer('user_id')->unsigned()->index()->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('market_cost')->default('0');
            $table->integer('travelling_cost')->default('0');
            $table->integer('fuel_cost')->default('0');
            $table->integer('postage_cost')->default('0');
            $table->integer('fax_cost')->default('0');
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
        Schema::drop('old_limits'); 
    }
}
