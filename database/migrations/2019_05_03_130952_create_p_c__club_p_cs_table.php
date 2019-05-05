<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCClubPCsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_club_pc', function (Blueprint $table) {
            $table->increments('id');

            $table->string('PC_Name')->unique();
            //$table->integer('busy')->default(0);

            $table->timestamps();

            //$table->foreign('PC_Name')->references('id')->on('pc_club_pc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pc_club_pc');
    }
}
