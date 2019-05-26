<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePCClubSesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_c__club_ses', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('id_pc')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            //$table->string('pc_name')->nullable();
            $table->dateTime('time_start')->nullable();
            $table->dateTime('time_end')->nullable();


            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->foreign('id_pc')->references('id')->on('p_c__club_p_c_s');
            $table->foreign('user_id')->references('id')->on('users');
            //$table->foreign('pc_name')->references('PC_Name')->on('pc_club_pc');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_c__club_ses');
    }
}
