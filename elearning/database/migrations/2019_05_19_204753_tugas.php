<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tugas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tugas", function(Blueprint $bluepring){
            $bluepring->timestamps();
            $bluepring->bigIncrements('id');
            $bluepring->integer('kelas_id')->index();
            $bluepring->string('judul_tugas');
            $bluepring->string('deskripisi_tugas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("tugas");
    }
}
