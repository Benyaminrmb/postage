<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipment_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agency_id')->nullable()->unsigned();
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->enum('type',['input','select','checkbox'])->default('input');
            $table->text('data')->nullable();
            $table->string('default')->nullable();
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
        Schema::dropIfExists('shipment_options');
    }
}
