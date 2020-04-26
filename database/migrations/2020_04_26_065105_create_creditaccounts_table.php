<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditaccounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('limit')->default(200);
            $table->double('amount')->default(0.0);
            $table->unsignedInteger('checkingaccount_id');
            $table->softDeletes();
            $table->timestamps();

            $table-> foreign('checkingaccount_id')->references('id')->on('checkingaccounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('creditaccounts');
    }
}
