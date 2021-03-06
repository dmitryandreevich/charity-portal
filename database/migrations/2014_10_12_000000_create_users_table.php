<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->nullable();
            $table->string('password')->default("");
            $table->string('avatar')->default("");
            $table->integer('balance', false, true)->default(0);
            $table->string('city')->default("");
            $table->string('phone')->default("");
            $table->tinyInteger('type'); // Type of account
            $table->text('data');
            $table->string('vkId')->unique()->nullable();
            $table->string('fbId')->unique()->nullable();
            $table->string('vol_type_org')->nullable();
            $table->rememberToken();
            $table->timestamps();
            /*
             * avatar
             * balance
             * city
             * phone
             * volunteer { vol_type:0, data:{ } }
             * volunteer fiz- name, second_name, th_name,
             * volunteer org- name_org,type_org, count_vol, email
             *
             * donor { don_type: 0, data:{ } }
             * donor fiz - name, second_name, th_name,
             * donor org - org_address, inn, kpp, ogrn, bank, bik, ch_account, corp_account, ceo
             *
             * consumer(potr) - name, second_name
             *
             *
             * */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
