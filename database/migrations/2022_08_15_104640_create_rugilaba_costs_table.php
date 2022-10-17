<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRugilabaCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rugilaba_costs', function (Blueprint $table) {
            $table->id();
            $table->string('project_number');
            $table->string('cost_material')->nullable();
            $table->string('cost_jasa')->nullable();
            $table->string('cost_lainnya')->nullable();
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
        Schema::dropIfExists('rugilaba_costs');
    }
}
