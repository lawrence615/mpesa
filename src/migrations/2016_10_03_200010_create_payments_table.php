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
            $table->string('sender_first_name', 40)->nullable();
            $table->string('sender_middle_name', 40)->nullable();
            $table->string('sender_last_name', 40)->nullable();
            $table->string('transaction_id', 50);
            $table->float('amount')->nullable();
            $table->string('business_number', 100)->nullable();
            $table->string('acc_no', 100)->nullable();
            $table->string('transaction_type', 20)->nullable();
            $table->string('transaction_time', 20)->nullable();
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
