<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplianceChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appliance_checklists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appliance_id')->contrained()->onUpdate('cascade')->onUpdate('cascade');
            $table->string('item');
            $table->integer('quantity');
            $table->string('location');
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
        Schema::dropIfExists('appliance_checklists');
    }
}
