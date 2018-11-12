<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->string('mtcn');
            $table->string('rec_name');
            $table->string('rec_id_type');
            $table->string('rec_id_number');
            $table->string('rec_country');
            $table->string('rec_gender');
            $table->string('rec_tel');
            $table->string('rec_dob');
            $table->string('s_name');
            $table->string('s_location');
            $table->string('amount');
            $table->string('rec_currency');
            $table->string('service_type');
            $table->string('purpose');
            $table->string('mobile_account');
            $table->string('extra_id');
            $table->integer('bank_officer');
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
        Schema::dropIfExists('transactions');
    }
}
