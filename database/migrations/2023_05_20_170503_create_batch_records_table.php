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
            $table->foreignId('sender_id');
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
