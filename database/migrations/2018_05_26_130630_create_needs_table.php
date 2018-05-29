<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needs', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(\App\Classes\StatusOfNeed::STATUS_ACTUAL);
            $table->integer('id_org');
            $table->tinyInteger('type_need');
            $table->string('title');

            $table->text('date_time');
            $table->text('description');
            $table->text('link');
            $table->integer('amount', false, true);
            $table->integer('collected', false, true);
            $table->integer('count_vols');

            $table->string('cover_path');
            $table->string('doc_path');
            $table->text('members'); // json members
            // json donaters/volunteers
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
        Schema::dropIfExists('needs');
    }
}
