<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImplementationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('implementation', function (Blueprint $table) {
            $table->increments('implementation_id')->unsigned()->index();
            $table->integer('budget_id')->unsigned()->index()->references('budget_id')->on('budget')->onUpdate('cascade')->onDelete('restrict');
            $table->date('date_of_visit');
            $table->string('activities')->nullable();
            $table->string('place')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->default('Pending');
            $table->integer('total_cost')->default('0')->default('0');;
            $table->integer('actual_cost')->default('0')->default('0');;
            $table->integer('expected_premium')->default('0')->default('0');;
            $table->date('bgen_date')->nullable();
            $table->string('reason')->nullable();
            $table->string('status')->default('Not Settled');
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
        Schema::drop('implementation'); 
    }
}
