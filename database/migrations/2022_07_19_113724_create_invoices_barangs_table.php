<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_barangs', function (Blueprint $table) {
            $table->id();
            $table->string('passing_id');
            $table->string('no_invoice');
            $table->string('project_number');
            $table->string('po_number');
            $table->string('deskripsi');
            $table->string('satuannya');
            $table->string('quantity');
            $table->string('harga_unit');
            $table->string('total_harga');
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
        Schema::dropIfExists('invoices_barangs');
    }
}
