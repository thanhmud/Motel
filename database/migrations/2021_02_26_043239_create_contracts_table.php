
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("room_id")->unsigned();
            $table->bigInteger("customer_id")->unsigned();
            $table->string("name");
            $table->string("deposits");
            $table->date("start_date");
            $table->date("end_date");
            $table->tinyInteger("status")->default(0);
            $table->timestamps();
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('contracts', function (Blueprint $table) {
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}