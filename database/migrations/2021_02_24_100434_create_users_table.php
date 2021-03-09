<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->enum('userType',['agency','member'])->default('member');
            $table->integer('client_id');
            $table->string('member_id');
            $table->string('name');
            $table->string('family');
            $table->string('agencyInfo')->nullable();
            $table->string('mobile')->nullable();
            $table->string('nationalCode')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('address')->nullable();
            $table->longText('token');
            $table->string('register_date')->nullable();
            $table->timestamp('token_expired_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
