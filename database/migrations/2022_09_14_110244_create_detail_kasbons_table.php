<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKasbonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_kasbons', function (Blueprint $table) {
            $table->id();
            $table->string('no_kasbon');
            $table->string('categorynya');
            $table->string('deskripsi_kasbon');
            $table->string('amount');
            $table->string('code_project');
            $table->string('optional_remark');
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
        Schema::dropIfExists('detail_kasbons');
    }
}
