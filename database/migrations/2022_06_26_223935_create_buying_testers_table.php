<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingTestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_testers', function (Blueprint $table) {
            $table->id();
            $table->string('name_buyer');
            $table->string('passing_id_buying');
            $table->string('passing_id_barang');
            $table->string('nama_barang');
            $table->integer('quantity');
            $table->string('status_pembelian');
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
        Schema::dropIfExists('buying_testers');
    }
}
