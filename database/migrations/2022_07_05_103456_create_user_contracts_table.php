<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_contracts', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('full_name');
            $table->date('contract_date_start');
            $table->date('contract_date_finish');
            $table->string('status_employee');
            $table->string('position_employee');
            $table->string('level_employee');
            $table->string('bpjs_tk');
            $table->string('bpjs_ks');
            $table->string('working_area');
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
        Schema::dropIfExists('user_contracts');
    }
}
