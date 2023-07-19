<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bets_no');
            $table->date('bets_date');
            $table->string('kode');
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('sender_id');


            $table->foreign('produk_id')->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('sender_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('batch_records');
    }
}
