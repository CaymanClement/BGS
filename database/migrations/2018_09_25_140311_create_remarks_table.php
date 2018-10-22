<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('remarks', function (Blueprint $table) {
            $table->increments('remark_id')->unsigned()->index(); 
            $table->integer('budget_id')->unsigned()->index()->references('budget_id')->on('budget')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('actual_cost')->default('0');
            $table->string('final_remarks')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('reviewer2')->nullable();
            $table->string('reviewer3')->nullable();
            $table->string('remark_status')->default('Remark Submitted');
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
        Schema::drop('remarks');
    }
}
