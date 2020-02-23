<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVesselCollection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel_collection', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('mmsi');
            $table->integer('status');
            $table->integer('stationId');
            $table->integer('speed');
            $table->integer('lon');
            $table->integer('lat');
            $table->integer('course');
            $table->integer('heading');
            $table->integer('rot');
            $table->integer('timestamp');
            $table->timestaps();
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessel_collection');
    }
}
