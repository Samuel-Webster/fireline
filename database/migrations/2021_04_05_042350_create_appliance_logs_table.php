<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplianceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliance_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appliance_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->integer('odometer_out');
            $table->integer('odometer_in');
            $table->dateTime('time_out');
            $table->dateTime('time_in');
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
        Schema::dropIfExists('appliance_logs');
    }
}
