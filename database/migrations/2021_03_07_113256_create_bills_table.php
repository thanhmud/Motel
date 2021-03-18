<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("id_service_uses")->unsigned();
            $table->string("total_price");
            $table->date("start_date");
            $table->date("end_date");
            $table->bigInteger("id_contract")->unsigned();
            $table->timestamps();
        });
        Schema::table('bills',function (Blueprint $table){
            $table->foreign('id_service_uses')->references('id')->on('service_uses')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('bills',function (Blueprint $table){
            $table->foreign('id_contract')->references('id')->on('contracts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
