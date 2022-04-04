<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputdata', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jumlah');
            $table->string('jeniskelamin');
            $table->string('lokasi');
            $table->string('ciri'); 
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
        Schema::dropIfExists('inputdata');
    }
};
