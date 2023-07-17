<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->id();
            $table->string('bets_no');
            $table->date('bets_date');
            $table->date('bets_received');
            // $table->string('regarding');
            $table->string('kode');
            $table->foreignId('department_id');
            $table->foreignId('sender_id');
            $table->string('bets_file');
            // $table->string('letter_type');
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
        Schema::dropIfExists('letters');
    }
}
