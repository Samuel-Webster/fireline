<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplianceChecklistLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliance_checklist_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appliance_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->json('checklist');
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
        Schema::dropIfExists('appliance_checklist_logs');
    }
}
