<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRugilabasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rugilabas', function (Blueprint $table) {
            $table->id();
            $table->string('project_number');
            $table->string('nama_customer');
            $table->string('po_number');
            $table->date('po_date');
            $table->string('po_category');
            $table->string('po_nominal');
            $table->string('total_pemasukan');
            $table->string('proses_pembayaran');
            $table->string('total_pemasukan_with_ppn11');
            $table->string('proses_pembayaran');
            $table->string('sisa_nominal');
            $table->string('total_pengeluaran')->nullable();;
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
        Schema::dropIfExists('rugilabas');
    }
}
