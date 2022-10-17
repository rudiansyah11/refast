<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_tests', function (Blueprint $table) {
            $table->id();
            $table->string('passing_id');
            $table->string('nama_barang');
            $table->string('stok_barang');
            $table->string('jenis_barang');
            $table->string('harga_satuan');
            $table->text('keterangan');
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
        Schema::dropIfExists('sample_tests');
    }
}
