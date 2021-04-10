<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('agency_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('deliveryType',['byUser','byCompany'])->comment('1-delivery by himself 2-the company will come and take it from user');
            $table->string('originAddress');
            $table->string('destinationAddress');
            $table->text('receiverInformation');
            $table->enum('deliveryVehicle',['byAir','byRail','byCar']);
            $table->text('postalInformation');
            $table->enum('accessResponse',['denied','granted'])->default('denied');
            $table->enum('stepStatus',['notApproved','onProcess','getProduct','onTheWay','receivedByTheRecipient'])->default('notApproved');
            $table->text('dataResponse')->nullable();
            $table->timestamp('ordered_at')->nullable()->default(null);
            $table->timestamp('seen_at')->nullable()->default(null);
            $table->timestamp('response_at')->nullable()->default(null);
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
        Schema::dropIfExists('shipments');
    }
}
