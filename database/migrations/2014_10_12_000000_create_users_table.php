<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('title');
            $table->integer('balance')->default('0');
$table->integer('branch_id_')->unsigned()->index()->references('branch_id')->on('branches')->onUpdate('cascade')->onDelete('restrict');
            $table->string('status')->default('created');
            $table->string('password');
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
