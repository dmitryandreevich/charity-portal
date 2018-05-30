<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryOfVolunteeringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_of_volunteerings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_vol');
            $table->integer('id_need');
            $table->integer('amount')->default(1); // если организация, то количество может быть больше 1

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
        Schema::dropIfExists('history_of_volunteerings');
    }
}
