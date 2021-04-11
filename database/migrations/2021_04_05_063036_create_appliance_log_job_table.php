<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplianceLogJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliance_log_job', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appliance_log_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('job_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('appliance_log_job');
    }
}
