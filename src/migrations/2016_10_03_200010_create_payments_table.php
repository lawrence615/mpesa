<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_no', 20);
            $table->string('client_name', 120);
            $table->string('transaction_id', 50);
            $table->float('amount')->nullable();
            $table->string('acc_no')->nullable();
            $table->smallInteger('status')->default(0);
            $table->integer('transaction_type')->nullable();
            $table->string('transaction_time', 20);
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
        Schema::dropIfExists('payments');
    }
}
