<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplianceLogUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliance_log_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appliance_log_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->boolean('is_driver');
            $table->boolean('is_crew_leader');
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
        Schema::dropIfExists('appliance_log_user');
    }
}
