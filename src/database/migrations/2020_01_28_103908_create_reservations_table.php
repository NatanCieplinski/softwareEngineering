<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data');
            $table->time('da_ora');
            $table->time('ad_ora');
            $table->boolean('checked')->default(false);
            $table->integer('posto');
            $table->time('inizio_pausa')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('desk_id')->unsigned();
            
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
        Schema::dropIfExists('reservations');
    }
}
