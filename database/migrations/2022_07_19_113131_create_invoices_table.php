<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('passing_id');
            $table->string('no_invoice');
            $table->string('project_number');
            $table->string('po_number');
            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->string('alamat_customer2');
            $table->string('proses_category');
            $table->string('proses_percent');
            $table->string('subtotal');
            $table->string('nominal_pembayaran');
            $table->string('nominal_ppn11');
            $table->string('nominal_pembayaran_with_ppn11');
            $table->string('due_date');
            $table->text('keterangan');
            $table->string('have_discount');
            $table->string('nominal_discount');
            $table->string('status_invoice');
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
        Schema::dropIfExists('invoices');
    }
}
