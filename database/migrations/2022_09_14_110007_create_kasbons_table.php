<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasbonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasbons', function (Blueprint $table) {
            $table->id();
            $table->string('passing_id');
            $table->string('no_kasbon');
            $table->string('date_kasbon');
            $table->string('pic');
            $table->string('total_amount');
            $table->string('payment');
            $table->date('tgl_realisasi');
            $table->string('no_realisasi');
            $table->string('over_under');
            $table->date('tgl_transfer');
            $table->string('approvalnya');
            $table->string('statusnya');
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
        Schema::dropIfExists('kasbons');
    }
}
