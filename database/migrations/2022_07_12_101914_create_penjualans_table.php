<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('project_number');
            $table->string('nama_customer');
            $table->text('alamat_customer');
            $table->string('po_number');
            $table->date('po_date');
            $table->string('po_category');
            $table->string('po_nominal');
            $table->text('deskripsi');
            $table->text('lokasi');
            $table->string('info_pembayaran');
            $table->string('creator');
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
        Schema::dropIfExists('penjualans');
    }
}
