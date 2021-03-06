<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckingAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkingaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->double('amount')->default(0.0);
            $table->unsignedInteger('user_id');
            $table->integer('pin');
            $table->double('limit');
            $table->timestamps();
            $table->softDeletes();
            $table-> foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkingaccounts');
    }
}
