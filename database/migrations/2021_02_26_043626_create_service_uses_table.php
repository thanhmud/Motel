<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_uses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_contract")->unsigned();
            $table->bigInteger("id_type")->unsigned();
            $table->bigInteger("start_index");
            $table->bigInteger("end_index");
            $table->string("quantity");
            $table->tinyInteger("status")->default(0);
            $table->timestamps();
        });
        Schema::table('service_uses',function (Blueprint $table){
            $table->foreign('id_contract')->references('id')->on('contracts')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('service_uses',function (Blueprint $table){
            $table->foreign('id_type')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_uses');
    }
}
